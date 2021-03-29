<?php

namespace App\Console\Commands;

use App;
use Illuminate\Console\Command;

class SetEnvCommand extends Command
{
    protected $signature   = 'env:set {key} {value}';
    protected $description = 'Sets a value in the .env';

    public function handle(): void
    {
        ['key' => $key, 'value' => $value] = $this->arguments();

        $content                  = file_get_contents($envFile = App::environmentFilePath());
        [$newContents, $isNewKey] = $this->setEnvVariable($content, $key, $value);

        if ($isNewKey) {
            $this->info("A new environment variable with key '{$key}' has been set to '{$value}'");
        } else {
            [$_, $oldValue] = explode('=', $this->readKeyValuePair($content, $key), 2);
            $this->info("Environment variable with key '{$key}' has been changed from '{$oldValue}' to '{$value}'");
        }

        file_put_contents($envFile, $newContents, LOCK_EX);
    }

    public function setEnvVariable(string $envFileContent, string $key, string $value): array
    {
        $oldPair = $this->readKeyValuePair($envFileContent, $key);

        // Wrap values that have a space or equals in quotes to escape them
        if (preg_match('/\s/', $value) || strpos($value, '=') !== false) {
            $value = '"' . $value . '"';
        }

        $newPair = strtoupper($key) . '=' . $value;

        // For existed key.
        if ($oldPair !== null) {
            $replaced = preg_replace('/^' . preg_quote($oldPair, '/') . '$/uimU', $newPair, $envFileContent);

            return [$replaced, false];
        }

        // For a new key.
        return [$envFileContent . "\n" . $newPair . "\n", true];
    }

    /**
     * Read the "key=value" string of a given key from an environment file.
     * This function returns original "key=value" string and doesn't modify it.
     *
     * @return string|null key=value string or null if the key is not exists
     */
    public function readKeyValuePair(string $envFileContent, string $key): ?string
    {
        // Match the given key at the beginning of a line
        if (preg_match("#^ *{$key} *= *[^\r\n]*$#uimU", $envFileContent, $matches)) {
            return $matches[0];
        }

        return null;
    }
}

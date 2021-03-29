<?php

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Spatie\Valuestore\Valuestore;

if (!function_exists('settings')) {
    /**
     * @return Valuestore|mixed
     */
    function settings(string $key = null)
    {
        if ($key) {
            return app('settings')->get($key);
        }

        return app('settings');
    }
}

if (!function_exists('flash')) {
    function flash(string $message, string $level = 'success'): void
    {
        session()->flash($level, $message);
    }
}

if (!function_exists('user')) {
    function user(): ?Authenticatable
    {
        return auth()->user();
    }
}

if (!function_exists('access')) {
    /**
     * @return mixed
     */
    function access(object $object, string $property)
    {
        $reflection = new ReflectionClass($object);

        if (!$reflection->hasProperty($property)) {
            throw new InvalidArgumentException(sprintf('Property [%s] does not exist on %s ', $property, $reflection->getName()));
        }

        $accessibleProperty = $reflection->getProperty($property);
        $accessibleProperty->setAccessible(true);

        return $accessibleProperty->getValue($object);
    }
}

if (!function_exists('transfer')) {
    function transfer(object $from, object $to)
    {
        if (!$to instanceof $from) {
            return false;
        }

        $fromReflection = new ReflectionClass($from);
        $fromProperties = $fromReflection->getProperties();
        $toReflection   = new ReflectionClass($to);

        foreach ($fromProperties as $fromProperty) {
            $fromProperty->setAccessible(true);

            if (!$toReflection->hasProperty($fromProperty->getName())) {
                continue;
            }

            $toProperty = $toReflection->getProperty($fromProperty->getName());
            $toProperty->setAccessible(true);
            $toProperty->setValue($to, $fromProperty->getValue($from));
        }

        return $to;
    }
}

if (!function_exists('call')) {
    function call(object $object, string $method, ...$arguments)
    {
        $reflection = new ReflectionClass($object);

        if (!$reflection->hasMethod($method)) {
            throw new InvalidArgumentException("Method [$method] does not exist.");
        }

        $reflectedMethod = $reflection->getMethod($method);
        $reflectedMethod->setAccessible(true);

        return $reflectedMethod->invokeArgs($object, $arguments);
    }
}

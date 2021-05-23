<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception)) {
            $response = Http::post('http://localhost:8000/api/capture', $this->makePayload($exception));

            dd($response->body());
        }

        parent::report($exception);
    }

    public function makePayload(Throwable $throwable): array
    {
        return [
            'token' => 'proj_2o2aTbrecmbBpjleGrcJys5kGdFfMeYGYURxR7j.60aa059356d1c0.0718',
            'title' => $throwable->getMessage(),
            'context' => [
                'trace' => $this->getTrace($throwable),
                'request' => [
                    'env' => app()->environment(),
                    'ip' => request()->ip(),
                    'agent' => request()->userAgent(),
                    'headers' => Arr::except(request()->headers->all(), ['authorization'])
                ],
                'user_id' => Auth::id()
            ]
        ];
    }

    public function getTrace(array $rawTrace): array
    {
        $trace = [];

        foreach ($rawTrace as $call) {
            $trace[] = array_merge($call, [
                'file' => str_replace(base_path(), '', $call['file']),
                'code' => $this->getCodeForLine($call['file'], $call['line'])
            ]);
        }

        return $trace;
    }

    public function getCodeForLine(string $file, int $line): string {
        $contents = file_get_contents($file);
        $lines = explode(PHP_EOL, $contents);

        return implode(PHP_EOL, array_filter($lines, function ($key) use ($line) {
            return $key <= $line + 5 && $key >= $line - 5 ;
        }, ARRAY_FILTER_USE_KEY));
    }
}

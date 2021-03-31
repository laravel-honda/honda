<?php

use App\Services\Translation\Managers\FileManager;
use App\Services\Translation\Support\TranslationKeysFlattener;
use Tests\TestCase;

uses(TestCase::class);

it('can flatten keys recursively', function () {
    $flattened = TranslationKeysFlattener::flatten([
        'hello' => [
            'this' => 'that',
            'a' => ['b' => 'c', 'c' => 'b']
        ],
        'foo' => 'bar'
    ]);

    expect($flattened)->toBe([
        'hello.this' => 'that',
        'hello.a.b' => 'c',
        'hello.a.c' => 'b',
        'foo' => 'bar'
    ]);
});



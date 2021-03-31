<?php


use App\Services\Translation\Support\TranslationKeysFlattener;

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

<?php


namespace App\Services\Translation\Contracts;


interface Translator
{
    public function translate(string $text, string $from, string $to): string;
}

<?php


namespace App\Support\Sitemap;


use Carbon\Carbon;

class Set
{
    public string $url;
    public ?Carbon $lastModificationDate = null;
    public ?string $frequency = null;
    public float $priority = 0.5;

    public function __construct(string $url)
    {
        $this->url = $url;
    }
}

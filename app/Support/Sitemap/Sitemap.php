<?php

namespace App\Support\Sitemap;

use Carbon\Carbon;
use Honda\UrlResolver\UrlResolver;
use Illuminate\Contracts\Support\Responsable;

class Sitemap implements Responsable
{
    public const CHANGE_FREQUENCY_ALWAYS  = 'always';
    public const CHANGE_FREQUENCY_HOURLY  = 'hourly';
    public const CHANGE_FREQUENCY_DAILY   = 'daily';
    public const CHANGE_FREQUENCY_WEEKLY  = 'weekly';
    public const CHANGE_FREQUENCY_MONTHLY = 'monthly';
    public const CHANGE_FREQUENCY_YEARLY  = 'yearly';
    public const CHANGE_FREQUENCY_NEVER   = 'never';

    /** @var Set[] */
    protected array $set = [];

    public static function create(): self
    {
        return new self();
    }

    public function add(string $url)
    {
        $this->set[] = new Set($url);

        return $this;
    }

    public function lastModificationDate(Carbon $date): self
    {
        $this->getCurrentSet()->lastModificationDate = $date;

        return $this;
    }

    public function getCurrentSet(): Set
    {
        return $this->set[array_key_last($this->set)];
    }

    public function changeFrenquency(string $frequency): self
    {
        $this->getCurrentSet()->frequency = $frequency;

        return $this;
    }

    public function priority(float $priority = 0.5): self
    {
        $this->getCurrentSet()->priority = $priority;

        return $this;
    }

    public function toResponse($request)
    {
        return response($this->toXML(), 200, [
            'Content-Type' => 'text/xml',
        ]);
    }

    public function toXML(): string
    {
        $urls = '';

        foreach ($this->set as $set) {
            $urls .= '<url>';

            $urls .= '<loc>' . UrlResolver::guess($set->url) . '</loc>';

            if (!is_null($set->lastModificationDate)) {
                $urls .= '<lastmod>' . $set->lastModificationDate->isoFormat('YYYY-MM-DD') . '</lastmod>';
            }

            if (!is_null($set->frequency)) {
                $urls .= "<changefreq>{$set->frequency}</changefreq>";
            }

            $urls .= "<priority>{$set->priority}</priority>";

            $urls .= '</url>';
        }

        return "<?xml version=\"1.0\" encoding=\"UTF-8\" ?><urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">$urls</urlset>";
    }

    public function save(): void
    {
        app()->bind('sitemap', function () {
            return $this;
        });
    }

    public function __toString(): string
    {
        return $this->toXML();
    }
}

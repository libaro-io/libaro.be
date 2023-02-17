<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class LandingPage extends Model implements Sitemapable
{
    use HasFactory;

    public function toSitemapTag(): Url | string | array
    {
        return '/nl/l/'. $this->slug;
    }

    public function showcases()
    {
        return $this->belongsToMany(Showcase::class);
    }
}

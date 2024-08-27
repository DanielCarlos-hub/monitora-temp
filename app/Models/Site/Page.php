<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $table = 'site_pages';
    protected $fillable = [
        'page_name', 'page_image', 'page_slug', 'page_description', 'page_keywords', 'page_robots', 'page_title', 'page_canonical', 'page_og_title', 'page_og_description', 'page_og_image', 'page_og_image_alt', 'page_og_image_type', 'page_og_url', 'page_disk'
    ];

    public function sections()
    {
        return $this->hasMany(Section::class, 'page_id');
    }

}

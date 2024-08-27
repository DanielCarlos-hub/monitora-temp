<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'site_page_sections';
    protected $fillable = [
        'page_id', 'section_name', 'section_title', 'section_description', 'section_slug'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function contents()
    {
        return $this->hasMany(Content::class, 'section_id');
    }

    public function banners()
    {
        return $this->hasMany(Banner::class, 'section_id');
    }
}

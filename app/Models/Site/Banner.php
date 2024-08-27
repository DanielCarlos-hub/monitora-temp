<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'site_banners';
    protected $fillable = [
        'section_id', 'banner_title', 'banner_description', 'banner_image', 'banner_image_alt', 'banner_image_width', 'banner_image_height', 'banner_link',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}

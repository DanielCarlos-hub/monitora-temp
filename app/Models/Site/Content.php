<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'site_section_contents';
    protected $fillable = [
        'section_id', 'content_title', 'content_subtext', 'content_description', 'content_image_name', 'content_image_alt', 'content_image_filename', 'content_image_width', 'content_image_height', 'content_banner_img_active', 'content_image_aditional_styles', 'content_image_disk',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}

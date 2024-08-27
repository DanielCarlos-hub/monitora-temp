<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'post_name', 'post_body', 'post_image', 'post_description', 'page_description', 'post_slug', 'post_status', 'post_draft', 'page_keywords', 'page_robots', 'post_title', 'page_canonical', 'page_og_title', 'page_og_description', 'page_og_image', 'page_og_image_alt', 'page_og_image_type', 'page_og_url'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }
}

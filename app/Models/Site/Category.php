<?php

namespace App\Models\Site;

use App\Models\Site\Catalogo\Produto;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'category', 'parent_id', 'description', 'slug', 'entity'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post');
    }

    public function produtos(){
        return $this->belongsToMany(Produto::class, 'category_produto');
    }

    public function subcategories(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id')->withDefault([
            'category' => "",
        ]);
    }
}

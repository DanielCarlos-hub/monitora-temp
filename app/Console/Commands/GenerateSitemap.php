<?php

namespace App\Console\Commands;

use App\Models\Site\Catalogo\Produto;
use App\Models\Site\Post;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Site\Category as PostCategory;
use App\Models\Site\Category as ProductCategory;

class GenerateSitemap extends Command
{

    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sitemap = Sitemap::create()
        ->add(Url::create('/')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(1));

        $sitemap->add(Url::create('/servicos/ar-condicionado')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(1));

        $sitemap->add(Url::create('/servicos/maquina-lavar')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(1));

        $sitemap->add(Url::create('/servicos/camara-fria')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(1));

        $sitemap->add(Url::create('/servicos/freezer')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(1));

        $sitemap->add(Url::create('/servicos/infraestrutura-ar-condicionado')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(1));

        $sitemap->add(Url::create('/artigos')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(1));

        Post::all()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(Url::create("artigos/{$post->post_slug}")
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1));
        });

        PostCategory::where('entity', '=', 'Posts')->get()->each(function (PostCategory $category) use ($sitemap) {
            $sitemap->add(Url::create("artigos/categoria/{$category->slug}")
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(1));
        });

        $sitemap->add(Url::create('/produtos')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(0.8));

        Produto::all()->each(function (Produto $produto) use ($sitemap) {
            $sitemap->add(Url::create("produtos/{$produto->slug}")
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1));
        });

        ProductCategory::where('entity', '=', 'Products')->get()->each( function (ProductCategory $category) use($sitemap){
            $sitemap->add(Url::create("produtos/categoria/{$category->slug}")
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(1));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}

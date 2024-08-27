<?php

namespace App\Http\Controllers\Dashboard\Admin\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Category;
use App\Models\Site\Post;
use App\Services\ProcessImage;
use App\Support\ExceptionTreatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){
            $posts = Post::with('categories')->get();

            return datatables()->of($posts)->make(true);
        }

        return view('dashboard.admin.site.artigos.posts.index');
    }

    public function show($slug){
        try {

            $post = Post::with('categories')->where('post_slug','=',$slug)->firstOrFail();

            return view('site.artigos.artigo', compact('post'));

        } catch (\Exception $e) {

            return redirect()->route('dashboard.admin.site.artigos.index')->with((new ExceptionTreatment($e, 'Artigo'))->getMessage());
        }
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.admin.site.artigos.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $imageResize = new ProcessImage();

            $post_image = $imageResize->convertImage($request->file('post_image'), 450, 250, 'artigos', '');

            $post = Post::create([
                'post_name' => $request->post_title,
                'post_title' => $request->post_title,
                'post_body' => $request->post_body,
                'post_image' => 'artigos/'.$post_image,
                'post_description' => $request->post_description,
                'page_description' => $request->post_description,
                'post_slug' => Str::slug($request->post_title),
                'post_status' => $request->publicar ? ' publicado' : 'rascunho',
                'post_draft' => $request->publicar ? 0 : 1,
                'page_keywords' => $request->post_keywords,
                'page_og_title' => $request->post_title,
                'page_og_description' => $request->post_description,
                'page_og_image' => 'artigos/'.$post_image,
            ]);

            $post->categories()->attach($request->category_id);

            $notification = array(
                'message' => 'Artigo adicionado',
                'alert-type' => 'success'
            );

            DB::commit();
            return redirect()->route('dashboard.admin.site.artigos.index')->with($notification);

        } catch (\Exception $e) {
            return back()->with((new ExceptionTreatment($e, 'Artigo'))->getMessage());
        }
    }
}

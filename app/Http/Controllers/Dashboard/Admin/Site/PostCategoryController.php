<?php

namespace App\Http\Controllers\Dashboard\Admin\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Category;
use App\Support\ExceptionTreatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostCategoryController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){
            $categories = Category::where('entity', '=', 'Posts')->orderBy('category')->get();

            return datatables()->of($categories)->make(true);
        }

        return view('dashboard.admin.site.artigos.categorias.index');
    }

    public function create()
    {
        return view('dashboard.admin.site.artigos.categorias.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            Category::create([
                'category' => $request->category,
                'slug' => Str::slug($request->category),
                'description' => $request->description,
                'entity' => 'Posts'
            ]);

            $notification = array(
                'message' => 'Categoria adicionada',
                'alert-type' => 'success'
            );

            DB::commit();
            return redirect()->route('dashboard.admin.site.categorias.index')->with($notification);

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with((new ExceptionTreatment($e, 'Categoria'))->getMessage());

        }
    }

    public function edit($slug)
    {
        try {
            $category = Category::where('slug', '=', $slug)->firstOrFail();

            return view('dashboard.admin.site.artigos.categorias.edit', compact('category'));

        } catch (\Exception $e) {
            return redirect()->route('dashboard.admin.site.categorias.index')->with((new ExceptionTreatment($e, 'Categoria'))->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $category = Category::findOrFail($id);

            $category->update([
                'category' => $request->category,
                'slug' => Str::slug($request->category),
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'Categoria atualizada',
                'alert-type' => 'success'
            );

            DB::commit();
            return redirect()->route('dashboard.admin.site.categorias.index')->with($notification);

        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->route('dashboard.admin.site.categorias.edit', $id)->with((new ExceptionTreatment($e, 'Categoria'))->getMessage());

        }
    }
}

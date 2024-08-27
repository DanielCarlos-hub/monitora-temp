<?php

namespace App\Http\Controllers\Dashboard\Admin\Site\Catalogo;

use App\Http\Controllers\Controller;
use App\Models\Site\Category;
use App\Support\ExceptionTreatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){
            $categories = Category::with('parent')->where('entity', '=', 'Products')->orderBy('category')->get();

            return datatables()->of($categories)->make(true);
        }

        return view('dashboard.admin.site.catalogo.categorias.index');
    }

    public function create()
    {
        $master_categorias = Category::where('entity', '=', 'Products')->whereNull('parent_id')->get();
        return view('dashboard.admin.site.catalogo.categorias.create', compact('master_categorias'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $parent_id = $request->master_category_id == "" ? NULL : $request->master_category_id;

            Category::create([
                'category' => $request->category,
                'slug' => Str::slug($request->category),
                'description' => $request->description,
                'parent_id' => $parent_id,
                'entity' => 'Products'
            ]);

            $notification = array(
                'message' => 'Categoria adicionada',
                'alert-type' => 'success'
            );

            DB::commit();
            return redirect()->route('dashboard.admin.site.catalogo.categorias.index')->with($notification);

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with((new ExceptionTreatment($e, 'Categoria'))->getMessage());

        }
    }

    public function edit($slug)
    {
        try {
            $category = Category::where('slug', '=', $slug)->firstOrFail();
            $master_categorias = Category::where('entity', '=', 'Products')->whereNull('parent_id')->get();
            return view('dashboard.admin.site.catalogo.categorias.edit', compact('category', 'master_categorias'));

        } catch (\Exception $e) {
            return redirect()->route('dashboard.admin.site.catalogo.categorias.index')->with((new ExceptionTreatment($e, 'Categoria'))->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $parent_id = $request->master_category_id == "" ? NULL : $request->master_category_id;

            $category = Category::findOrFail($id);

            $category->update([
                'category' => $request->category,
                'parent_id' => $parent_id,
                'slug' => StR::slug($request->category),
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'Categoria atualizada',
                'alert-type' => 'success'
            );

            DB::commit();
            return redirect()->route('dashboard.admin.site.catalogo.categorias.index')->with($notification);

        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->route('dashboard.admin.site.catalogo.categorias.edit', $id)->with((new ExceptionTreatment($e, 'Categoria'))->getMessage());

        }
    }
}

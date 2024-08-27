<?php

namespace App\Http\Controllers\Dashboard\Admin\Site\Catalogo;

use App\Http\Controllers\Controller;
use App\Models\Site\Catalogo\Atributo;
use App\Models\Site\Catalogo\Produto;
use App\Models\Site\Category;
use App\Support\ExceptionTreatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{

    public function index(Request $request)
    {

        if($request->ajax()){
            $products = Produto::with('categorias')->get();

            return datatables()->of($products)->make(true);
        }

        return view('dashboard.admin.site.catalogo.produtos.index');
    }

    public function create()
    {

        $categorias = Category::where('entity', '=', 'Products')->get();

        return view('dashboard.admin.site.catalogo.produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {

        $produto = $request->product;
        $categories = $request->category_id;
        $atributos = $request->atributos;

        DB::beginTransaction();

        try {

            $produto = Produto::create($produto);

            $produto->categorias()->sync($categories);

            if($request->hasFile('fotos')) {
                $images = $this->imageUpload($request, 'path');
                $produto->fotos()->createMany($images);
            }

            $produto->atributos()->createMany($atributos);

            $notification = array(
                'message' => 'Produto adicionado na lista',
                'alert-type' => 'success'
            );

            DB::commit();
            return redirect()->route('dashboard.admin.site.catalogo.produtos.index')->with($notification);

        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return back()->with((new ExceptionTreatment($e, 'Produto'))->getMessage());
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        try {
            $categorias = Category::where('entity', '=', 'Products')->get();

            $produto = Produto::with('categorias', 'fotos', 'atributos')->findOrFail($id);


            return view('dashboard.admin.site.catalogo.produtos.edit', compact('produto', 'categorias'));

        } catch (\Exception $e) {

            return redirect()->route('dashboard.admin.site.catalogo.produtos.index')->with((new ExceptionTreatment($e, 'Produto'))->getMessage());

        }

    }

    public function update(Request $request, $id)
    {

        $arrProduto = $request->product;
        $categories = $request->category_id;
        $atributos = $request->atributos;

        try {
            $produto = Produto::with('categorias', 'fotos', 'atributos')->findOrFail($id);

            $produto->update($arrProduto);

            $produto->categorias()->sync($categories);

            foreach($atributos as $atributo){
                Atributo::find($atributo['atributo_id'])->update([
                    'atributo' => $atributo['atributo'],
                    'valor' => $atributo['valor'],
                ]);
            }

            if($request->hasFile('fotos')) {
                $images = $this->imageUpload($request, 'path');
                $produto->fotos()->createMany($images);
            }

            $notification = array(
                'message' => 'O produto foi atualizado',
                'alert-type' => 'success'
            );

            DB::commit();
            return redirect()->route('dashboard.admin.site.catalogo.produtos.index')->with($notification);


        } catch (\Exception $e) {

            dd($e);
            return redirect()->route('dashboard.admin.site.catalogo.produtos.index')->with((new ExceptionTreatment($e, 'Produto'))->getMessage());
        }
    }

    public function showOnSite($id){
        try {

            $produto = Produto::findOrFail($id);

            $produto->update([
                'exibir' => 1
            ]);

            $notification = array(
                'message' => 'O produto selecionado passou a ser exibido no site',
                'alert-type' => 'info'
            );

            return redirect()->route('dashboard.admin.site.catalogo.produtos.index')->with($notification);

        } catch (\Exception $e) {
            return back()->with((new ExceptionTreatment($e, 'Produto'))->getMessage());
        }
    }

    public function notShowOnSite($id){
        try {

            $produto = Produto::findOrFail($id);

            $produto->update([
                'exibir' => 0
            ]);

            $notification = array(
                'message' => 'O produto selecionado deixou de ser exibido no site',
                'alert-type' => 'info'
            );

            return redirect()->route('dashboard.admin.site.catalogo.produtos.index')->with($notification);

        } catch (\Exception $e) {
            return back()->with((new ExceptionTreatment($e, 'Produto'))->getMessage());
        }
    }

    public function showAllOnSite(){
        try {

            Produto::where('exibir', '=', 0)->update([
                'exibir' => 1,
            ]);

            $notification = array(
                'message' => 'Todos os produtos agora estão sendo exibidos no site',
                'alert-type' => 'info'
            );

            return redirect()->route('dashboard.admin.site.catalogo.produtos.index')->with($notification);

        } catch (\Exception $e) {
            return back()->with((new ExceptionTreatment($e, 'Produto'))->getMessage());
        }
    }

    public function notShowAllOnSite(){
        try {
            Produto::where('exibir', '=', 1)->update([
                'exibir' => 0,
            ]);

            $notification = array(
                'message' => 'Todos os produtos deixaram de ser exibidos no site',
                'alert-type' => 'info'
            );

            return redirect()->route('dashboard.admin.site.catalogo.produtos.index')->with($notification);

        } catch (\Exception $e) {
            return back()->with((new ExceptionTreatment($e, 'Produto'))->getMessage());
        }
    }

    public function enablePrice($id){
        try {

            $produto = Produto::findOrFail($id);

            $produto->update([
                'mostrar_preco' => 1
            ]);

            $notification = array(
                'message' => 'O preço do produto selecionado passou a ser exibido no site',
                'alert-type' => 'info'
            );

            return redirect()->route('dashboard.admin.site.catalogo.produtos.index')->with($notification);

        } catch (\Exception $e) {
            return back()->with((new ExceptionTreatment($e, 'Produto'))->getMessage());
        }
    }

    public function disablePrice($id){
        try {

            $produto = Produto::findOrFail($id);

            $produto->update([
                'mostrar_preco' => 0
            ]);

            $notification = array(
                'message' => 'O preço produto selecionado deixou de ser exibido no site',
                'alert-type' => 'info'
            );

            return redirect()->route('dashboard.admin.site.catalogo.produtos.index')->with($notification);

        } catch (\Exception $e) {
            return back()->with((new ExceptionTreatment($e, 'Produto'))->getMessage());
        }
    }
    public function enablePriceAll(){
        try {

            Produto::where('mostrar_preco', '=', 0)->update([
                'mostrar_preco' => 1,
            ]);

            $notification = array(
                'message' => 'A exibição do preço foi ativada para todos os produtos',
                'alert-type' => 'info'
            );

            return redirect()->route('dashboard.admin.site.catalogo.produtos.index')->with($notification);

        } catch (\Exception $e) {
            dd($e);
            return back()->with((new ExceptionTreatment($e, 'Produto'))->getMessage());
        }
    }

    public function disablePriceAll(){
        try {

            Produto::where('mostrar_preco', '=', 1)->update([
                'mostrar_preco' => 0,
            ]);

            $notification = array(
                'message' => 'A exibição do preço foi desativada para todos os produtos',
                'alert-type' => 'info'
            );

            return redirect()->route('dashboard.admin.site.catalogo.produtos.index')->with($notification);

        } catch (\Exception $e) {

            dd($e);
            return back()->with((new ExceptionTreatment($e, 'Produto'))->getMessage());
        }
    }

    private function imageUpload(Request $request, $imageColumn)
    {
        $images = $request->file('fotos');

        $uploadedImages = [];

        foreach($images as $image) {
            $uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
        }

        return $uploadedImages;
    }
}

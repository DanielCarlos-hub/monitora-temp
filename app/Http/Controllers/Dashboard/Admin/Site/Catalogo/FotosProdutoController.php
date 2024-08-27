<?php

namespace App\Http\Controllers\Dashboard\Admin\Site\Catalogo;

use App\Http\Controllers\Controller;
use App\Models\Site\Catalogo\Foto;
use App\Support\ExceptionTreatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotosProdutoController extends Controller
{

    public function destroy($produto_id, $foto_id){

        try {
            $foto = Foto::findOrFail($foto_id);

            if(Storage::disk('public')->exists($foto->path)){
                Storage::disk('public')->delete($foto->path);
            }

            $foto->delete();

            $notification = array(
                'message' => 'A foto selecionado foi removida do Produto',
                'alert-type' => 'warning'
            );

            return redirect()->route('dashboard.admin.site.catalogo.produtos.edit', $produto_id)->with($notification);

        } catch (\Exception $e) {
            return back()->with((new ExceptionTreatment($e, 'Foto Produto'))->getMessage());
        }
    }
}

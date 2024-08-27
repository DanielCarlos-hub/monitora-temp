<?php

namespace App\Http\Controllers\Dashboard\Admin\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Page;
use App\Support\ExceptionTreatment;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $pages = Page::all();

            return datatables()->of($pages)->make(true);
        }

        return view('dashboard.admin.site.paginas.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {
            $page = Page::with('sections.contents', 'sections.banners')->findOrFail($id);

            return view('dashboard.admin.site.paginas.edit', compact('page'));

        } catch (\Exception $e) {
            return redirect()->route('dashboard.admin.site.pages.index')->with((new ExceptionTreatment($e, 'Pagina'))->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $page = Page::findOrFail($id);

            $page->update([
                'page_name' => $request->page_name,
                'page_title' => $request->page_title,
                'page_description' => $request->page_description,
                'page_og_title' => $request->page_title,
                'page_og_description' => $request->page_description,
            ]);

            $notification = array(
                'message' => 'A Página foi atualizada',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard.admin.site.pages.index')->with($notification);

        } catch (\Exception $e) {

            dd($e);
            return redirect()->route('dashboard.admin.site.pages.index')->with((new ExceptionTreatment($e, 'Pagina'))->getMessage());
        }
    }
}

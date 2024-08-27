<?php

namespace App\Http\Controllers\Dashboard\Admin\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Page;
use App\Models\Site\Section;
use App\Support\ExceptionTreatment;
use Illuminate\Http\Request;

class PageSectionsController extends Controller
{

    public function index(Request $request, $page_id)
    {

        $page = Page::findOrFail($page_id);

        if($request->ajax()){
            $sections = Section::where('page_id', '=', $page_id)->get();

            return datatables()->of($sections)->make(true);
        }

        return view('dashboard.admin.site.paginas.secoes.index', compact('page'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($page_id, $section_id)
    {
        try {

            $page = Page::findOrFail($page_id);
            $section = Section::with('contents')->where('page_id', '=', $page_id)->findOrFail($section_id);

        } catch (\Exception $e) {
            return redirect()->route('dashboard.admin.site.pages.sections.index', $page_id)->with((new ExceptionTreatment($e, 'Seção'))->getMessage());
        }
        return view('dashboard.admin.site.paginas.secoes.edit', compact('page', 'section'));
    }

    public function update(Request $request, $page_id, $section_id)
    {
        try {
            $page = Page::findOrFail($page_id);
            $section = Section::where('page_id', '=', $page_id)->findOrFail($section_id);

            $section->update([
                'section_title' => $request->section_title,
                'section_description' => $request->section_description,
            ]);

            $notification = array(
                'message' => 'A Seção de '.$section->section_name.' da página '. $page->page_name. ' foi atualizada',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard.admin.site.pages.sections.index', $page_id)->with($notification);

        } catch (\Exception $e) {
            return redirect()->route('dashboard.admin.site.pages.sections.index', $page_id)->with((new ExceptionTreatment($e, 'Seção'))->getMessage());
        }
    }

}

<?php

namespace App\Http\Controllers\Dashboard\Admin\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Content;
use App\Models\Site\Page;
use App\Models\Site\Section;
use App\Support\ExceptionTreatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSectionContentsController extends Controller
{

    public function index(Request $request, $page_id, $section_id)
    {

        $page = Page::findOrFail($page_id);
        $section = Section::findOrFail($section_id);

        if($request->ajax()){

            $contents = Content::where('section_id', '=', $section_id)->get();

            return datatables()->of($contents)->make(true);
        }

        return view('dashboard.admin.site.paginas.secoes.conteudo.index', compact('page', 'section'));
    }

    public function create($page_id, $section_id)
    {
        $page = Page::findOrFail($page_id);
        $section = Section::findOrFail($section_id);

        return view('dashboard.admin.site.paginas.secoes.conteudo.create', compact('page', 'section'));
    }

    public function store(Request $request, $page_id, $section_id)
    {
        try {

            $page = Page::findOrFail($page_id);
            $section = Section::findOrFail($section_id);

            if($request->hasFile('image')){
                $file = $request->image;
                $filename = get_file_name($file->getClientOriginalName());
                $ext = get_file_ext($file->getClientOriginalName());
                $filename_ext = $filename.'.'.$ext;

                $file->storeAs('paginas/'.$page->page_disk.'/'.$section->section_name, $filename_ext, 'site');
            }

            $content = Content::create([
                'section_id' => $section_id,
                'content_title' => $request->content_title,
                'content_subtext' => $request->content_subtext,
                'content_description' => $request->content_description,
                'content_url' => $request->content_url,
                'content_image_name' => $filename,
                'content_image_alt' => $request->content_image_alt,
                'content_image_filename' => $filename_ext,
                'content_image_width' => $request->content_image_width,
                'content_image_height' => $request->content_image_height,
            ]);

            $notification = array(
                'message' => 'Novo conteúdo adicionado na seção '. $section->section_name. ' da página '. $page->page_name,
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard.admin.site.pages.sections.contents.index', ['page' => $page->id, 'section' => $section->id])->with($notification);
        } catch (\Exception $e) {
            return redirect()->route('dashboard.admin.site.pages.sections.contents.index', ['page' => $page_id, 'section' => $section_id])->with((new ExceptionTreatment($e, 'Conteudo'))->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($page_id, $section_id, $content_id)
    {
        try {

            $page = Page::findOrFail($page_id);
            $section = Section::findOrFail($section_id);
            $content = Content::findOrFail($content_id);

        } catch (\Exception $e) {
            dd($e);
        }
        return view('dashboard.admin.site.paginas.secoes.conteudo.edit', compact('page', 'section', 'content'));
    }

    public function update(Request $request, $page_id, $section_id, $content_id)
    {
        try {
            $page = Page::findOrFail($page_id);
            $section = Section::findOrFail($section_id);
            $content = Content::findOrFail($content_id);

            if($request->hasFile('image')){
                $file = $request->image;
                $filename = get_file_name($file->getClientOriginalName());
                $ext = get_file_ext($file->getClientOriginalName());
                $filename_ext = $filename.'.'.$ext;

                $file->storeAs('paginas/'.$page->page_disk.'/'.$section->section_name, $filename_ext, 'site');
            }
            $content->update([
                'content_title' => $request->content_title,
                'content_subtext' => $request->content_subtext,
                'content_description' => $request->content_description,
                'content_url' => $request->content_url,
                'content_image_name' => isset($filename) ? $filename : $content->content_image_name,
                'content_image_alt' => $request->content_image_alt,
                'content_image_filename' => isset($filename_ext) ? $filename_ext : $content->content_image_filename,
                'content_image_width' => $request->content_image_width,
                'content_image_height' => $request->content_image_height,
            ]);

            $notification = array(
                'message' => 'O conteúdo da seção '. $section->section_name. ' na página '. $page->page_name. ' foi atualizado',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard.admin.site.pages.sections.contents.index', ['page' => $page->id, 'section' => $section->id])->with($notification);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function destroy($page_id, $section_id, $id){
        try {
            $page = Page::findOrFail($page_id);
            $section = Section::findOrFail($section_id);
            $content = Content::findOrFail($id);

            $imgPath = 'paginas/'.$page->page_disk.'/'.$section->section_name.'/'.$content->content_image_filename;

            if(Storage::disk('site')->exists($imgPath)){
                Storage::disk('site')->delete($imgPath);
            }

            $content->delete();

            $notification = array(
                'message' => 'O conteúdo selecionado foi removido!',
                'alert-type' => 'warning'
            );

            return response('O conteúdo selecionado foi removido!', 200);

        } catch (\Exception $e) {
            return response((new ExceptionTreatment($e, 'Conteudo'))->getMessage(), 400);
        }
    }
}

@extends('layouts.dashboard.admin', ['title' => 'Freezolar Refrigeração - Administração - Páginas - Adicionar Conteúdo'])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Adicionando Conteúdo em {{$section->section_title}} da Página {{$page->page_name}}</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.pages.index') }}">Páginas</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.pages.sections.index', $page->id) }}">Seções da Página</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.pages.sections.contents.index',['page' => $page->id, 'section' => $section->id]) }}">Conteúdos</a>
                    </li>
                    <li class="breadcrumb-item">Adicionar Conteúdo</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content p-0">
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <form class="mb-5" method="POST" action="{{ route('dashboard.admin.site.pages.sections.contents.store', ['page' => $page->id, 'section' => $section->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 mx-auto text-center">
                                <div id="img-preview" class="pt-3">
                                    <img class="m-2 border" width="200" height="200" src="{{ asset('img/default-placeholder.png') }}">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Imagem</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input fotos" data-toggle="custom-file-input" id="fotos" name="image" onchange="preview_image();" multiple>
                                                <label class="custom-file-label" for="fotos">Escolher arquivos</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="content_image_width">Largura da Imagem (px): </label>
                                            <input type="text" class="form-control" id="content_image_width" name="content_image_width" placeholder="Largura da Imagem..." required value="1680">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="content_image_height">Altura da Imagem (px): </label>
                                            <input type="text" class="form-control" id="content_image_height" name="content_image_height" placeholder="Altura da Imagem..." required value="500">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nome">Nome Alternativo da Imagem: <small style="color:red;"> * </small></label>
                                            <input type="text" class="form-control" id="content_image_alt" name="content_image_alt" title="Caso a imagem não carregue corretamente esse texto irá substituí-la" placeholder="Nome Imagem..." required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="modelo">Título do Conteúdo: </label>
                                            <input type="text" class="form-control" id="content_title" name="content_title" placeholder="Título da Seção..." required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="page_descriptiion">Descrição do Conteúdo</label>
                                    <textarea class="form-control" row="5" name="content_description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

<script>

    function preview_image()
    {
        const parent = document.getElementById("img-preview")
        while (parent.firstChild) {
            parent.firstChild.remove()
        }

        var total_file = document.getElementById("fotos").files.length;

        for(var i=0; i < total_file; i++)
        {
            $('#img-preview').append("<img class='m-2 border' width='200' height='200' src='"+URL.createObjectURL(event.target.files[i])+"'>");
        }
    }

</script>

@endsection

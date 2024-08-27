@extends('layouts.dashboard.admin', ['title' => 'Freezolar Refrigeração - Administração - Páginas'])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Páginas</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Site</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.pages.index') }}">Páginas</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.pages.create') }}">Adicionar</a>
                    </li>
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
                    <!-- Form Labels on top - Default Style -->
                    <form class="mb-5" method="POST" action="{{ route('dashboard.admin.site.pages.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="post_title">Nome da Página: <small style="color:red">*</small></label>
                                            <input type="text" class="form-control" id="page_name" name="page_name" value="{{old('page_name') }}" placeholder="Nome da Página..." required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="page_title">Titulo da Página: <small style="color:red">*</small></label>
                                            <input type="text" class="form-control" id="page_title" name="page_title" value="{{old('page_title') }}" placeholder="Título do Artigo..." required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="descricao">Descrição da Página</label>
                                            <textarea class="form-control form-control-alt" id="page_description" name="page_description" rows="4" placeholder="Resumo sobre o que é a Página">{{ old('page_description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Imagem de Destaque: <small style="color:red">*</small></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="page_image" name="page_image">
                                                <label class="custom-file-label" for="logo">Escolher</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="post_keywords">Palavras-chaves: </label>
                                            <input type="text" class="form-control" id="post_keywords" name="post_keywords" placeholder="Palavras-chaves separadas por vírgula..." value="{{old('post_keywords') }}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Publicar</button>
                                        </div>
                                    </div>
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

    $(document).ready(function(){
        One.helpers(['select2']);
        // Define function to open filemanager window
        CKEDITOR.replace( 'ckeditor', {
            height: 600,
            filebrowserImageBrowseUrl: '/filemanager?type=Images',
            filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/filemanager?type=Files',
            filebrowserUploadUrl: '/filemanager/upload?type=Files&_token={{csrf_token()}}',
            extraPlugins: 'stylesheetparser, ckeditorfa, image2, youtube',
            allowedContent: true,
            contentsCss: '{{ asset("cs/font-awesome/fontawesome-all.min.css") }}',
            contentsCss: '{{ asset("css/mdb.min.css") }}',
            youtube_width: '640',
            youtube_height: '480',
            youtube_responsive: true,
            youtube_related: false,
            youtube_autoplay: false,
            youtube_controls: true,
        });

    });
</script>

@endsection

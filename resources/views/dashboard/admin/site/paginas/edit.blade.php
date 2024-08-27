@extends('layouts.dashboard.admin', ['title' => 'Freezolar Refrigeração - Administração - Páginas - Editar Página'])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Editando Página - {{$page->page_name}}</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.pages.index') }}">Páginas</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.pages.edit', $page->id) }}">Editar</a>
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
                    <form class="mb-5" method="POST" action="{{ route('dashboard.admin.site.pages.update', $page->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row justify-content-center">
                            <div class="col-lg-10 text-center">
                                <h6>Campos com <small style="color: red;"> * </small>São obrigatórios</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="page_name">Nome da Página: <small style="color:red;"> * </small></label>
                                    <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Nome da Página..." value="{{$page->page_name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="page_title">Título da Página: <small style="color:red;"> * </small></label>
                                    <input type="text" class="form-control" id="page_title" name="page_title" placeholder="Título da Página..." required value="{{$page->page_title}}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="modelo">URL Amigável: </label>
                                    <input type="text" class="form-control" placeholder="URL Amigável..." value="{{ $page->page_slug}}" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="page_description">Descrição da Página</label>
                                    <textarea class="ckeditor" name="page_description">{!! $page->page_description !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
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

    $(document).ready(function(){
        One.helpers(['select2']);
        // Define function to open filemanager window
        CKEDITOR.replace( 'ckeditor', {
            height: 100,
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
            toolbar: [
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'] },
                '-',
                { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
                [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'],
                [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak', 'Iframe' ],
                { name: 'document', items: [ 'Source', '-','Preview', '-', 'Templates' ] },
            ]
        });
    });


    function preview_image()
    {
        const parent = document.getElementById("img-preview")
        while (parent.firstChild) {
            parent.firstChild.remove()
        }

        var total_file = document.getElementById("fotos").files.length;

        for(var i=0; i < total_file; i++)
        {
            $('#img-preview').append("<img class='m-2 border' width='120' height='120' src='"+URL.createObjectURL(event.target.files[i])+"'>");
        }
    }

    // Adicionar atributos -- ficha técnica do produto
    var count = $('#item-add tbody tr').length;
    var index = 0;

    function newMenuItem() {
        var newElem = $('tr.list-item').first().clone();
        newElem.find('input:text').val('');
        newElem.find('input:text').removeAttr('name');
        newElem.appendTo('table#item-add');
        count = count + 1;
        index = index + 1;

        var input0 = newElem.find('input')[0];
        var input1 = newElem.find('input')[1];
        $(input0).attr('name', 'atributos['+index+'][atributo]');
        $(input1).attr('name', 'atributos['+index+'][valor]');
    }

    if ($("table#item-add").is('*')) {
        $('.add-item').on('click', function (e) {
            e.preventDefault();
            newMenuItem();
        });

        $(document).on("click", "#item-add .delete", function (e) {
            if(count > 1){
                e.preventDefault();
                $(this).parent().parent().parent().parent().parent().remove();
                count = count - 1;
            }
        });
    }

</script>

@endsection

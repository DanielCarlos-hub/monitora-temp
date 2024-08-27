@extends('layouts.dashboard.admin', ['title' => 'Freezolar Refrigeração - Administração - Catálogo - Adicionar Produto'])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Adicionar Produto</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Site</li>
                    <li class="breadcrumb-item">Catálogo</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.catalogo.produtos.index') }}">Produtos</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.catalogo.produtos.create') }}">Adicionar</a>
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
                    <form class="mb-5" method="POST" action="{{ route('dashboard.admin.site.catalogo.produtos.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-lg-10 text-center">
                                <h6>Campos com <small style="color: red;"> * </small>São obrigatórios</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="codigo">Código do Produto: </label>
                                    <input type="text" class="form-control" id="codigo" name="product[codigo]" placeholder="Código do Produto...">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nome">Nome do Produto: <small style="color:red;"> * </small></label>
                                    <input type="text" class="form-control" id="nome" name="product[nome]" placeholder="Nome do Produto..." required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="modelo">Modelo: </label>
                                    <input type="text" class="form-control" id="modelo" name="product[modelo]" placeholder="Modelo do Produto...">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="preco">Preço: </label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    R$
                                                </span>
                                            </div>
                                            <input type="text" class="form-control money" id="preco" name="product[preco]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="category_id">Categorias <small style="color:red">*</small></label>
                                    <select class="js-select2 form-control" id="category_id" name="category_id[]" style="width: 100%;" data-placeholder="Selecione mais de uma se for preciso" title="Selecione mais de uma se for preciso" multiple>
                                        <option></option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="category_id">Exibir Produto no Site? <small style="color:red">*</small></label>
                                    <select class="form-control" id="exibir" name="product[exibir]" style="width: 100%;" >
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="mostrar_preco">Exibir Preço do Produto? <small style="color:red">*</small></label>
                                    <select class="form-control" id="mostrar_preco" name="product[mostrar_preco]" style="width: 100%;">
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Imagens do produto</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input fotos" data-toggle="custom-file-input" id="fotos" name="fotos[]" onchange="preview_image();" multiple>
                                        <label class="custom-file-label" for="fotos">Escolher arquivos</label>
                                    </div>
                                    <div id="img-preview" class="pt-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="descricao">Descrição do produto</label>
                                    <textarea id="ckeditor" name="product[descricao]">{!! old('post_body') !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Informações Técnicas do Produto</label>
                            </div>

                            <div class="col-lg-10">
                                <div class="form-group">
                                    <table id="item-add" style="width:100%;">
                                        <tr class="list-item">
                                            <td>
                                                <div class="row">
                                                    <div class="col-12 col-md-5 col-lg-4">
                                                        <label for="curso" class="col-form-label p-0">Atributo</label>
                                                        <input type="text" class="form-control" maxlength="255" name="atributos[0][atributo]" placeholder="Ex.: Medida, Peso, Voltagem" value="">
                                                    </div>
                                                    <div class="col-12 col-md-5 col-lg-7">
                                                        <label for="curso" class="col-form-label p-0">Valor</label>
                                                        <input type="text" class="form-control" name="atributos[0][valor]" placeholder="Ex.: 1.85M, 15KG, 127V" value="">
                                                    </div>
                                                    <div class="col-12 col-md-2 col-lg-1">
                                                        <label class="col-form-label p-0"></label>
                                                        <div class="form-group">
                                                            <button type="button" class="delete" style=" cursor: pointer;" ><i class="far fa-trash-alt"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <button type="button" class="btn btn-secondary add-item mr-2"><i class="fa fa-fw fa-plus-circle"></i>Adicionar</button>
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
    $(document).ready(function(){
        One.helpers(['select2']);
        // Define function to open filemanager window
        CKEDITOR.replace( 'ckeditor', {
            height: 300,
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

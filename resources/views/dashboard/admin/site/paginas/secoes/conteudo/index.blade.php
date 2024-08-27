@extends('layouts.dashboard.admin', ['title' => 'Freezolar Refrigeração - Administração - Páginas'])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Listando {{$section->section_title}} da Página {{$page->page_name}}</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.pages.index') }}">Páginas</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.pages.sections.index', $page->id) }}">Seções</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.pages.sections.contents.index',['page' => $page->id, 'section' => $section->id]) }}">Conteúdo</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content p-0">
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row pb-3">
                <div class="col-md-12">
                    <a class="btn btn-info btn-sm m-1" role="button" href="{{ route("dashboard.admin.site.pages.sections.contents.create", ['page' => $page->id, 'section' => $section->id]) }}"><i class="fa fa-plus"> </i> Adicionar </a>
                </div>
            </div>
            <table id="sections" class="display data-table responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="desktop">Imagem</th>
                        <th class="desktop">Titulo</th>
                        <th class="desktop">Descrição</th>
                        <th class="desktop">Data de Criação</th>
                        <th class="desktop"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal para deletar -->
<div class="modal fade" id="deleteContent" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="formDeleteContent" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="title"></h5>
                    <i class="fas fa-window-close close" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div id="body">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Sim</button>
                    <button type="cancel" class="btn btn-primary" data-dismiss="modal">Não</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')

    <script>

        config = {
            route: {
                index: '{{ route("dashboard.admin.site.pages.sections.contents.index", ["page" => $page->id, "section" => $section->id]) }}',
                show: '{{ route("dashboard.admin.site.pages.sections.contents.show", ["page" => $page->id, "section" => $section->id, "content" => ":id"]) }}',
                edit: '{{ route("dashboard.admin.site.pages.sections.contents.edit", ["page" => $page->id, "section" => $section->id, "content" => ":id"]) }}',
                destroy: '{{ route("dashboard.admin.site.pages.sections.contents.destroy", ["page" => $page->id, "section" => $section->id, "content"=> ":id"]) }}',
            },
            assets: {
                datatables: "{{ asset('Portuguese-Brasil.json') }}",
            }
        }
        $(document).ready(function(){

            $('.data-table').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                ajax:{
                    url: config.route.index,
                },
                "ordering": false,
                "paginate": false,
                "searching": true,
                "dom": "lrtip",
                "language": {
                    "url": config.assets.datatables
                },
                "columnDefs": [
                    {
                        "targets": 0,
                        "width": "20px",
                        "data": "content_title",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            if('{{$section->section_name}}' !== 'banners'){
                                return '<img src="/storage/site/paginas/home/{{$section->section_name}}/'+row.content_image_filename+'" width="'+row.content_image_width+'" height="'+row.content_image_height+'" alt="'+row.content_image_alt+'">';

                            }else{
                                return '<img src="/storage/site/paginas/home/banners/'+row.content_image_filename+'" width="180" height="112" alt="'+row.content_image_alt+'">';
                            }

                        }
                    },
                    {
                        "targets": 1,
                        "width": "150px",
                        "data": "content_title",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 2,
                        "width": "150px",
                        "data": "content_description",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 3,
                        "width": "100px",
                        "data": "created_at",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return datetimePTBR(data);
                        }
                    },
                    {
                        "targets": 4,
                        "width": "100px",
                        "className": "text-center",
                        "data": "id",
                        "searchable": false,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return '<a href="'+config.route.edit.replace(':id', data)+'" title="Editar" role="button" class="btn btn-sm btn-warning mr-1"><i class="fas fa-pencil-alt"></i></a>'+
                            '<button title="Remover" role="button" class="btn btn-sm btn-danger mr-1" onClick="deleteContent('+data+')"><i class="fas fa-trash-alt"></i></button>';
                        }
                    },
                ],
            });
        });

        function deleteContent(id){

            title = 'Remover o banner do site ?';
            body = '<input type="hidden" id="content_id" name="content_id" class="form-control" value='+id+'>';
            body += 'Tem certeza em executar a remoção do banner do site?';
            $('#title').html(title);
            $('#body').html(body);
            $('#deleteContent').modal('show');
       }

        function destroyContent(id){

            var url = config.route.destroy.replace(':id', id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type: "DELETE",
                url: url,
                success: function(response){
                    $("#deleteContent").modal('hide');
                    toastr.success(response);
                    $('.data-table').DataTable().ajax.reload(null, false);
                },
                error: function (xhr) {
                    $("#deleteContent").modal('hide');
                    toastr.error(xhr.responseText);
                }
            });
        }

        $('#formDeleteContent').on("submit", function(event){
            event.preventDefault();
            if($('#content_id').val() != ''){
                destroyContent($('#content_id').val());
            }
            $('#content_id').val('');

            $('#formDeleteContent')[0].reset();
        });

        $('#deleteContent').on('hide.bs.modal', function (event) {
            $('#formDeleteContent')[0].reset();
        });
    </script>

@endsection

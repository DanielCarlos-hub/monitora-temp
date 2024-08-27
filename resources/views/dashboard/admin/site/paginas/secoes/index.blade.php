@extends('layouts.dashboard.admin', ['title' => 'Freezolar Refrigeração - Administração - Páginas'])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Seções da Página {{$page->page_name}}</h1>
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
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content p-0">
    <div class="block">
        <div class="block-content block-content-full">
            <table id="sections" class="display data-table responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="desktop">Nome da Seção</th>
                        <th class="desktop">Titulo</th>
                        <th class="desktop">Data de Criação</th>
                        <th class="desktop"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@section('javascript')

    <script>

        config = {
            route: {
                index: '{{ route("dashboard.admin.site.pages.sections.index", $page->id) }}',
                contents: '{{ route("dashboard.admin.site.pages.sections.contents.index", ["page" => $page->id, "section" => ":id"]) }}',
                edit: '{{ route("dashboard.admin.site.pages.sections.edit", ["page" => $page->id, "section" => ":id"]) }}',
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
                        "width": "100px",
                        "data": "section_name",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 1,
                        "width": "150px",
                        "data": "section_title",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 2,
                        "width": "50px",
                        "data": "created_at",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return datetimePTBR(data);
                        }
                    },
                    {
                        "targets": 3,
                        "width": "50px",
                        "className": "text-center",
                        "data": "id",
                        "searchable": false,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return '<a href="'+config.route.contents.replace(':id', data)+'" title="Ir para Conteúdo dessa Seção dessa Página" role="button" class="btn btn-sm btn-info mr-1"><i class="fas fa-sign-in-alt"></i></a>'+'<a href="'+config.route.edit.replace(':id', data)+'" title="Editar" role="button" class="btn btn-sm btn-warning mr-1"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    },
                ],
            });
        });

    </script>

@endsection

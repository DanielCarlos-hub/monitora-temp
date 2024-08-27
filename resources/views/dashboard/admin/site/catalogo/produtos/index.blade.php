@extends('layouts.dashboard.admin', ['title' => 'Freezolar Refrigeração - Administração - Catálogo - Lista de Produtos'])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Lista de Produtos</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Site</li>
                    <li class="breadcrumb-item">Catálogo</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.catalogo.produtos.index') }}">Produtos</a>
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
                    <a class="btn btn-info btn-sm m-1" role="button" href="{{ route("dashboard.admin.site.catalogo.produtos.create") }}"><i class="fa fa-plus"> </i> Adicionar </a>
                </div>
            </div>
            <div class="row pb-3 justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="p-1 rounded rounded-pill shadow-sm bg-light">
                        <div class="input-group">
                            <div class="input-group-append">
                                <div id="button-addon1" class="btn btn-link text-primary" style="cursor: default;"><i class="fa fa-search"></i></div>
                            </div>
                            <input type="search" placeholder="Pesquisar" aria-describedby="button-addon1" class="form-control border-0" id="filter">
                        </div>
                    </div>
                </div>
            </div>

            <table id="produtos" class="display data-table responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="all">Código</th>
                        <th class="all">Nome</th>
                        <th class="desktop">Exbir no Site?</th>
                        <th class="desktop">Exibir Preço?</th>
                        <th class="desktop">Data do Registro</th>
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
                index: '{{ route("dashboard.admin.site.catalogo.produtos.index") }}',
                show: '{{ route("site.produtos.show", ":slug") }}',
                edit: '{{ route("dashboard.admin.site.catalogo.produtos.edit", ":id") }}',
                disable: '{{ route("dashboard.admin.site.catalogo.produtos.disable", ":id") }}',
                enable: '{{ route("dashboard.admin.site.catalogo.produtos.enable", ":id") }}',
                price_disable: '{{ route("dashboard.admin.site.catalogo.produtos.price_disable", ":id") }}',
                price_enable: '{{ route("dashboard.admin.site.catalogo.produtos.price_enable", ":id") }}',
            },
            assets: {
                datatables: "{{ asset('Portuguese-Brasil.json') }}",
            }
        }
        $(document).ready(function(){

            $('#produtos').DataTable({
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
                        "width": "50px",
                        "data": "codigo",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 1,
                        "width": "200px",
                        "data": "nome",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 2,
                        "width": "75px",
                        "data": "exibir",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            if(data == '1')
                                return 'Sim';
                            else
                                return 'Não';
                        }
                    },
                    {
                        "targets": 3,
                        "width": "75px",
                        "data": "mostrar_preco",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            if(data == '1')
                                return 'Sim';
                            else
                                return 'Não';
                        }
                    },
                    {
                        "targets":4,
                        "width": "100px",
                        "data": "created_at",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return datetimePTBR(data);
                        }
                    },
                    {
                        "targets": 5,
                        "width": "100px",
                        "data": "id",
                        "searchable": false,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {

                            var exibir = '';
                            var exibir_preco = '';

                            if(row.exibir == 1){
                                exibir = '<a href="'+config.route.disable.replace(':id', data)+'" title="Desativar Exibição do Produto no Site" role="button" class="btn btn-sm btn-info mr-1"><i class="fa fa-lock"></i></a>';

                            }else{
                                exibir = '<a href="'+config.route.enable.replace(':id', data)+'" title="Ativar Exibição do Produto no Site" role="button" class="btn btn-sm btn-info mr-1"><i class="fa fa-lock-open"></i></a>'
                            }

                            if(row.mostrar_preco == 1){
                                exibir_preco = '<a href="'+config.route.price_disable.replace(':id', data)+'" title="Desativar Exibição do Preço do Produto" role="button" class="btn btn-sm btn-info mr-1"><i class="fa fa-dollar-sign"></i></a>';

                            }else{
                                exibir_preco = '<a href="'+config.route.price_enable.replace(':id', data)+'" title="Ativar Exibição do Preço do Produto" role="button" class="btn btn-sm btn-info mr-1"><i class="fa fa-dollar-sign"></i></a>';
                            }

                            return '<a href="'+config.route.show.replace(':slug', row.slug)+'" target="_blank" title="Visualizar" role="button" class="btn btn-sm btn-success mr-1"><i class="fas fa-eye"></i></a>'+'<a href="'+config.route.edit.replace(':id', data)+'" title="Editar" role="button" class="btn btn-sm btn-warning mr-1"><i class="fas fa-pencil-alt"></i></a>'+exibir+exibir_preco;
                        }
                    },
                ],
            });
        });
        $('#filter').keyup(function(){
            $('#produtos').DataTable().search($(this).val()).draw();
        });
    </script>

@endsection

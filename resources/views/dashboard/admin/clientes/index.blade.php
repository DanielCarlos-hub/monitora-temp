@extends('layouts.dashboard.admin', ["title" => "Freezolar Refrigeração - Administração - Clientes"])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Clientes</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Administração</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.clientes.index') }}">Clientes</a>
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
                <div class="col-md-3">
                    <a class="btn btn-info btn-sm" role="button" href="{{ route("dashboard.admin.clientes.create") }}"> <i class="fas fa-plus"></i> Adicionar</a>
                </div>
            </div>
            <table id="clientes" class="display data-table responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="all">CNPJ / CPF</th>
                        <th class="desktop">Nome Fantasia</th>
                        <th class="desktop">Cel SMS 1</th>
                        <th class="desktop">Cel SMS 2</th>
                        <th class="desktop">Cel SMS 3</th>
                        <th class="desktop">Financeiro</th>
                        <th class="desktop">Ações</th>
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
                index: '{{ route("dashboard.admin.clientes.index") }}',
                edit: '{{ route("dashboard.admin.clientes.edit", ":id") }}',
                show: '{{ route("dashboard.admin.clientes.show", ":id") }}',
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
                lengthMenu: [[100, 200, -1], [100, 200, "Todos"]],
                "paginate": true,
                "pageLength": 20,
                "searching": true,
                "dom": "lBrtip",
                "language": {
                    "url": config.assets.datatables
                },
                buttons: [{
                    extend: 'collection',
                    className: 'exportButton',
                    text: 'Exportar Dados',
                    buttons: [
                        {
                            extend:'excel',
                            "text": 'XLS',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3]
                            },
                            //"action": newexportaction

                        },
                        {
                            extend:'pdf',
                            "text": 'PDF',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3]
                            },
                            customize: function (doc) {
                                doc.content.splice(0,1);
                                doc.defaultStyle.fontFamily = 'Roboto';
                                doc.defaultStyle.fontSize = 8;
                                doc.content[0].margin = [ -10, 0, -10, 0 ] //left, top, right, bottom
                                doc.pageSize = 'A4';
                                doc.content[0].table.widths = [ '25%', '15%', '25%', '15%', '20%'];

                                var now = new Date();
                                var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
                                doc.footer = (function(page, pages) {
                                    return {
                                        columns: [
                                            {
                                                alignment: 'left',
                                                text: ['Criado em: ', { text: jsDate.toString() }]
                                            },
                                            {
                                                alignment: 'right',
                                                text: ['pagina ', { text: page.toString() },	' de ',	{ text: pages.toString() }]
                                            }
                                        ],
                                        margin: 20
                                    }
                                });

                                var objLayout = {};
                                objLayout['hLineWidth'] = function(i) { return .5; };
                                objLayout['vLineWidth'] = function(i) { return .5; };
                                objLayout['hLineColor'] = function(i) { return '#aaa'; };
                                objLayout['vLineColor'] = function(i) { return '#aaa'; };
                                objLayout['paddingLeft'] = function(i) { return 10; };
                                objLayout['paddingRight'] = function(i) { return 10; };
                                doc.content[0].layout = objLayout;
                            },
                            //"action": newexportaction

                        },
                        {
                            extend:'csv',
                            "text": 'CSV',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3 ]
                            },
                            //"action": newexportaction

                        },
                        {
                            extend:'copy',
                            "text": 'Copiar',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3 ]
                            },
                            //"action": newexportaction

                        },
                        {
                            extend:'print',
                            "text": 'Imprimir',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3 ]
                            },
                            //"action": newexportaction

                        }
                    ]
                }],
                "columnDefs": [
                    {
                        "targets": 0,
                        "width": "50px",
                        "data": "cnpj",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 1,
                        "width": "200px",
                        "data": "fantasia",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 2,
                        "width": "75px",
                        "data": "fonesms1",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 3,
                        "width": "75px",
                        "data": "fonesms2",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 4,
                        "width": "75px",
                        "data": "fonesms3",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 5,
                        "width": "75px",
                        "data": "active",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            if(data == 1){
                                return '<span class="badge badge-success">Liberado</span>';
                            }else{
                                return '<span class="badge badge-danger">Bloqueado</span>';
                            }
                        }
                    },
                    {
                        "targets": 6,
                        "width": "50px",
                        "data": "id",
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return '<a href="'+config.route.show.replace(':id', data)+'" title="Visualizar" role="button" class="btn btn-sm mr-1"><i class="fas fa-search"></i></a>'+'<a href="'+config.route.edit.replace(':id', data)+'" title="Editar" role="button" class="btn btn-sm mr-1"><i class="fa fa-edit"></i></a>';
                        }
                    }
                ],
            });
        });

    </script>

@endsection

@extends('layouts.dashboard.admin', ['title' => 'Freezolar Refrigeração - Administração - Usuários'])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Lista de Usuários</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Administração</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.usuarios.index') }}">Usuários</a>
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
                    <a class="btn btn-info btn-sm" role="button" href="{{ route("dashboard.admin.usuarios.create") }}"><i class="fa fa-plus"> </i> Adicionar</a>
                </div>
            </div>
            <table id="usuarios" class="display data-table responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="desktop">Nome</th>
                        <th class="desktop">Email</th>
                        <th class="desktop">Usuário</th>
                        <th class="desktop">Cadastrado em</th>
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
                index: '{{ route("dashboard.admin.usuarios.index") }}',
                edit: '{{ route("dashboard.admin.usuarios.edit", ":id") }}',
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
                        "width": "200px",
                        "data": "nome",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 1,
                        "width": "100px",
                        "data": "email",
                        "searchable": true,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return data;
                        }
                    },
                    {
                        "targets": 2,
                        "width": "100px",
                        "data": "username",
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
                        "width": "50px",
                        "className": "text-center",
                        "data": "id",
                        "searchable": false,
                        "orderable": false,
                        "render": function ( data, type, row, meta ) {
                            return '<a href="'+config.route.edit.replace(':id', data)+'" title="Editar" role="button" class="btn btn-sm btn-warning mr-1"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    },
                ],
            });
        });

    </script>

@endsection

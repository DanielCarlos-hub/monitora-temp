@extends('layouts.dashboard.monitoramento', ["title" => "Freezolar Refrigeração - Monitoramento - Notificações do Equipamento"])

@section('content')
<!-- Hero -->
<div class="bg-image" style="background-image: url( '{{ asset('dashboard/media/photos/photo17@2x.jpg') }}');">
    <div class="bg-black-50">
        <div class="content content-narrow content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mb-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <div class="my-3">
                        <img class="img-avatar img-avatar-thumb" src="{{ asset('dashboard/media/avatars/avatar0.jpg') }}" alt="">
                    </div>
                    <h1 class="font-w600 text-white mb-0 js-appear-enabled animated fadeIn" data-toggle="appear">{{$tenant->fantasia}}</h1>
                    <h2 class="h4 font-w400 text-white-75 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">{{$tenant->fonesms1}} / {{$tenant->fonesms2}} / {{$tenant->fonesms3}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-white border-bottom">
    <div class="content content-boxed p-0 pt-2">
        <div class="row items-push text-center">
            <div class="col-12 col-md-12">
                <div class="font-size-sm font-w600 text-muted text-uppercase">{{$equipamento->nome_equipamento}} <small>{{$equipamento->num_placa}}</small></div>
            </div>
        </div>
    </div>
</div>

<div class="content content-full">
    <h2 class="content-heading">Notificações do Equipamento</h2>
    <div class="row text-center">
        <div class="col-12 col-md-12 mb-1">
            <a class="btn btn-sm btn-warning" href="{{ route('dashboard.monitoramento.clientes.show', $tenant->id) }}">Voltar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="notifications" class="table table-striped table-bordered data-table responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="all">Servico</th>
                        <th class="all">Telefone</th>
                        <th class="desktop">Mensagem</th>
                        <th class="desktop">Status</th>
                        <th class="desktop">Data e hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipamento->notifications as $notification)
                    <tr>
                        <td>{{$notification->servico}}</td>
                        <td>{{$notification->telefone}}</td>
                        <td>{{$notification->mensagem}}</td>
                        <td>{{$notification->status}}</td>
                        <td>{{ConverteData($notification->created_at)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function(){

            $('#notifications').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                "ordering": false,
                "paginate": true,
                "pageLength": 30,
                "searching": true,
                "dom": "tip",
                "language": {
                    "url": "{{ asset('Portuguese-Brasil.json') }}"
                },
            });
        });
    </script>
@endsection

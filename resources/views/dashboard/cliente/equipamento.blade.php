@extends('layouts.dashboard.cliente', ["title" => "Freezolar Refrigeração - Cliente - Equipamento"])

@section('content')
<!-- Hero -->
<div class="bg-image" style="background-image: url( '{{ asset('dashboard/media/photos/photo17@2x.jpg') }}');">
    <div class="bg-black-50">
        <div class="content content-narrow content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mb-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <div class="my-3">
                        <img class="img-avatar img-avatar-thumb" src="@if(!is_null($cliente->logo)) /storage/clientes/{{$cliente->logo}} @else {{ asset('dashboard/media/avatars/avatar0.jpg') }} @endif" alt="Logo">
                    </div>
                    <h1 class="font-w600 text-white mb-0 js-appear-enabled animated fadeIn" data-toggle="appear">{{$cliente->fantasia}}</h1>
                    <h2 class="h4 font-w400 text-white-75 mb-0 js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="250">{{$cliente->fonesms1}} / {{$cliente->fonesms2}} / {{$cliente->fonesms3}}</h2>
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

<div class="content">
    <h2 class="content-heading">Temperaturas</h2>
    <div class="row text-center">
        <div class="col-12 col-md-12 mb-1">
            <a class="btn btn-sm btn-warning" href="{{ route('cliente.home', request()->tenant) }}">Voltar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="temperaturas" class="table table-striped table-bordered data-table responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="all">Placa</th>
                        <th class="all">Temperatura</th>
                        <th class="desktop">Data e hora</th>
                        <th class="desktop">Notificado?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipamento->temperaturas as $temperatura)
                    <tr>
                        <td>{{$equipamento->num_placa}}</td>
                        <td>{{$temperatura->temperatura}}</td>
                        <td>{{ConverteData($temperatura->created_at)}}</td>
                        <td>@if($temperatura->notificado == 1) Sim @else Não @endif</td>
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

            $('#temperaturas').DataTable({
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

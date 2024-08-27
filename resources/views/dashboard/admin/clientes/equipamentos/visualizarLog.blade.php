@extends('layouts.dashboard.admin', ["title" => "Freezolar Refrigeração - Administração - Logs do Equipamento"])

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
    <h2 class="content-heading">Logs do Equipamento</h2>
    <div class="row text-center">
        <div class="col-12 col-md-12 mb-1">
            <a class="btn btn-sm btn-warning" href="{{ route('dashboard.admin.clientes.equipamentos.logs', ['cliente' => $tenant->id, 'equipamento' => $equipamento->id]) }}">Voltar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>Log #</label>
                <input type="text" class="form-control" value="{{$log->id}}" disabled>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>Mensagem </label>
                <input type="text" class="form-control" value="{{ $log->message }}" disabled>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>Data e Hora</label>
                <input type="text" class="form-control" value="{{ConverteData($log->created_at)}}" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>Código do Erro</label>
                <input type="text" class="form-control" value="{{$log->backend->error_code}}" disabled>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label>Arquivo do Erro</label>
                <input type="text" class="form-control" value="{{$log->backend->error_file}}" disabled>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label>Classe do Erro</label>
                <input type="text" class="form-control" value="{{$log->backend->error_class}}" disabled>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Mensagem do Erro</label>
                <textarea class="form-control" rows="2" disabled>{{$log->backend->error_message}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Rastro do Erro</label>
                <textarea class="form-control" rows="20" disabled>{{$log->backend->error_trace}}</textarea>
            </div>
        </div>
    </div>
<div>
@endsection

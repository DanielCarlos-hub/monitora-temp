@extends('layouts.dashboard.monitoramento', ["title" => "Freezolar Refrigeração - Monitoramento - Notificações"])

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

<div class="content">
    <h2 class="content-heading">Temperaturas</h2>
    <div class="row text-center">
        <div class="col-12 col-md-12 mb-1">
            <a class="btn btn-sm btn-warning" href="{{ route('dashboard.monitoramento.clientes.show', $tenant->id) }}">Voltar</a>
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

<div class="modal" id="addEquipamento" tabindex="-1" role="dialog" aria-labelledby="addEquipamento" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content ">
            <form class="form-horizontal" id="formCliente" method="post" action="{{route('dashboard.monitoramento.clientes.equipamentos.store', $tenant->id) }}" autocomplete="off">
                @csrf
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="formTitle">Adicionar Equipamento</h5>
                    <i class="fas fa-window-close close" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body pt-0 pb-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" id="id" class="form-control">
                                    <div class="form-group row mb-0">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <label for="nome_equipamento" class="control-label col-form-label" style="padding-left: 15px;">Nome do Equipamento</label>
                                            <div class="col-12 p-0">
                                                <input type="text" class="form-control" name="nome_equipamento" id="nome_equipamento" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <label for="tipo_id" class="control-label col-form-label" style="padding-left: 15px;">Tipo de Equipamento</label>
                                            <div class="col-sm-12 p-0">
                                                <select class="form-control" name="tipo_id" id="tipo_id" style="width: 100%;">
                                                    <option value="">-- Não Selecionado --</option>
                                                    @foreach($tipos as $tipo)
                                                        <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <label for="cnpj" class="control-label col-form-label" style="padding-left: 15px;">Serial Placa</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control" name="num_placa" id="num_placa">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <label for="temperatura_min" class="control-label col-form-label" style="padding-left: 15px;">Temperatura Mínima</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="number" class="form-control" step="0.50" name="temperatura_min" id="temperatura_min">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <label for="temperatura_max" class="control-label col-form-label" style="padding-left: 15px;">Temperatura Máxima</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="number" class="form-control" step="0.50" name="temperatura_max" id="temperatura_max">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <label for="temperatura_crit" class="control-label col-form-label" style="padding-left: 15px;">Temperatura Crítica</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="number" class="form-control" step="0.50" name="temperatura_crit" id="temperatura_crit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Gravar Dados</button>
                    <button type="cancel" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
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

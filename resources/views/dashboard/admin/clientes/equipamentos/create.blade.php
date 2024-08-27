@extends('layouts.dashboard.admin', ["title" => "Freezolar Refrigeração - Administração - Cadastrar Equipamento"])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Equipamentos</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Administração</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.clientes.index') }}">Clientes</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.clientes.show', $tenant->id) }}">{{$tenant->id}}</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.clientes.equipamentos.index', $tenant->id) }}">Equipamentos</a>
                    </li>
                    <li class="breadcrumb-item">Adicionar</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content p-0">
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row pb-3">
                <div class="col-12">
                    <form class="form-horizontal" method="post" autocomplete="off" action="{{ route('dashboard.admin.clientes.equipamentos.store', $tenant->id) }}">
                        @csrf
                        <div class="form-group row justify-content-center">
                            <div class="col-md-12 col-lg-10">
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
                                            <select class="form-control" name="tipo_id" id="tipo_id" style="width: 100%;" required>
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
                                            <input type="text" class="form-control" name="num_placa" id="num_placa" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="temperatura_min" class="control-label col-form-label" style="padding-left: 15px;">Temp Mínima</label>
                                        <div class="col-sm-12 p-0">
                                            <input type="number" class="form-control" step="0.50" name="temperatura_min" id="temperatura_min">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="temperatura_max" class="control-label col-form-label" style="padding-left: 15px;">Temp Máxima</label>
                                        <div class="col-sm-12 p-0">
                                            <input type="number" class="form-control" step="0.50" name="temperatura_max" id="temperatura_max">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="temperatura_crit_min" class="control-label col-form-label" style="padding-left: 15px;">Temp Crítica MIN</label>
                                        <div class="col-sm-12 p-0">
                                            <input type="number" class="form-control" step="0.50" name="temperatura_crit_min" id="temperatura_crit_min">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="temperatura_crit_max" class="control-label col-form-label" style="padding-left: 15px;">Temp Crítica MAX</label>
                                        <div class="col-sm-12 p-0">
                                            <input type="number" class="form-control" step="0.50" name="temperatura_crit_max" id="temperatura_crit_max">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center pt-2">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

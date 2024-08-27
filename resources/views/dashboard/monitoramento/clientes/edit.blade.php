@extends('layouts.dashboard.monitoramento', ["title" => "Freezolar Refrigeração - Monitoramento - Cadastrar Cliente"])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Clientes</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Monitoramento</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.monitoramento.clientes.index') }}">Clientes</a>
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
                    <form class="form-horizontal" method="post" autocomplete="off" action="{{ route('dashboard.monitoramento.clientes.update', $tenant->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <div class="col-md-12 col-lg-12">
                                <div class="card px-5">
                                    <div class="card-body">
                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-5">
                                                <label for="fantasia" class="control-label col-form-label" style="padding-left: 15px;">Nome Fantasia</label>
                                                <div class="col-12 p-0">
                                                    <input type="text" class="form-control" name="fantasia" id="fantasia" value="{{ $tenant->fantasia }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <label for="cnpj" class="control-label col-form-label" style="padding-left: 15px;">CNPJ</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="cnpj" id="cnpj" value="{{ $tenant->cnpj }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label for="fonesms1" class="control-label col-form-label" style="padding-left: 15px;">Celular SMS 1</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="fonesms1" id="fonesms1" value="{{ $tenant->fonesms1 }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label for="fonesms2" class="control-label col-form-label" style="padding-left: 15px;">Celular SMS 2</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="fonesms2" id="fonesms2" value="{{ $tenant->fonesms2 }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label for="fonesms3" class="control-label col-form-label" style="padding-left: 15px;">Celular SMS 3</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="fonesms3" id="fonesms3" value="{{ $tenant->fonesms3 }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <label for="email" class="control-label col-form-label" style="padding-left: 15px;">Email</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="email" class="form-control" name="email" id="email" value="{{ $tenant->email }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label for="ativo" class="control-label col-form-label" style="padding-left: 15px;">Status Financeiro</label>
                                                <div class="col-sm-12 p-0">
                                                    <select class="form-control" name="status_financeiro" id="status_financeiro" style="width: 100%;">
                                                        <option value="">-- Não Selecionado --</option>
                                                        <option value="1" {{ $tenant->active == 1 ? 'selected' : ''}}>LIBERADO</option>
                                                        <option value="0" {{ $tenant->active == 0 ? 'selected' : ''}}>BLOQUEADO</option>
                                                    </select>
                                                </div>
                                            </div>
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

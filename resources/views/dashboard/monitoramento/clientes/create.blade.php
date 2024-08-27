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
                    <form class="form-horizontal" method="post" autocomplete="off" action="{{ route('dashboard.monitoramento.clientes.store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12 col-lg-12">
                                <div class="card px-5">
                                    <div class="card-body">
                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <label for="razao_social" class="control-label col-form-label" style="padding-left: 15px;">Nome Identificador</label>
                                                <div class="col-12 p-0">
                                                    <input type="text" class="form-control" name="nome" id="nome" value="{{ old("nome") }}" placeholder="Um Nome simples para identificar o Cliente" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <label for="fantasia" class="control-label col-form-label" style="padding-left: 15px;">Nome Fantasia</label>
                                                <div class="col-12 p-0">
                                                    <input type="text" class="form-control" name="fantasia" id="fantasia" value="{{ old("fantasia") }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <label for="cnpj" class="control-label col-form-label" style="padding-left: 15px;">CNPJ</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="cnpj" id="cnpj" value="{{ old("cnpj") }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label for="cep" class="control-label col-form-label" style="padding-left: 15px;">CEP</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control cep" name="cep" id="cep" value="{{ old("cep") }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4 col-lg-5">
                                                <label for="endereco" class="control-label col-form-label" style="padding-left: 15px;">Endereço</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="endereco" id="endereco" value="{{ old("endereco") }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4 col-lg-1">
                                                <label for="numero" class="control-label col-form-label" style="padding-left: 15px;">Nº</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="numero" id="numero" value="{{ old("numero") }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4 col-lg-3">
                                                <label for="complemento" class="control-label col-form-label" style="padding-left: 15px;">Complemento</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="complemento" id="complemento" value="{{ old("complemento") }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label for="bairro" class="control-label col-form-label" style="padding-left: 15px;">Bairro</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="bairro" id="bairro" value="{{ old("bairro") }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label for="cidade" class="control-label col-form-label" style="padding-left: 15px;">Cidade</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="cidade" id="cidade" value="{{ old("cidade") }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-1">
                                                <label for="estado" class="control-label col-form-label" style="padding-left: 15px;">UF</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control uf" name="estado" id="estado" value="{{ old("estado") }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-2">
                                                <label for="ibge" class="control-label col-form-label" style="padding-left: 15px;">IBGE</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="ibge" id="ibge" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label for="fonesms1" class="control-label col-form-label" style="padding-left: 15px;">Celular SMS 1</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="fonesms1" id="fonesms1" value="{{ old("fonesms1") }}" placeholder="Ex.: 32987654321">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label for="fonesms2" class="control-label col-form-label" style="padding-left: 15px;">Celular SMS 2</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="fonesms2" id="fonesms2" value="{{ old("fonesms2") }}" placeholder="Ex.: 32987654321">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label for="fonesms3" class="control-label col-form-label" style="padding-left: 15px;">Celular SMS 3</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="fonesms3" id="fonesms3" value="{{ old("fonesms3") }}" placeholder="Ex.: 32987654321">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <label for="email" class="control-label col-form-label" style="padding-left: 15px;">Email</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="email" class="form-control" name="email" id="email" value="{{ old("email") }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label for="ativo" class="control-label col-form-label" style="padding-left: 15px;">Status Financeiro</label>
                                                <div class="col-sm-12 p-0">
                                                    <select class="form-control" name="status_financeiro" id="status_financeiro" style="width: 100%;">
                                                        <option value="">-- Não Selecionado --</option>
                                                        <option value="1" {{ old('status_financeiro') == 1 ? 'selected' : ''}}>LIBERADO</option>
                                                        <option value="0" {{ old('status_financeiro') == 0 ? 'selected' : ''}}>BLOQUEADO</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <h3 class="block-title py-3">Banco de Dados</h3>

                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-5">
                                                <label for="razao_social" class="control-label col-form-label" style="padding-left: 15px;">Nome Banco de Dados</label>
                                                <div class="col-12 p-0">
                                                    <input type="text" class="form-control" name="db_name" id="db_nome" required value="{{old('db_name')}}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <label for="host" class="control-label col-form-label" style="padding-left: 15px;">Host</label>
                                                <div class="col-12 p-0">
                                                    <input type="text" class="form-control" name="db_host" id="db_host" value="127.0.0.1" required >
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3">
                                                <label for="port" class="control-label col-form-label" style="padding-left: 15px;">Porta</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="db_port" id="db_port" value="3306" required >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <label for="host" class="control-label col-form-label" style="padding-left: 15px;">Nome de Usuario</label>
                                                <div class="col-12 p-0">
                                                    <input type="text" class="form-control" name="db_username" id="db_username" required value="{{old('db_username')}}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <label for="port" class="control-label col-form-label" style="padding-left: 15px;">Senha</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="text" class="form-control" name="db_password" id="db_password" value="{{old('db_password')}}">
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

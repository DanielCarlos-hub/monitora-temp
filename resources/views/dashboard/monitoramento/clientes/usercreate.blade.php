@extends('layouts.dashboard.monitoramento', ["title" => "Freezolar Refrigeração - Monitoramento - Usuários Clientes"])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Adicionar Usuário</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Monitoramento</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.monitoramento.clientes.index') }}">Clientes</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.monitoramento.usuarios.create', $empresa->id) }}">Adicionar Usuário</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row pb-3">
                <form class="form-horizontal" method="post" autocomplete="off" action="{{ route('dashboard.monitoramento.usuarios.store', $empresa->id) }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card px-5">
                                <div class="card-body">
                                    <h3 class="block-title py-3">Cadastro de Pessoa Tipo empresa</h3>
                                    <div class="form-group row mb-0">
                                        <div class="col-12 col-md-6 col-lg-5">
                                            <label for="razao_social" class="control-label col-form-label">Razão Social</label>
                                            <div class="col-12 p-0">
                                                <input type="text" class="form-control" name="PES_RAZAOSOCIAL" id="PES_RAZAOSOCIAL" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <label for="PES_NOMEFANTASIA" class="control-label col-form-label">Nome Fantasia</label>
                                            <div class="col-12 p-0">
                                                <input type="text" class="form-control" name="PES_NOMEFANTASIA" id="PES_NOMEFANTASIA">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <label for="cnpj" class="control-label col-form-label">CNPJ</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control" name="PES_CNPJ" id="PES_CNPJ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <label for="PES_IE" class="control-label col-form-label">Insc. Estadual</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control" name="PES_IE" id="PES_IE">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-2">
                                            <label for="PES_CEP" class="control-label col-form-label">CEP</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control cep" name="PES_CEP" id="PES_CEP">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-5">
                                            <label for="PES_ENDERECO"class="control-label col-form-label">Endereço</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control" name="PES_ENDERECO" id="PES_ENDERECO">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-2">
                                            <label for="PES_NUMERO" class="control-label col-form-label">Nº</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control" name="PES_NUMERO" id="PES_NUMERO">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <label for="PES_COMPLEMENTO" class="control-label col-form-label">Complemento</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control" name="PES_COMPLEMENTO" id="PES_COMPLEMENTO">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <label for="bairro" class="control-label col-form-label">Bairro</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control" name="PES_BAIRRO" id="PES_BAIRRO">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <label for="PES_CIDADE" class="control-label col-form-label">Cidade</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control" name="PES_CIDADE" id="PES_CIDADE">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-1">
                                            <label for="PES_UF" class="control-label col-form-label">UF</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control uf" name="PES_UF" id="PES_UF">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-2">
                                            <label for="PES_IBGE" class="control-label col-form-label">IBGE</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control" name="PES_IBGE" id="PES_IBGE" disabled>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <label for="PES_TELEFONE1" class="control-label col-form-label">Telefone 1</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control telefone" name="PES_TELEFONE1" id="PES_TELEFONE1">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <label for="PES_TELEFONE2" class="control-label col-form-label">Telefone 2</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control telefone" name="PES_TELEFONE2" id="PES_TELEFONE2">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <label for="PES_CELULAR" class="control-label col-form-label">Celular</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="text" class="form-control telefone" name="PES_CELULAR" id="PES_CELULAR">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <label for="PES_EMAIL" class="control-label col-form-label">Email 1</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="email" class="form-control" name="PES_EMAIL" id="PES_EMAIL">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <label for="PES_EMAIL2" class="control-label col-form-label">Email 2</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="email" class="form-control" name="PES_EMAIL2" id="PES_EMAIL2">
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="block-title py-3">Usuário</h3>

                                    <div class="form-group row mb-0">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <label for="razao_social" class="control-label col-form-label">Nome Completo do Usuário</label>
                                            <div class="col-12 p-0">
                                                <input type="text" class="form-control" name="nome_usuario" id="nome_usuario" required>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-3">
                                            <label for="razao_social" class="control-label col-form-label">Usuário de Acesso</label>
                                            <div class="col-12 p-0">
                                                <input type="text" class="form-control" name="username" id="username" required>
                                            </div>
                                        </div>


                                        <div class="col-12 col-md-6 col-lg-3">
                                            <label for="cnpj" class="control-label col-form-label">Senha</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="password" class="form-control" name="password" id="password">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-2">
                                            <label for="perfil" class="control-label col-form-label">Perfil</label>
                                            <div class="col-12 p-0">
                                                <input type="text" class="form-control" id="perfil" value="admin" disabled>
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
@endsection

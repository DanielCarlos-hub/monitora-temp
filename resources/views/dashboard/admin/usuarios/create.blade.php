@extends('layouts.dashboard.admin', ['title' => 'Freezolar Refrigeração - Administração - Adicionar Usuário'])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Adicionar Usuário</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Administração</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.usuarios.index') }}">Usuários</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.usuarios.create') }}">Adicionar</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content p-0">
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <form class="mb-5" method="POST" action="{{ route('dashboard.admin.usuarios.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-10">
                                <h6>Campos com <small style="color: red;"> * </small>São obrigatórios</h6>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-lg-12">
                                <div class="card px-2">
                                    <div class="card-body">
                                        <h3 class="block-title py-3">Cadastro de Usuário Administrador</h3>
                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-8">
                                                <label for="nome" class="control-label col-form-label">Nome Completo do Usuário</label>
                                                <div class="col-12 p-0">
                                                    <input type="text" class="form-control" name="user[nome]" id="nome" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-8">
                                                <label for="email" class="control-label col-form-label">Email de acesso do Usuário</label>
                                                <div class="col-12 p-0">
                                                    <input type="text" class="form-control" name="user[email]" id="email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <label for="username" class="control-label col-form-label">Nome de Usuário para Acesso</label>
                                                <div class="col-12 p-0">
                                                    <input type="text" class="form-control" name="user[username]" id="username" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <label for="password" class="control-label col-form-label">Senha</label>
                                                <div class="col-sm-12 p-0">
                                                    <input type="password" class="form-control" name="user[password]" id="password">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <label for="perfil" class="control-label col-form-label" style="padding-left: 15px;">Perfil</label>
                                                <div class="col-sm-12 p-0">
                                                    <select name="user[perfil]" id="user[perfil]" class="form-control" required>
                                                        <option value="admin">Admin</option>
                                                        <option value="monitoramento">Monitoramento</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row px-2">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


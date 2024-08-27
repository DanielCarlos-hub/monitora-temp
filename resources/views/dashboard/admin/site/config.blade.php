@extends('layouts.dashboard.admin', ['title' => 'Freezolar Refrigeração - Administração - Configurações do Site'])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Configurações do Site</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Site</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.config') }}">Configurações</a>
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
                    <form class="mb-5" method="POST" action="{{ route('dashboard.admin.site.config.submit', $config->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="block-header pl-0">
                                    <h3 class="block-title">Identidade</h3>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nome">Nome do Site <small style="color:red">*</small></label>
                                    <input type="text" class="form-control" id="nome" name="site[nome]" placeholder="Nome do Site..." value="{{$config->nome}}" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Imagem - Logo <small style="color:red">*</small></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="logo" name="logo">
                                        <label class="custom-file-label" for="logo">@if(!is_null($config->logo)) {{$config->logo}} @else Choose file @endif</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Imagem - favicon</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="favicon" name="favicon">
                                        <label class="custom-file-label" for="favicon">@if(!is_null($config->favicon)) {{$config->favicon}} @else Choose file @endif</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <textarea class="form-control form-control-alt" id="descricao" name="site[descricao]" rows="4" placeholder="Sobre o site, conteúdo encontrado no site, etc...">{{$config->descricao}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="block-header pl-0">
                                    <h3 class="block-title">Redes Sociais</h3>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" id="facebook" name="site[facebook]" placeholder="Facebook" value="{{$config->facebook}}">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="instagram">Instagram </label>
                                    <input type="text" class="form-control" id="instagram" name="site[instagram]" placeholder="Instagram" value="{{$config->instagram}}">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="twitter">Twitter </label>
                                    <input type="text" class="form-control" id="twitter" name="site[twitter]" placeholder="Twitter" value="{{$config->twitter}}">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="pinterest">Pinterest </label>
                                    <input type="text" class="form-control" id="pinterest" name="site[pinterest]" placeholder="Pinterest" value="{{$config->pinterest}}">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="linkedin">Linkedin </label>
                                    <input type="text" class="form-control" id="linkedin" name="site[linkedin]" placeholder="Linkedin" value="{{$config->linkedin}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="block-header pl-0">
                                    <h3 class="block-title">Endereço / Contato</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="endereco">Endereço <small style="color:red">*</small></label>
                                    <input type="text" class="form-control" id="endereco" name="site[endereco]" placeholder="Endereço" value="{{$config->endereco}}" required>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="telefone">Telefone 1</label>
                                    <input type="text" class="form-control" id="telefone" name="site[telefone]" placeholder="Telefone 1" value="{{$config->telefone}}">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="celular">Telefone 2 </label>
                                    <input type="text" class="form-control" id="celular" name="site[celular]" placeholder="Telefone 2" value="{{$config->celular}}">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email">E-mail <small style="color:red">*</small></label>
                                    <input type="text" class="form-control" id="email" name="site[email]" placeholder="E-mail" value="{{$config->email}}" required>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="whatsapp">Whatsapp </label>
                                    <input type="text" class="form-control" id="whatsapp" name="site[whatsapp]" placeholder="Whatsapp" value="{{$config->whatsapp}}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
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

<div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modalBody" class="modal-body" style="font-size: 16px;">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

    <script>
        @if($errors->any())
            $('#modalTitle').html('Atenção! Erros no cadastro')
            $("#msgModal").modal('show')
        @endif
    </script>

@endsection

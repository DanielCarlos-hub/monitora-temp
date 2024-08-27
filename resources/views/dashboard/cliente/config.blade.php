@extends('layouts.dashboard.cliente', ['title' => 'Freezolar Refrigeração - Cliente - Configurações'])


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
<div class="content p-0">
    <div class="block">

        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <form class="mb-5" method="POST" action="{{ route('cliente.config.submit', ['config' => $cliente->id, 'tenant' => request()->tenant]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <div class="block-header pl-0">
                                    <h3 class="block-title">Identidade</h3>
                                </div>
                            </div>
                            <div class="col-12 col-md-10 col-lg-10">
                                <label for="fantasia" class="control-label col-form-label">Nome Fantasia</label>
                                <div class="col-12 p-0">
                                    <input type="text" class="form-control" name="cliente[fantasia]" id="fantasia" value="{{$cliente->fantasia}}" maxlength="150">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Imagem - Logo <small style="color:red">*</small></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="logo" name="logo">
                                        <label class="custom-file-label" for="logo">@if(!is_null($cliente->logo)) {{$cliente->logo}} @else Choose file @endif</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Imagem - favicon</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="favicon" name="favicon">
                                        <label class="custom-file-label" for="favicon">@if(!is_null($cliente->favicon)) {{$cliente->favicon}} @else Choose file @endif</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-12">
                                <div class="block-header pl-0">
                                    <h3 class="block-title">Endereço / Contato</h3>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label for="cep">CEP</label>
                                    <input type="text" class="form-control cep" name="cliente[cep]" id="cep" value="{{$cliente->cep}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="endereco">Endereço <small style="color:red">*</small></label>
                                    <input type="text" class="form-control" id="endereco" name="cliente[endereco]" placeholder="Endereço..." value="{{$cliente->endereco}}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label for="numero">Nº <small style="color:red">*</small></label>
                                    <input type="text" class="form-control" id="numero" name="cliente[numero]" placeholder="Nº.." value="{{$cliente->numero}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" class="form-control" id="complemento" name="cliente[complemento]" placeholder="Complemento..." value="{{$cliente->complemento}}">
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="bairro">Bairro <small style="color:red">*</small></label>
                                    <input type="text" class="form-control" id="bairro" name="cliente[bairro]" placeholder="Bairro..." value="{{$cliente->bairro}}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="cidade">Cidade <small style="color:red">*</small></label>
                                    <input type="text" class="form-control" id="cidade" name="cliente[cidade]" placeholder="Cidade..." value="{{$cliente->cidade}}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label for="estado">Estado <small style="color:red">*</small></label>
                                    <input type="text" class="form-control" id="estado" name="cliente[estado]" placeholder="Estado (UF)" value="{{$cliente->estado}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="fonesms1">Celular SMS 1</label>
                                    <input type="text" class="form-control" id="fonesms1" name="cliente[fonesms1]" placeholder="Ex.: 32987654321" value="{{$cliente->fonesms1}}">
                                </div>
                            </div>

                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="fonesms2">Celular SMS 2 </label>
                                    <input type="text" class="form-control" id="fonesms2" name="cliente[fonesms2]" placeholder="Ex.: 32987654321" value="{{$cliente->fonesms2}}">
                                </div>
                            </div>

                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="fonesms3">Celular SMS 3 </label>
                                    <input type="text" class="form-control" placeholder="Ex.: 32987654321" value="{{$cliente->fonesms3}}" disabled>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="email">E-mail <small style="color:red">*</small></label>
                                    <input type="text" class="form-control" id="email" name="cliente[email]" placeholder="E-mail" value="{{$cliente->email}}">
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

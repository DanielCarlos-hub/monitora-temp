@extends('layouts.dashboard.admin', ["title" => "Freezolar Refrigeração - Administração - Clientes"])

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
                <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block js-appear-enabled animated fadeIn" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-success px-4 py-2 js-click-ripple-enabled" href="{{ route('dashboard.admin.clientes.equipamentos.create', $tenant->id) }}">
                            <i class="fa fa-plus mr-1"></i> Equipamento
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-white border-bottom">
    <div class="content content-boxed">
        <div class="row items-push text-center">
            <div class="col-6 col-md-3">
                <div class="font-size-sm font-w600 text-muted text-uppercase">Equipamentos</div>
                <a class="link-fx font-size-h3" href="{{ route('dashboard.admin.clientes.equipamentos.index', $tenant->id)}}">{{$countEquipamentos}}</a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <h2 class="content-heading">Equipamentos</h2>
    <div class="row">
        @foreach($equipamentos as $equipamento)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="block equipamento" data-equip-id="{{$equipamento->id}}">
                <div class="block-header block-header-default">
                    <h3 class="block-title"><a href="{{route('dashboard.admin.clientes.equipamentos.show', ['cliente' => $tenant->id, 'equipamento' => $equipamento->id]) }}">{{$equipamento->nome_equipamento}} <small>{{$equipamento->num_placa}}</small></a></h3>
                    <a href="{{ route('dashboard.admin.clientes.equipamentos.edit', ['cliente' => $tenant->id, 'equipamento' => $equipamento->id]) }}" title="Editar" role="button" class="btn btn-sm mr-1"><i class="fas fa-edit"></i></a>
                    <a href="{{ route('dashboard.admin.clientes.equipamentos.notificacoes', ['cliente' => $tenant->id, 'equipamento' => $equipamento->id]) }}" title="Notificações" role="button" class="btn btn-sm mr-1"><i class="si si-screen-smartphone"></i></a>
                    <a href="{{ route('dashboard.admin.clientes.equipamentos.logs', ['cliente' => $tenant->id, 'equipamento' => $equipamento->id]) }}" title="Logs" role="button" class="btn btn-sm mr-1"><i class="fas fa-exclamation-triangle"></i></a>
                    <button onClick="clearTemperaturas({{$equipamento->id}})" title="Zerar medições" role="button" class="btn btn-sm mr-1"><i class="fas fa-recycle"></i></button>
                </div>
                <div class="block-content">
                    <div class="temp"> <span id="temp-{{$equipamento->id}}">{{$equipamento->temperaturaAtual->temperatura}} </span><sup>&deg;</sup></div>
                    <div class="row">
                        <div class="col-4">
                            <div class="header">Max.</div>
                            <div class="value" id="max-{{$equipamento->id}}">@if(!is_null($equipamento->temperaturas->max('temperatura'))) {{$equipamento->temperaturas->max('temperatura')}} @else 0.00 @endif</div>
                        </div>
                        <div class="col-4">
                            <div class="header">Min.</div>
                            <div class="value" id="min-{{$equipamento->id}}">@if(!is_null($equipamento->temperaturas->min('temperatura'))) {{$equipamento->temperaturas->min('temperatura')}} @else 0.00 @endif</div>
                        </div>
                        <div class="col-4">
                            <div class="header">Média</div>
                            <div class="value" id="media-{{$equipamento->id}}">{{number_format((float) $equipamento->temperaturas->avg('temperatura'), 2, '.', '')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
<div>
@endsection


@section('javascript')
    <script>

    var dataList = $(".equipamento").map(function() {
        return $(this).data("equip-id");
    }).get();
    var now = new Date();

    $.each(dataList, function(index, value){

        (function update() {
            $.ajaxSetup ({
                cache: false
            });

            $.ajax({
                url: '/admin/cliente/'+'{{$tenant->id}}'+'/equipamento/'+value+'/temperatura',
                dataType: 'json',
                success: function(data) {
                    $('#temp-'+value).text(data.atual);
                    $('#max-'+value).text(data.max);
                    $('#min-'+value).text(data.min);
                    $('#media-'+value).text(data.avg);
                },
                complete: function(){
                    setTimeout(update, 10000);
                }
            });
        })();
    });

    function clearTemperaturas(id)
    {

        var getEquipamento = "{{ route('dashboard.admin.equipamento.json', ['cliente' => $tenant->id, 'equipamento' => ':id']) }}";
        getEquipamento = getEquipamento.replace(':id', id);

        $.getJSON(getEquipamento, function(data) {
            Swal.fire({
                title: 'Limpar as temperaturas do equipamento: ' + data.nome_equipamento + '?',
                text: 'Deseja realmente limpar as temperaturas do equipamento ' + data.nome_equipamento + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, limpar!'

            }).then((result) => {

                if (result.isConfirmed) {

                    var clearUrl = "{{ route('dashboard.admin.clientes.equipamentos.clear', ['cliente' => $tenant->id, 'equipamento' => ':id']) }}"
                    clearUrl = clearUrl.replace(':id', id)

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    $.ajax({
                        type: "DELETE",
                        url: clearUrl,
                        success: function(response){
                            Swal.fire({
                                title: 'Pronto!',
                                text: response,
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        },
                        error: function (xhr) {
                            Swal.fire(
                                'Erro!',
                                xhr.responseText,
                                'error'
                            )
                        }
                    });
                }
            });
        });
    }

    </script>
@endsection

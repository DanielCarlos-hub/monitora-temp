@extends('layouts.dashboard.cliente', ['title' => 'Freezolar Refrigeração - Cliente - Dashboard'])

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

<div class="content">
    <h2 class="content-heading">Equipamentos</h2>
    <div class="row">
        @foreach($equipamentos as $equipamento)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="block equipamento" data-equip-id="{{$equipamento->id}}">
                <div class="block-header block-header-default">
                    <h3 class="block-title"><a href="{{route('cliente.equipamento.show', ['tenant' => request()->tenant, 'equipamento' => $equipamento->id]) }}">{{$equipamento->nome_equipamento}} <small>{{$equipamento->num_placa}}</small></a></h3>
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
                url: '/cliente/equipamento/'+value+'/temperatura',
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

    </script>
@endsection

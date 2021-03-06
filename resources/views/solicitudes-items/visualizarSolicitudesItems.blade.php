@extends('base')

@section('head')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')
<!-- codigo importante -->
@if(session()->has('confirm'))
    <div class="alert alert-success" role="alert" id="confirm">
        {{ session()->get('confirm') }}
    </div>
    <script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif

<div style="width:90%; margin:24px auto;" class="container-table">
  <h1 class="display-4">Solicitudes de registro de items</h1>
  @if(session()->has('Crear solicitud de items'))
  <div style="display:flex;justify-content:flex-end;" class="mb-3">
    <a href="{{url('solicitudes-de-items/create')}}" class="btn btn-primary">+ Nuevo</a>
  </div>
  @else
  <br><br>
  @endif
  <div class="overflow-auto">
    <table class="table">
      <thead>
        <tr>
          <th class="text-center options">NRO</th>
          <th>DE</th>
          <th>PARA</th>
          <th>DETALLE</th>
          <th class="text-center">FECHA DE CREACIÓN</th>
          <th class="options"></th>
        </tr>
      </thead>
      <tbody>
      @foreach($solicitudes as $solicitud)
        <tr>
          <th scope="row" class="text-center">{{$loop->index +1}}</th>
          <td>{{$solicitud->nombres_de}}</td>
          <td>{{$solicitud->nombres_para}}</td>
          <td>{{$solicitud->detalle_solicitud_item}}</td>
          <td class="text-center">{{date("Y-m-d",strtotime($solicitud->created_at))}}</td>
          <td class="options">
            <div class="dropdown dropleft">
              <span id="dd-options{{$loop->index +1}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="c-icon mfe-2">
                  <use xlink:href="{{asset('img/icons/options.svg#i-options')}}"></use>
                </svg>
              </span>
              <div class="dropdown-menu" aria-labelledby="dd-options{{$loop->index +1}}">
                <div class="dropdown-header bg-light py-2"><strong>Opciones</strong></div>
                <a class="dropdown-item" href="{{ route('solicitudes-de-items.show', $solicitud->id) }}">
                  <svg class="c-icon mfe-2">
                    <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                  </svg>Detalles
                </a>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

</div>
<!-- fin codigo importante -->
  
@endsection
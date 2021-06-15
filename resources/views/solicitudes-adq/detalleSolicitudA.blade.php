@extends('base')
@section('title')
@endsection

@section('head')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/AutorizaciónSolicitud.css') }}">
<link rel="stylesheet" href="{{ asset('css/solicitarAdq.css') }}">

@endsection
@section('main')
<div class="container-form">
    <form>
    <div>
      <h2 class="display-4">Detalle de la Solicitud de Adquisición</h2>
      <h2 class="display-5">N° {{$autopre->codigo_solicitud_a}}</h2>
      <br>
      <label  for="exampleInputEmail1" class="form-label"><b>TIPO:</b></label>
      <label>{{$autopre->tipo_solicitud_a}}</label>

    <div class='row'>
    <div class='col-6'>
    <label  for="exampleInputEmail1" class="form-label"><b>UNIDAD SOLICITANTE:</b></label>
    <label>{{$autopre->nombre_unidad}}</label>
    </div>

    <div class='col-6'>
    <label  for="exampleInputEmail1" class="form-label"><b>ELABORADO POR:</b></label>
    <label>{{$autopre->nombres}} {{$autopre->apellidos}}</label>
    </div>
    </div>

    <div class="row">
    <div class="col-6">
    
    <label  for="exampleInputEmail1" class="form-label"><b>FECHA DE PEDIDO:</b></label>
    <label>{{date("Y-m-d",strtotime($autopre->created_at))}}</label>
    </div>
    <div class="col-6">
    <label  for="exampleInputEmail1" class="form-label"><b>FECHA DE ENTREGA:</b></label>
    <label>{{date("Y-m-d",strtotime($autopre->fecha_entrega))}}</label>
    </div>
    </div>
    
    
  
    <label  for="exampleInputEmail1" class="form-label"><b>JUSTIFICACIÓN:</b></label>
    <br>

    <label class="soli" >{{$autopre->justificacion_solicitud_a}}</label>
    <br>
    @if($autopre->tipo_solicitud_a=="Compra")
    <table class="tabla-compra" id="compra">
      <thead>
        <tr>
          <th class="c-0">N°</th>
          <th class="c-1">Item</th>
          <th class="c-2">Cantidad</th>
          <th class="c-2">Unidad</th>
          <th class="c-2">Precio</th>
        </tr>
      </thead>
      <tbody>
      @for($i=0; $i<10; $i++)
        <tr>
          <td>{{$detalles[0][$i]}}</td>
          <td class="articulo"><span>{{$detalles[1][$i]}}</span></td>
          <td>{{$detalles[2][$i]}}</td>
          <td>{{$detalles[3][$i]}}</td>
          <td>{{$detalles[4][$i]}}</td>
        </tr>
        @endfor
        <tr>
          <td colspan="4">TOTAL</td>
          <td>{{$autopre->total_solicitud_a}}</td>
        </tr>
      </tbody>
    </table>
    @else
    <table class="tabla-alquiler" id="alquiler">
      <thead>
        <tr>
          <th class="c-0">N°</th>
          <th class="c-1">Servicio</th>
          <th class="c-2">Duracion</th>
          <th class="c-2">Periodo</th>
          <th class="c-2">Precio</th>
        </tr>
      </thead>
      <tbody>
          @for($i=0; $i<10; $i++)
        <tr>
          <td>{{$detalles[0][$i]}}</td>
          <td class="articulo"><span>{{$detalles[1][$i]}}</span></td>
          <td>{{$detalles[2][$i]}}</td>
          <td>{{$detalles[3][$i]}}</td>
          <td>{{$detalles[4][$i]}}</td>
        </tr>
        @endfor
        <tr>
          <td colspan="4">TOTAL</td>
          <td>{{$autopre->total_solicitud_a}}</td>
        </tr>
      </tbody>
    </table>
    @endif
   </div>
</form>
</div>





 
@endsection
@section('scripts')
@endsection
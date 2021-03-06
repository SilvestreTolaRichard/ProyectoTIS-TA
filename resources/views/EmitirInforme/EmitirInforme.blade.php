@extends('base')
@section('title')
AtorizaciónPresupuesto
@endsection

@section('head')
<title>AtorizaciónPresupuesto</title>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/EmitirInforme.css') }}">


@endsection
@section('main')
<div class="container-form">

  <form  action="{{route('guardarinforme', $comparativo->id)}}" method="post" >
    {{csrf_field()}}
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link" id="conformato" href="#">CARTA CON FORMATO</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="sinformato" href="#">CARTA SIN FORMATO</a>
      </li>
    </ul>
                  
    <div style="width:90%; margin:auto;">
      <br>
      <div class="d-flex justify-content-end"> Cochabamba,{{date('d')}} de {{$meses[date('n')-1]}} de {{date('Y')}}</div>
      <label class="form-label">Señor: {{$comparativo->nombre_solicitante}}</label>
      <br>
      <label class="form-label">PRESENTE</label>
      <div class="d-flex justify-content-center"> REF: INFORME DE LA SOLICITUD DE ADQUISICIÓN {{ $comparativo->empresa_recomendada !=''? 'ACEPTADO':'RECHAZADO'}}</div>
      
      <div id="con-formato" style="display:none;">
        <br>
        <label class="form-label">De mi consideración</label>
        <div class=" d-flex align-items-baseline justify-content-start mb-3">
          <label class="form-label">A través de este presente tengo el bien de informar a la Unidad de solicitud de adquisición N° {{$comparativo->codigo_solicitud_a}}, ha sido {{$comparativo->empresa_recomendada !=''? 'ACEPTADO':'RECHAZADO'}}</label>
        </div>
        <textarea name="justificacion" id="justificacion-c" class="form-control" cols="30" rows="6" style="resize: none"> Teniendo en cuenta que su unidad {{$comparativo->unidad_solicitante}} tiene un presupuesto anual {{$presupuesto}} Bs, {{ $comparativo->empresa_recomendada !=''? 'Como resultado del proceso de cotización la empresa seleccionada es '.$comparativo->empresa_recomendada.' que cotizó la solicitud de adquisición por un monto de: '.$monto.' Bs':''}}</textarea>
        <label class="form-label">Sin otro en particular, nos despedimos de una persona muy cordialmente deseándoles éxitos en sus funciones que desempeñan actualmente.</label>
        @if(!old('formato'))
          @foreach($errors->get('justificacion') as $message)
          <div class="alert alert-danger" role="alert">{{$message}}</div>
          @endforeach
        @endif
      </div>
      <br>
      <div id="sin-formato" style="display:none;">
        <textarea name="justificacion" id="justificacion-s" class="form-control" cols="30" rows="10" style="resize: none">{{old('justificacion')}}</textarea>
          @if(old('formato')) 
            @foreach($errors->get('justificacion') as $message)
              <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
          @endif
        <br>
      </div>
      <!--  inicio de Acordion--->
      <br>
      <div class="accordion"  id="accordionExample">
        <div class="card" >
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                DETALLE
                </button>
            </h2>
          </div>

          <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
              <label class="form-label"><b>Unidad Solicitante:</b> {{$comparativo->unidad_solicitante}}</label>
              <br>
              <label class="form-label"><b>Jefe de la Unidad Solicitante:</b> {{$comparativo->nombre_jefe_solicitante}}</label>
              <br>
              <label class="form-label"><b>Jefe Administrativo:</b> {{$comparativo->nombre_jefe_administrativo}}</label>
              <br>
              <label class="form-label"><b>Tecnico Responsable:</b> {{$comparativo->nombre_tecnico_responsable}}</label>
              <br>
              <label class="form-label"><b>Empresa Recomendada:</b> {{$comparativo->empresa_recomendada}}</label>
              <input type="text" value="{{$comparativo->empresa_recomendada}}"  name="empresa" class="d-none">
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  ADJUNTOS
              </button>
            </h2>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
              <label for=""><b>Cuadro Comparativo de Cotizaciones:</b>&nbsp;  <a href="{{route('comparativo.detalle', $comparativo->id)}}" class="btn btn-dark btn-sm" target="_blank">N° {{$comparativo->codigo_cotizacion}} </a></label><br>
              @foreach($respuestas as $respuesta)
              <label for=""><b>Propuesta {{$loop->index+1}}:</b>&nbsp; <a href="{{route('respuestasCotizacion.show', $respuesta->id)}}" class="btn btn-dark btn-sm" target="_blank">N° {{$comparativo->codigo_cotizacion}} </a></label><br>
              @endforeach
              <label for=""><b>Solicitud de Adquisicion:</b>&nbsp; <a href="{{route('solicitud.show', $comparativo->solicitud_a_id)}}"class="btn btn-dark btn-sm" target="_blank">N° {{$comparativo->codigo_solicitud_a}} </a></label><br>
            </div>
          </div>
        </div>
      </div>
      <br>

      <input type="checkbox" name="formato" id="formato" {{old('formato')?'checked':''}} class="d-none">
      <input name="tipo"  class=" d-none" value="{{ $comparativo->empresa_recomendada !=''? 'Aceptado':'Rechazado'}}">

      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary" id="enviar">ENVIAR INFORME</button>
      </div>
    </div>
  </form>
</div>

@endsection
@section('scripts')
<script>
$(window).on("load", function(){

  $('#conformato').on('click',function(){
    $('#con-formato').show();
    $('#sin-formato').hide();
    $('#conformato').addClass('active');
    $('#sinformato').removeClass('active');
    $('#justificacion-s').prop('disabled',true);
    $('#justificacion-c').prop('disabled',false);
    $('#formato').prop('checked',false);

  });

  $('#sinformato').on('click',function(){
    $('#sin-formato').show();
    $('#con-formato').hide();
    $('#sinformato').addClass('active');
    $('#conformato').removeClass('active');
    $('#justificacion-s').prop('disabled',false);
    $('#justificacion-c').prop('disabled',true);
    $('#formato').prop('checked',true);
  });
  if($("#formato").is(":checked")){
    $('#sinformato').trigger('click');
  }else {
    $('#conformato').trigger('click');
  }
});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@endsection
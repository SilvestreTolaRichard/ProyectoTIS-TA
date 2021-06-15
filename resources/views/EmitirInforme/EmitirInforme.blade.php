@extends('base')
@section('title')
AtorizaciónPresupuesto
@endsection

@section('head')
<title>AtorizaciónPresupuesto</title>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/EmitirInforme.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection
@section('main')
<div class="container ">
        
    <form  action="{{route('guardarinforme', $comparativo->id)}}" method="post" >
    {{csrf_field()}}
              <ul class="nav nav-tabs">
               <li class="nav-item">
                <a class="nav-link active" id="conformato" href="#con-formato">CARTA CON FORMATO</a>
               </li>
               <li class="nav-item">
                <a class="nav-link" id="sinformato" href="#sin-formato">CARTA SIN FORMATO</a>
               </li>
 
             </ul>
                  
                  <div style="width:90%; margin:auto;">
                     <br>
                     <div class="d-flex justify-content-end"> Cochabamba,{{date('d')}} de {{$meses[date('n')-1]}} de {{date('Y')}}</div>
                     <label for="tipo" class="form-label">Señor: {{$comparativo->nombre_solicitante}}</label>
                     <br>
                     <label for="tipo" class="form-label">PRESENTE</label>
                     <div class="d-flex justify-content-center"> REF: INFORME DE LA SOLICITUD DE ADQUISICIÓN</div>
                     <div id="con-formato">
                     <br>
                     <label for="tipo" class="form-label">De mi consideración</label>
                     <div class=" d-flex align-items-baseline justify-content-start mb-3">
                     <label for="tipo" class="form-label">A travez de este presente tengo el bien de informarte a la Unidad de solicitud de adquisición N° {{$comparativo->codigo_solicitud_a}} , ha sido &nbsp;</label>
                     <select name="tipo" id="tipo-c" class=" col-2 form-control">
                     <option {{ old('tipo') == "Aceptado" ? 'selected' : '' }} value="Aceptado">Aceptado</option>
                     <option {{ old('tipo') == "Rechazado" ? 'selected' : '' }} value="Rechazado">Rechazado</option>
                     </select><br>
                      </div>
                      <textarea name="justificacion" id="justificacion-c" class="form-control" cols="30" rows="6" style="resize: none">{{old('justificacion')}}</textarea>
                      <label for="tipo" class="form-label">Sin otro en particular mos despedimos de us persona muy cordialmente deseandoles exitos en sus funcionaes que desempeñan actualmente.</label>
                        @foreach($errors->get('tipo') as $message)
                          <div class="alert alert-danger" role="alert">{{$message}}</div>
                        @endforeach
                        @foreach($errors->get('justificacion') as $message)
                          <div class="alert alert-danger" role="alert">{{$message}}</div>
                         @endforeach
                  </div>
                  <br>
                  <div id="sin-formato">
                      <textarea name="justificacion" id="justificacion-s" class="form-control" cols="30" rows="10" style="resize: none">{{old('justificacion')}}</textarea>
                          @foreach($errors->get('justificacion') as $message)
                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                          @endforeach
                      <br>
                      <div class=" col-7 d-flex" >
                        <label  for="tipo" class=" col-5 form-label">Solicitud de Adquisición:</label>
                        <select name="tipo" id="tipo-s" class="form-control">
                               <option {{ old('tipo') == "Aceptado" ? 'selected' : '' }} value="Aceptado">Aceptado</option>
                               <option {{ old('tipo') == "Rechazado" ? 'selected' : '' }} value="Rechazado">Rechazado</option>
                        </select>
                        </div>
                        @foreach($errors->get('tipo') as $message)
                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                          @endforeach
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
                         
                          <label for="tipo" class="form-label"><b>Unidad Solicitante:</b> {{$comparativo->unidad_solicitante}}</label>
                          <br>
                          <label for="tipo" class="form-label"><b>Jefe de la Unidad Solicitante:</b> {{$comparativo->nombre_jefe_solicitante}}</label>
                          <br>
                          <label for="tipo" class="form-label"><b>Jefe Administrativo:</b> {{$comparativo->nombre_jefe_administrativo}}</label>
                          <br>
                          <label for="tipo" class="form-label"><b>Tecnico Responsable:</b> {{$comparativo->nombre_tecnico_responsable}}</label>
                          <br>
                          <label for="tipo" class="form-label"><b>Empresa Recomendada:</b> {{$comparativo->empresa_recomendada}}</label>
                          <input type="text" value="{{$comparativo->empresa_recomendada}}" class="d-none">
                         
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
                                 Some placeholder content for the second accordion panel. This panel is hidden by default.
                               </div>
                           </div>
                      </div>
 
                </div>
               
            
                <br>
                <input type="checkbox" name="formato" id="formato" checked class="d-none">

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
 $('#sin-formato').hide();
 $('#tipo-s').prop('disabled',true);
 $('#justificacion-s').prop('disabled',true);
$('#conformato').on('click',function(){
            $('#con-formato').show();
            $('#sin-formato').hide();
            $('#conformato').addClass('active');
            $('#sinformato').removeClass('active');
            $('#tipo-s').prop('disabled',true);
            $('#tipo-c').prop('disabled',false);
            $('#justificacion-s').prop('disabled',true);
            $('#justificacion-c').prop('disabled',false);
            $('#formato').prop('checked',true);

});

$('#sinformato').on('click',function(){
            $('#sin-formato').show();
            $('#con-formato').hide();
            $('#sinformato').addClass('active');
            $('#conformato').removeClass('active');
            $('#tipo-s').prop('disabled',false);
            $('#tipo-c').prop('disabled',true);
            $('#justificacion-s').prop('disabled',false);
            $('#justificacion-c').prop('disabled',true);
            $('#formato').prop('checked',false);
});

});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@endsection
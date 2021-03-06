@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
@if(session()->has('confirm'))
  <div class="alert alert-success" role="alert" id="confirm">
  {{session()->get('confirm')}}
  </div>
  <script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif

<div class="container-table d-flex flex-column">

        <div class='d-flex justify-content-center'>
            <h2 class="display-4">Lista de Cotizaciones</h2>
        </div>    
        <table class="table">

          @if(session()->has('Crear solicitud de cotizacion'))
          <div style="display:flex;justify-content:flex-end;" class="mb-3">
            <a class="btn btn-primary" href="{{url('solicitudCotizacion/create')}}">+ Nuevo</a>
          </div>
          @else
          <br><br>
          @endif
            <thead>
                <tr>
                    <th scope="col" class="options">NRO</th>
                    <th scope="col">CODIGO DE COTIZACIÓN</th>
                    <th scope="col">CANTIDAD DE PROPUESTAS</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">FECHA</th> 
                    <th class="options"></th>
                </tr>
            </thead>
            <tbody>
              @foreach($cotizaciones as $cotizacion)

              <tr>
                <td>{{ $loop->index +1 }}</td>
                <td>{{$cotizacion->codigo_cotizacion}}</td>
                <td>{{$cotizacion->respuestas}}</td>
                <td>{{$cotizacion->informes<1? 'Proceso de cotizacion' : 'Concluido'}}</td>
                <td>{{date("Y-m-d",strtotime($cotizacion->fecha_cotizacion))}}</td>   
                <td class="options">
                <div class="dropdown dropleft">
                <span id="dd-options{{$loop->index +1}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <svg class="c-icon mfe-2">
                    <use xlink:href="{{asset('img/icons/options.svg#i-options')}}"></use>
                  </svg>
                </span>
                <div class="dropdown-menu" aria-labelledby="dd-options{{$loop->index +1}}">
                  <div class="dropdown-header bg-light py-2"><strong>Opciones</strong></div>
                  <a class="dropdown-item" href="{{ route('solicitudCotizacion.show', $cotizacion->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                  </svg>Detalles
                  </a>
                  @if($cotizacion->respuestas>0 && session()->has("Visualizar solicitud de cotizacion"))
                  <a class="dropdown-item" href="{{ route('respuestasCotizacion.index', $cotizacion->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/list.svg#i-list')}}"></use>
                  </svg>Ver Propuestas
                  </a>                  
                  @endif
                  @if($cotizacion->respuestas<5 && session()->has("Crear solicitud de cotizacion"))
                  <a class="dropdown-item" href="{{ route('respuestasCotizacion.create', $cotizacion->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/plus.svg#i-plus')}}"></use>
                  </svg>Añadir Propuesta
                  </a>                  
                  @endif
                  @if($cotizacion->respuestas>2 && $cotizacion->informes<1 && session()->has("Crear cuadro comparativo"))
                  <a class="dropdown-item" href="{{ route('comparativo.generar', $cotizacion->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/list-low-priority.svg#i-list-low-priority')}}"></use>
                  </svg>Generar Cuadro Comparativo
                  </a>   
                  @endif
                  @if($cotizacion->comparativo>0 && session()->has("Visualizar cuadro comparativo"))
                  <a class="dropdown-item" href="{{ route('comparativo.detalle', $cotizacion->comparativo_id) }}">
                    <svg class="c-icon mfe-2">
                    <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                  </svg>Detalles del Cuadro Comparativo
                  </a>
                  @endif
                  @if(session()->has("Crear solicitud de cotizacion"))
                  <button class="dropdown-item" data-toggle="modal" data-target="#generar-pdf" data-value="{{$cotizacion->id}}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/print.svg#i-print')}}"></use>
                    </svg>Imprimir
                  </button>
                  @endif
                </div>
              </div>
                </td>       
              </tr>
              @endforeach
            </tbody>    
        </table>                      

  <br>
  <nav class="mt-auto" aria-label="Page navigation">
    <ul class="pagination m-0">
      @if($cotizaciones->previousPageUrl())
      <li class="page-item">
        <a class="page-link" href="{{$cotizaciones->previousPageUrl()}}" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      @endif
      @if($cotizaciones->previousPageUrl())
      <li class="page-item"><a class="page-link" href="{{$cotizaciones->previousPageUrl()}}">{{$cotizaciones->currentPage()-1}}</a></li>
      @endif
      <li class="page-item active"><a class="page-link" href="#">{{$cotizaciones->currentPage()}}</a></li>
      @if($cotizaciones->nextPageUrl())
      <li class="page-item"><a class="page-link" href="{{$cotizaciones->nextPageUrl()}}">{{$cotizaciones->currentPage()+1}}</a></li>
      @endif
      @if($cotizaciones->nextPageUrl())
      <li class="page-item">
        <a class="page-link" href="{{$cotizaciones->nextPageUrl()}}" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
      @endif
    </ul>
  </nav>

</div>

<div class="modal fade" id="generar-pdf" tabindex="-1" aria-labelledby="presupestoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title d-flex kustify-content-center" id="presupestoLabel">Generar cotizacion en pdf</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('generarCotPdf') }}" method="post" id="generar-form" target="_blank">
          {{ csrf_field() }}
          <input type="text" name="cotizacion_id" class="d-none form-control" id="cotizacion_id">
          <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right" id="with-business">
            <input class="c-switch-input" type="checkbox" checked="">
            <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
          </label>
          <label class="form-label">Razon social:</label>
          <div class="select-editable" id="business">
            <div class="dropdown">
              <button class="form-control dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <span class="search"><input type="text" class="form-control" placeholder="Buscar"></span>
                <span class="options">
                  @foreach($empresas as $empresa)
                  <span class="dropdown-item" id="{{str_replace(' ', '_', $empresa->nombre_empresa)}}">{{$empresa->nombre_empresa}}</span>
                  @endforeach
                </span>
                <span class="without d-none">Sin resultados</span>
              </div>
            </div>
            <input type="text" name="razon_social" id="razon_social" class="form-control bg-transparent">
          </div>
        </form>
        <div class="alert alert-danger d-none" role="alert" id="required-rs">El campo razon social es requerido</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" id="generar-cot-pdf" form="generar-form">Generar</button>
      </div>
    </div>
  </div>
</div>

<!-- fin codigo importante -->
@endsection

@section('scripts')
  <script src="{{asset('js/solicitudesCotizacion/visualizarSolicitudCotizacion.js')}}"></script>
@endsection
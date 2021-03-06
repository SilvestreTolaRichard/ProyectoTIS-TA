@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
@if(session()->has('success'))
    <div class="alert alert-success" role="alert" id="success">
        {{ session()->get('success') }}
    </div>
    <script>setTimeout("document.getElementById('success').classList.add('d-none');",3000);</script>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger" role="alert" id="error">
        {{ session()->get('error') }}
    </div>
    <script>setTimeout("document.getElementById('error').classList.add('d-none');",3000);</script>
@endif
@if(session()->has('confirm'))
    <div class="alert alert-success" role="alert" id="confirm">
        {{session()->get('confirm')}}
    </div>
    <script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif
@if(session()->has('exception'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p>
            {{session()->get('exception')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </p>
        <hr>
        <p>Nota: Para proteger la integridad de la información y evitar perdida de datos,
         un Usuario no podrá ser eliminado mientras este en uso.</p>
    </div>
@endif
<div class="container-table" >
    <div class='d-flex justify-content-center'>
        <h1 class="display-4">Usuarios Registrados</h1>
    </div>
    @if(session()->has('Crear usuario'))
        <div style="display:flex;justify-content:flex-end;" class="mb-3">
            <a class="btn btn-primary" href="{{url('usuario/create')}}">+ Nuevo</a>
        </div>
        @else
        <br><br>
    @endif
    <table class="table">
        <thead>
                <tr>
                    <th scope="col" class="options">NRO</th>
                    <th scope="col">NOMBRES</th>
                    <th scope="col">APELLIDOS</th>
                    <th scope="col">ROL</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PERTENECE A</th>
                    <th class="options"></th>
                </tr>
          </thead>
          <tbody>
            @foreach($usuarios as $usuario)

                    <tr>
                        <td>{{ $loop->index +1 }}</td>
                        <td>{{$usuario->nombres}}</td>
                        <td>{{$usuario->apellidos}}</td>
                        <td>{{$usuario->nombre_rol}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->nombre_unidad}}</td>
                        <td class="options">
                            <div class="dropdown dropleft">
                                <span id="dd-options{{$loop->index +1}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="c-icon mfe-2">
                                        <use xlink:href="{{asset('img/icons/options.svg#i-options')}}"></use>
                                    </svg>
                                </span>
                                <div class="dropdown-menu" aria-labelledby="dd-options{{$loop->index +1}}">
                                    <div class="dropdown-header bg-light py-2"><strong>Opciones</strong></div>
                                    <a class="dropdown-item" href="{{ route('usuario.show', $usuario->id) }}">
                                        <svg class="c-icon mfe-2">
                                            <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                                        </svg>Detalles de Usuario
                                    </a> 
                                    @if(session()->has('Editar usuario'))
                                    <a class="dropdown-item" type="submit" href="{{ route('usuario.edit', $usuario->id) }}">
                                        <svg class="c-icon mfe-2">
                                            <use xlink:href="{{asset('img/icons/edit.svg#i-edit')}}"></use>
                                        </svg>Editar
                                    </a>
                                    @endif               
                                    @if($usuario->usos == 0 && session()->has('Eliminar usuario'))
                                    <form action="{{ route('usuario.destroy', $usuario->id) }}" method="post" class="d-none" id="delete{{$loop->index +1}}">{{ csrf_field() }}{{ method_field('delete') }}</form>
                                    <button class="dropdown-item" type="submit" form="delete{{$loop->index +1}}">
                                    <svg class="c-icon mfe-2">
                                        <use xlink:href="{{asset('img/icons/trash.svg#i-trash')}}"></use>
                                    </svg>Eliminar
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
            @endforeach
        </tbody>


    </table>

</div>

<!-- fin codigo importante -->
@endsection
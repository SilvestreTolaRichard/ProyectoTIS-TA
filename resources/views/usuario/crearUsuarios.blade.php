@extends('base')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
<div class="container-form">
    <form action="/usuario" method="post">
        {{csrf_field()}}

        <h2  class="display-4">Registro de Usuario</h2>
        <br>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="nombre" class="form-label">Nombres:</label>
                    <input type="text" class="form-control" name="nombres" id="nombre" value="{{old('nombres')}}" autocomplete="off">
                    @foreach($errors->get('nombres') as $message) 
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                    <div></div>
                </div>

                <div class="mb-3 col-6">
                    <label for="apellido"class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" id="apellido" value="{{old('apellidos')}}" autocomplete="off">
                    @foreach($errors->get('apellidos') as $message) 
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
            </div>

            <div class="row">   
                
                <div class="mb-3 col-6">
                    <label for="CiUsuario" class="form-label">CI:</label>
                    <input type="text" class="form-control " name="ci_usuario" id="CiUsuario" autocomplete="off" value="{{old('ci_usuario')}}">
                    @foreach($errors->get('ci_usuario') as $message) 
                    <div class="alert alert-danger col-12" role="alert">{{$message}}</div>
                    @endforeach
                </div>

                <div class="mb-3 col-6">
                    <label for="TelefonoUsuario" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control " name="telefono_usuario" id="TelefonoUsuario" autocomplete="off" value="{{old('telefono_usuario')}}">
                    @foreach($errors->get('telefono_usuario') as $message) 
                    <div class="alert alert-danger col-12" role="alert">{{$message}}</div>
                    @endforeach
                </div>

            </div>

            <div class="row">     
                <div class="mb-3 col-6">
                    <label for="" class="form-label">Pertenece a:</label>
                    <select id="unidades" class="form-control" name="unidad_id">
                    <option hidden selected value="">Seleccione</option>
                
                    @foreach($unidades as $unidad)
                    <option {{ old('unidad_id') == $unidad->id ? 'selected' : '' }}  value="{{$unidad->id}}">{{$unidad->nombre_unidad}}</option>
                    @endforeach
                    </select>
                    @foreach($errors->get('unidad_id') as $message) 
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>

                <div class="mb-3 col-6">
                    <label for="" class="form-label">Rol:</label>
                    <select class="form-control" name="rol_id" id="roles">
                    <option hidden selected value="">Seleccione</option>
                    @foreach($roles as $rol)
                    <option id="{{$rol->nombre_rol}}"{{ old('rol_id') == $rol->id ? 'selected' : '' }} value="{{$rol->id}}">{{$rol->nombre_rol}}</option>
                    @endforeach
                    </select>
                    @foreach($errors->get('rol_id') as $message) 
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="emails" class="form-label">Email:</label>
                    <input type="text" class="form-control" name="email" id="emails" value="{{old('email')}}" autocomplete="off">
                    @foreach($errors->get('email') as $message) 
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="row">   
                <div class="mb-3 col-6">
                    <label for="contrasenias" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" name="contrasenia" id="contrasenias">
                    @foreach($errors->get('contrasenia') as $message) 
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>

                <div class="mb-3 col-6">
                    <label for="repContrasenia" class="form-label">Confirmar Contraseña:</label>
                    <input type="password" class="form-control" name="contrasenia2" id="repContrasenia">
                    @foreach($errors->get('contrasenia2') as $message) 
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
            </div>    

        <div class='d-flex justify-content-center'>
			<button type='submit' class="btn btn-primary">REGISTRAR</button>
		</div>
    
    </form>
    @if(session()->has('confirm'))
            <div class="alert alert-success" role="alert" id="confirm">
                {{session()->get('confirm')}}
            </div>
            <script>setTimeout("document.getElementById('confirm').classList.add('d-none');",1500);</script>
    @endif
</div>

<script>
    $("#unidades").on("change", function()
    {
        if($("#unidades").children("option:selected").text().includes("Administrativa")){
            $("#Cotizador").show();
        }
        else{
            $("#Cotizador").hide();
            $("#roles").val("");
        }
    });
</script>

<!-- fin codigo importante -->
@endsection
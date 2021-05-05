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

  <h1>Roles Registrados</h1>
  <div style="display:flex;justify-content:flex-end;">
    <a href="{{ route('roles.create') }}" class="btn btn-primary">+Nuevo</a>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nro</th>
        <th scope="col">Rol</th>
        <th scope="col">Numero de permisos</th>
        <th scope="col">Fecha creacion</th>
      </tr>
    </thead>
    <tbody>
    @foreach($roles as $rol)
      <tr>
        <th scope="row">{{$loop->index +1}}</th>
        <td>{{$rol->nombre_rol}}</td>
        <td>{{$rol->numero_permisos}}</td>
        <td>{{$rol->created_at}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

</div>

<!-- fin codigo importante -->

@endsection
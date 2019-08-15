@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><span class="badge badge-libreria">Usuarios <small>Usuarios del sistema</small></span></h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/usuarios">Usuarios</a></li>
              <li class="breadcrumb-item active">Nuevo</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
                <div class="col-md-6 offset-md-3">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('usuarios.store') }}" method="POST">
                           @csrf
                            <div class="form-group {{ $errors->has('nombres') ? ' is-invalid' : '' }}">
                                <label for="nombres" class="control-label">Nombres</label>
                                <input type="text" class="form-control {{ $errors->has('nombres') ? ' is-invalid' : '' }}" name="nombres" value="{{ old('nombres') }}">
                                @if ($errors->has('nombres'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('nombres') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="apellidos" class="control-label">Apellidos</label>
                                <input type="text" class="form-control {{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" value="{{ old('apellidos') }}">
                                @if ($errors->has('apellidos'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('apellidos') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="dpi" class="control-label">DPI</label>
                                <input type="text" class="form-control {{ $errors->has('dpi') ? ' is-invalid' : '' }}" name="dpi" value="{{ old('dpi') }}">
                                @if ($errors->has('dpi'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('dpi') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="direccion" class="control-label">Dirección</label>
                                <input type="text" class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="{{ old('direccion') }}">
                                @if ($errors->has('direccion'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('direccion') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="telefono" class="control-label">Teléfono</label>
                                <input type="text" class="form-control {{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono') }}">
                                @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('telefono') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="rol" class="control-label">Rol</label>
                                <select name="rol" id="" class="form-control {{ $errors->has('rol') ? ' is-invalid' : '' }}">
                                  <option value="0">--Seleccione una opción--</option>
                                  @foreach($roles as $rol)
                                    <option value="{{ $rol->id}}">{{ $rol->nombre}}</option>
                                  @endforeach
                                </select>
                                 @if ($errors->has('rol'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('rol') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">Correo electrónico</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('email') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Contraseña</label>
                                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                                 @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('password') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Repetir contraseña</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                            <div class="form-group">
                                 <button type="submit" class="btn btn-primary" style="float: right;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.container-fluid -->    
                </div>
          </div>
    </section>
    <!-- /.content -->
@endsection



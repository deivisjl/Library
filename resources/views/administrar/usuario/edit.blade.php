@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><span class="badge badge-libreria">Editar usuario <small>Usuarios del sistema</small></span></h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/usuarios">Usuarios</a></li>
              <li class="breadcrumb-item active">Editar</li>
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
                        <form action="{{ url('usuarios', [$usuario->id]) }}" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                           @csrf
                            <div class="form-group {{ $errors->has('nombres') ? ' is-invalid' : '' }}">
                                <label for="nombres" class="control-label">Nombres</label>
                                <input type="text" class="form-control {{ $errors->has('nombres') ? ' is-invalid' : '' }}" name="nombres" value="{{ $usuario->nombres }}">
                                @if ($errors->has('nombres'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('nombres') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="apellidos" class="control-label">Apellidos</label>
                                <input type="text" class="form-control {{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" value="{{ $usuario->apellidos }}">
                                @if ($errors->has('apellidos'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('apellidos') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="dpi" class="control-label">DPI</label>
                                <input type="text" class="form-control {{ $errors->has('dpi') ? ' is-invalid' : '' }}" name="dpi" value="{{ $usuario->dpi }}">
                                @if ($errors->has('dpi'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('dpi') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="direccion" class="control-label">Dirección</label>
                                <input type="text" class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="{{ $usuario->direccion }}">
                                @if ($errors->has('direccion'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('direccion') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="telefono" class="control-label">Teléfono</label>
                                <input type="text" class="form-control {{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ $usuario->telefono }}">
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
                                    <option value="{{ $rol->id}}"
                                        @if($rol->id == $usuario->rol_id)
                                                selected='selected'
                                        @endif
                                        >{{ $rol->nombre}}</option>
                                  @endforeach
                                </select>
                                 @if ($errors->has('rol'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('rol') }}</span>
                                    </span>
                                @endif
                            </div>                            
                            <div class="form-group">
                                 <button type="submit" class="btn btn-success" style="float: right;">Editar</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.container-fluid -->    
                </div>
          </div>
    </section>
    <!-- /.content -->
@endsection



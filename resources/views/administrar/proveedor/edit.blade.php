@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><span class="badge badge-libreria">Editar proveedor <small>Registro de proveedores</small></span></h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/proveedor">Proveedores</a></li>
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
                        <form action="{{ url('proveedor', [$proveedor->id]) }}" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                           @csrf
                            <div class="form-group {{ $errors->has('nombre') ? ' is-invalid' : '' }}">
                                <label for="nombre" class="control-label">Nombre</label>
                                <input type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $proveedor->nombre }}">
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('nombre') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="nit" class="control-label">NIT</label>
                                <input type="text" class="form-control {{ $errors->has('nit') ? ' is-invalid' : '' }}" name="nit" value="{{ $proveedor->nit }}">
                                @if ($errors->has('nit'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('nit') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="direccion" class="control-label">Dirección</label>
                                <input type="text" class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="{{ $proveedor->direccion }}">
                                @if ($errors->has('direccion'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('direccion') }}</span>
                                    </span>
                                @endif
                            </div>
                             <div class="form-group">
                                <label for="telefono" class="control-label">Teléfono</label>
                                <input type="text" class="form-control {{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ $proveedor->telefono }}">
                                @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('telefono') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">Correo electrónico</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $proveedor->email }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('email') }}</span>
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



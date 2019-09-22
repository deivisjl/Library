@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><span class="badge badge-libreria">Editar cliente <small>Clientes en el sistema</small></span></h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/cliente">Clientes</a></li>
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
                        <form action="{{ url('cliente', [$cliente->id]) }}" method="POST" autocomplete="off">
                          <input name="_method" type="hidden" value="PUT">
                           @csrf
                            <div class="form-group {{ $errors->has('nombre') ? ' is-invalid' : '' }}">
                                <label for="nombre" class="control-label">Nombres</label>
                                <input type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $cliente->nombres }}">
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('nombre') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('apellido') ? ' is-invalid' : '' }}">
                                <label for="apellido" class="control-label">Apellidos</label>
                                <input type="text" class="form-control {{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{ $cliente->apellidos }}">
                                @if ($errors->has('apellido'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('apellido') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('nit') ? ' is-invalid' : '' }}">
                                <label for="nit" class="control-label">NIT</label>
                                <input type="text" class="form-control {{ $errors->has('nit') ? ' is-invalid' : '' }}" name="nit" value="{{ $cliente->nit }}">
                                @if ($errors->has('nit'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('nit') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('direccion') ? ' is-invalid' : '' }}">
                                <label for="direccion" class="control-label">Dirección</label>
                                <input type="text" class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="{{ $cliente->direccion }}">
                                @if ($errors->has('direccion'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('direccion') }}</span>
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



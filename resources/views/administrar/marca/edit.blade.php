@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><span class="badge badge-libreria">Editar marca <small>Registro de marcas</small></span></h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/marca">Marcas</a></li>
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
                        <form action="{{ url('marca', [$marca->id]) }}" method="POST" autocomplete="off">
                            <input name="_method" type="hidden" value="PUT">
                           @csrf
                            <div class="form-group {{ $errors->has('nombre') ? ' is-invalid' : '' }}">
                                <label for="nombre" class="control-label">Nombre de la marca</label>
                                <input type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $marca->nombre }}">
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('nombre') }}</span>
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



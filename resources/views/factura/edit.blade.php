@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><span class="badge badge-libreria">Habilitar facturas <small>Registro de facturas habilitadas</small></span></h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/habilitar-facturas">Facturas</a></li>
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
                         <form action="{{ url('habilitar-facturas', [$factura->id]) }}" method="POST" autocomplete="off">
                            <input name="_method" type="hidden" value="PUT">
                           @csrf
                           <div class="form-group { $errors->has('serie') ? 'is-invalid' : ''}">
                                <label for="" class="control-label">Serie</label>
                                <select name="serie" id="" class="form-control {{ $errors->has('serie') ? ' is-invalid' : '' }}">
                                    <option value="0">-- Seleccione una serie --</option>
                                    @foreach($series as $serie)
                                    <option value="{{ $serie->id }}"
                                        @if($factura->serie_id == $serie->id)
                                            selected="selected"
                                        @endif
                                        >{{ $serie->nombre }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('serie'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('serie') }}</span>
                                    </span>
                                @endif
                           </div>
                           
                           <div class="form-group {{ $errors->has('desde') ? ' is-invalid' : '' }}">
                                <label for="desde" class="control-label">Desde</label>
                                <input type="text" class="form-control {{ $errors->has('desde') ? ' is-invalid' : '' }}" name="desde" value="{{ $factura->desde }}">
                                @if ($errors->has('desde'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('desde') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('hasta') ? ' is-invalid' : '' }}">
                                <label for="hasta" class="control-label">Hasta</label>
                                <input type="text" class="form-control {{ $errors->has('hasta') ? ' is-invalid' : '' }}" name="hasta" value="{{ $factura->hasta }}">
                                @if ($errors->has('hasta'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('hasta') }}</span>
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



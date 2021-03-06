@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><span class="badge badge-libreria">Editar producto <small>Registro de productos</small></span></h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/producto">Productos</a></li>
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
                        <form action="{{ url('producto', [$producto->id]) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                           @csrf
                           <div class="form-group { $errors->has('categoria') ? 'is-invalid' : ''}">
                                <label for="" class="control-label">Categoría</label>
                                <select name="categoria" id="" class="form-control {{ $errors->has('categoria') ? ' is-invalid' : '' }}">
                                    <option value="0">-- Seleccione una categoría --</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        @if($categoria->id == $producto->categoria_id)
                                            selected='selected'
                                        @endif
                                        >{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('categoria'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('categoria') }}</span>
                                    </span>
                                @endif
                           </div>
                           <div class="form-group { $errors->has('marca') ? 'is-invalid' : ''}">
                                <label for="" class="control-label">Marca</label>
                                <select name="marca" id="" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}">
                                    <option value="0">-- Seleccione una categoría --</option>
                                    @foreach($marcas as $marca)
                                    <option value="{{ $marca->id }}"
                                    @if($marca->id == $producto->marca_id)
                                       selected="selected"
                                    @endif
                                    >{{ $marca->nombre }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('marca'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('marca') }}</span>
                                    </span>
                                @endif
                           </div>
                            <div class="form-group {{ $errors->has('nombre') ? ' is-invalid' : '' }}">
                                <label for="nombre" class="control-label">Nombre del producto</label>
                                <input type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $producto->nombre }}">
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('nombre') }}</span>
                                    </span>
                                @endif
                            </div>
                           <div class="form-group {{ $errors->has('minimo') ? ' is-invalid' : '' }}">
                                <label for="minimo" class="control-label">Stock minímo</label>
                                <input type="text" class="form-control {{ $errors->has('minimo') ? ' is-invalid' : '' }}" name="minimo" value="{{ $producto->stock_minimo }}">
                                @if ($errors->has('minimo'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('minimo') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('maximo') ? ' is-invalid' : '' }}">
                                <label for="maximo" class="control-label">Stock máximo</label>
                                <input type="text" class="form-control {{ $errors->has('maximo') ? ' is-invalid' : '' }}" name="maximo" value="{{ $producto->stock_maximo }}">
                                @if ($errors->has('maximo'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('maximo') }}</span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('imagen') ? ' is-invalid' : '' }}">
                                <label for="imagen" class="control-label">Imagen</label>
                                <input type="file" class="form-control {{ $errors->has('imagen') ? ' is-invalid' : '' }}" name="imagen">
                                @if ($errors->has('imagen'))
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $errors->first('imagen') }}</span>
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



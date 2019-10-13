@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Página principal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Empleado</li>
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
                      <div class="row text-center">
                          <div class="col-md-12">
                              <h5>Bienvenido (a) <strong>{{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}</strong></h5> 
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card" style="max-width: 540px;">
                  <div class="row no-gutters">
                    <div class="col-md-4">
                      <img src="{{ asset('img/user.jpg')}}" class="card-img" alt="usuario">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <p class="card-text">Tu rol en el sistema: <strong>{{ Auth::user()->rol->nombre }}</strong></p>
                        <p class="card-text">Tu correo asociado: <strong>{{ Auth::user()->email }}</strong></p>
                        <p class="card-text">Tu fecha de registro: <strong>{{ $fecha = \Carbon\Carbon::parse(Auth::user()->created_at)->format('d-m-Y H:i a') }}</strong></p>
                        <p class="card-text">Tu último acceso al sistema: <strong>{{ $fecha = \Carbon\Carbon::parse(Auth::user()->last_login)->format('d-m-Y H:i a') }}</strong></p>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

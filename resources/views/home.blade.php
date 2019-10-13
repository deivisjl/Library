@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-body">
                  <div class="row">
                     <div class="col-md-12">
                         <notificacion-factura-component></notificacion-factura-component>
                     </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <bar-chart-component></bar-chart-component>
                    </div>
                    <div class="col-md-6">
                        <donut-chart-component></donut-chart-component>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                      <line-chart-component></line-chart-component>
                  </div>
                </div>
              </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

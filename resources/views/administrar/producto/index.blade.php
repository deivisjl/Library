@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><span class="badge badge-libreria">Productos <small>Productos en el sistema</small></span></h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item active">Productos</li>
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
                    <a href="{{ route('producto.create') }}" class="btn btn-primary btn-sm" style="float:right; color:#fff">Nuevo registro</a>
                  </div>
                </div>
                 <table id="listar" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="width:10%; text-align: center">No.</th>
                          <th>Nombre</th>   
                          <th>Marca</th>
                          <th>Categoria</th>
                          <th>Imagen</th>                
                          <th>Acción</th>
                        </tr>
                      </thead>
                  </table>
              </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
          listar();
      });

    var  listar = function(){
        var table = $("#listar").DataTable({
            "processing": true,
            "serverSide": true,
            "destroy":true,
            "ajax":{
            'url': '/producto/show',
            'type': 'GET'
          },
          "dom":"<'row'<'col-sm-12'tr>><'row'<'col-sm-4'l><'col-sm-3'f><'col-sm-5'p>>",
          
          "columns":[
              {'data': 'id'},
              {'data': 'nombre'},
              {'data': 'marca'},
              {'data': 'categoria'},
              {'data': 'img_url', "render":function ( data, type, row, meta ) {
                                return '<img src="'+data+'" style="width: 50px; display:block; margin:auto">';
                               }, "orderable":false
              },   
              {'defaultContent':'<a href="" class="editar badge bg-green"  data-toggle="tooltip" data-placement="top" title="Editar registro"><i class="fas fa-pencil-alt"></i> Editar</a> <a href="" class="borrar badge bg-danger"  data-toggle="tooltip" data-placement="top" title="Borrar registro"><i class="fas fa-trash-alt"></i> Eliminar</a>', "orderable":false}
          ],
          "language": idioma_spanish,

          "order": [[ 0, "asc" ]]

        });
        obtener_data_editar("#listar tbody",table);
    }

    var obtener_data_editar = function(tbody,table){
         $(tbody).on("click","a.editar",function(e){
          e.preventDefault();
        var data = table.row($(this).parents("tr")).data();
        
        var id = data.id;

         window.location.href = "/producto/" + id + "/edit";

      });
      }
</script>
@endsection
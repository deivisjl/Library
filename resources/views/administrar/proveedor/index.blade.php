@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><span class="badge badge-libreria">Provedores <small>Proveedores registrados</small></span></h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item active">Proveedores</li>
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
                    <a href="{{ route('proveedor.create') }}" class="btn btn-primary btn-sm" style="float:right; color:#fff">Nuevo registro</a>
                  </div>
                </div>
                 <table id="listar" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="width:10%; text-align: center">No.</th>
                          <th>Nombre</th>                   
                          <th>NIT</th>
                          <th>Dirección</th>
                          <th>Teléfono</th>
                          <th>Correo electrónico</th>
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
            'url': '/proveedor/show',
            'type': 'GET'
          },
          "dom":"<'row'<'col-sm-12'tr>><'row'<'col-sm-4'l><'col-sm-3'f><'col-sm-5'p>>",
          
          "columns":[
              {'data': 'id'},
              {'data': 'nombre'},   
              {'data': 'nit'},
              {'data': 'direccion'},
              {'data': 'telefono'},
              {'data': 'email'},
              {'defaultContent':'<a href="" class="editar badge bg-green"  data-toggle="tooltip" data-placement="top" title="Editar registro"><i class="fas fa-pencil-alt"></i> Editar</a> <a href="" class="borrar badge bg-danger"  data-toggle="tooltip" data-placement="top" title="Eliminar registro"><i class="fas fa-trash-alt"></i> Eliminar</a>', "orderable":false}
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

             window.location.href = "/proveedor/" + id + "/edit";

          });

         $(tbody).on("click","a.borrar",function(e){
             e.preventDefault();
            var data = table.row($(this).parents("tr")).data();
            
            var id = data.id;

             Swal.fire({
                  title: '¿Está seguro de eliminar este registro?',
                  type: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Aceptar',
                  cancelButtonText: 'Cancelar'
                }).then((result) => {

                   if (result.value) {
                      axios.delete('/proveedor/'+id)
                          .then(response => {

                              Toastr.success(response.data.data,'Mensaje')
                                $('#listar').DataTable().ajax.reload();
                              
                          })
                          .catch(error => {
                              if (error.response) {
                                  Toastr.error(error.response.data.error,''); 
                              }else{
                                  Toastr.error('Ocurrió un error: ' + error,'Error');
                              }
                          });
                   }
                    
                });

             
          });
      }
</script>
@endsection
@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><span class="badge badge-libreria">Ventas <small>Ventas de productos</small></span></h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item active">Ventas</li>
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
                    <a href="{{ route('ventas.create') }}" class="btn btn-primary btn-sm" style="float:right; color:#fff">Nuevo registro</a>
                  </div>
                </div>
                 <table id="listar" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="width:10%; text-align: center">No.</th>
                          <th>Serie</th>
                          <th>Factura</th>
                          <th>Cliente</th> 
                          <th>NIT</th>
                          <th>Monto</th>   
                          <th>Fecha</th>                
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
            'url': '/ventas-obtener/show',
            'type': 'GET'
          },
          "dom":"<'row'<'col-sm-12'tr>><'row'<'col-sm-4'l><'col-sm-3'f><'col-sm-5'p>>",
          
          "columns":[
              {'data': 'id'},
              {'data': 'serie'},
              {'data': 'no_factura'},
              {'data': 'cliente'},
              {'data': 'nit'},
              {'data': 'monto'}, 
              {'data': 'fecha',"searchable":false,"orderable":false},   
              {'defaultContent':'<a href="" class="anular badge bg-danger"  data-toggle="tooltip" data-placement="top" title="Borrar registro"><i class="fas fa-ban"></i> Anular</a>', "orderable":false}
          ],
          "language": idioma_spanish,

          "order": [[ 0, "desc" ]]

        });
        obtener_data_editar("#listar tbody",table);
    }

    var obtener_data_editar = function(tbody,table){
         
         $(tbody).on("click","a.anular",function(e){
             e.preventDefault();
            var data = table.row($(this).parents("tr")).data();
            
            var id = data.id;

             Swal.fire({
                  title: '¿Está seguro de anular esta venta?',
                  //text: 'Confirmar',
                  type: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Aceptar',
                  cancelButtonText: 'Cancelar'
                }).then((result) => {

                   if (result.value) {
                      axios.delete('/ventas/'+id)
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



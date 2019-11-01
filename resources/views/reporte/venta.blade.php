@extends('layouts.libreria')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><span class="badge badge-libreria">Reporte de ventas <small>Reportes</small></span></h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Inicio</a></li>
              <li class="breadcrumb-item active">Reporte de venta</li>
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
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                            <form id="form-venta" method="POST" action="" class="form-inline">
                              @csrf
                                <div class="form-group mb-2">
                                  <label for="staticEmail2" class="sr-only">Fecha desde</label>
                                  <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Fecha desde">
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                  <input type="date" class="form-control" id="desde">
                                </div>
                                <div class="form-group mb-2">
                                  <label for="staticEmail2" class="sr-only">Fecha hasta</label>
                                  <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Fecha hasta">
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                  <input type="date" class="form-control" id="hasta">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Imprimir</button>
                              </form>                           
                    </div>
                </div><!-- /.container-fluid -->    
                </div>
          </div>
    </section>
    <!-- /.content -->
@endsection
@section('js')
<script>

  $('#form-venta').on('submit',function(e){
      e.preventDefault();

          obtener_venta();
  });

  obtener_venta = function(){
      
      var desde = $('#desde').val();
      var hasta = $('#hasta').val();

      if(!desde || !hasta)
      {
        Toastr.error('Los campos de búsqueda son requeridos','Mensaje: ');

      }
      else
      {
          var data = {desde:desde,hasta:hasta};
            
           $.ajax({
                type:'GET',
                url:'/reporte-pdf-venta-obtener/show',
                data:data,                    
                xhrFields: {
                    responseType: 'blob'
                },
                success:function(response,status,xhr)
                {
                    var filename = "";                   
                  var disposition = xhr.getResponseHeader('Content-Disposition');

                   if (disposition) {
                      var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                      var matches = filenameRegex.exec(disposition);
                      if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                  } 
                  var linkelem = document.createElement('a');
                  try {
                        var blob = new Blob([response], { type: 'application/octet-stream' });                        

                      if (typeof window.navigator.msSaveBlob !== 'undefined') {
                          //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                          window.navigator.msSaveBlob(blob, filename);
                      } else {
                          var URL = window.URL || window.webkitURL;
                          var downloadUrl = URL.createObjectURL(blob);

                          if (filename) { 
                              // use HTML5 a[download] attribute to specify filename
                              var a = document.createElement("a");

                              // safari doesn't support this yet
                              if (typeof a.download === 'undefined') {
                                  window.location = downloadUrl;
                              } else {

                                  a.href = downloadUrl;
                                  a.download = filename;
                                  document.body.appendChild(a);
                                  a.target = "_blank";
                                  a.click();
                              }
                          } else {
                              
                              window.location = downloadUrl;
                          }

                          setTimeout(function () {
                                URL.revokeObjectURL(downloadUrl);
                            }, 100); // Cleanup
                      }   

                  } catch (ex) {
                      console.log(ex);
                  }

                  //loading.classList.remove('block-loading');  

                },
                error: function(e)
                {
                    //loading.classList.remove('block-loading'); 
                    Toastr.error('Error: ' + e.statusText,'');                
                }
              });

      }
  }

  
</script>
@endsection



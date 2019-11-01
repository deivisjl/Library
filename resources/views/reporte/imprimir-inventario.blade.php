<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<style type="text/css">
			.table {
				    width: 100%;
				    max-width: 100%;
				    margin-bottom: 20px;
			}
			.table-bordered {
			    border: 1px solid #ddd;
			}

			table {
				    background-color: transparent;
				}

			table {
			    border-spacing: 0;
			    border-collapse: collapse;
			}


			.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
				    border: 1px solid #ddd;
				}
			.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
			    padding: 8px;
			    line-height: 1.42857143;
			    vertical-align: top;
			    border-top: 1px solid #ddd;
			}
			th {
			    text-align: left;
			}
			td, th {
			    padding: 0;
			}

			.panel-libreria {
			    border-color: #007bff;
			}
			.custom-table {
				    background-color: #007bff !important;
				    color: #fff !important;
				}
			

	</style></style>
</head>
<body>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-libreria">
				<div class="panel-body">
					<table width="100%" style="margin-bottom: 25px;">
						<tbody>
							<tr style="text-align: center;">
								<td><span style="font-weight: bold; font-size: 30px;">Librería Luisito</span></td>
							</tr>
							<tr style="text-align: center">
								<td>Egla López Morales</td>
							</tr>
							<tr style="text-align: center">
								<td>1a. avenida 12-15 zona 1, Chiquimulilla, Santa Rosa</td>
							</tr>
						</tbody>
					</table>				
				</div>
			</div>
		</div>
	</div>
	<div class="row text-center">
		<div class="col-xs-12"><h4>Reporte de inventario al
			<span>{{ $desde = \Carbon\Carbon::now()->format('d-m-Y') }}</span></h4></div>
	</div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>Categoria</th>
				<th>Producto</th>
				<th>Stock</th>
			</tr>
		</thead>
		<tbody>
			@foreach($inventario as $index => $item)
				<tr>
					<td class="text-center">{{ $index + 1 }}</td>
					<td>{{ $item->categoria }}</td>
					<td class="text-center">{{ $item->producto }}</td>
					<td class="text-center">{{ $item->stock }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<br>

</body>
</html>
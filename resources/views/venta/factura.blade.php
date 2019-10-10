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
	<table width="100%">
		<tr>
			<th width="70%">Factura Serie "{{ $venta->serie }}" No. {{ $venta->no_factura }}</th>
			<th width="10%" class="text-center table-bordered" style="border: 1px solid #007bff;background-color: #007bff; color:#fff;">DIA</th>
			<th width="10%" class="text-center table-bordered" style="border: 1px solid #007bff; background-color: #007bff; color:#fff;">MES</th>
			<th width="10%" class="text-center table-bordered" style="border: 1px solid #007bff; background-color: #007bff; color:#fff;">AÑO</th>
		</tr>
		<tr>
			<td width="70%"></td>
			<td width="10%" class="text-center table-bordered" style="border: 1px solid #007bff;">{{ $dia = \Carbon\Carbon::parse($venta->created_at)->format('d') }}</td>
			<td width="10%" class="text-center table-bordered" style="border: 1px solid #007bff;">{{ $mes = \Carbon\Carbon::parse($venta->created_at)->format('m') }}</td>
			<td width="10%" class="text-center table-bordered" style="border: 1px solid #007bff;">{{ $year = \Carbon\Carbon::parse($venta->created_at)->format('Y') }}</td>
		</tr>
	</table>
	<br>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-libreria">
				<div class="panel-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td><strong>Nombre:</strong> {{ $venta->cliente['nombres'] }} {{ $venta->cliente['apellidos'] }}</td>
							</tr>
							<tr>
								<td><strong>Dirección:</strong> {{ $venta->cliente['direccion'] }}</td>
							</tr>
							<tr>
								<td><strong>NIT:</strong> {{ $venta->cliente['nit'] }}</td>
							</tr>
						</tbody>
					</table>				
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-libreria">
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<tr class="custom-table">
								<th width="10%" class="text-center"><strong>CANTIDAD</strong></th>
								<th width="30%" class="text-center"><strong>DESCRIPCION</strong></th>
								<th width="10%" class="text-center"><strong>VALOR</strong></th>
							</tr>
						</thead>
						<tbody>

							@foreach($detalle_venta as $index => $item)
							<tr>
								<td class="text-center">{{ $item->cantidad }}</td>
								<td>{{ $item->nombre }}</td>
								<td class="text-center">{{ $item->subtotal }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<table width="100%">
		<tr>
			<td  style="width: 66.66%">
				
			</td>
			<td style="width: 33.33%">
				<table class="table table-bordered">
					<thead>
						<tr class="custom-table"><th class="text-center">TOTAL</th></tr>
					</thead>
					<tbody><tr><td class="text-center"><strong>Q. {{ $venta->monto }}</strong></td></tr></tbody>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
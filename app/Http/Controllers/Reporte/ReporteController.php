<?php

namespace App\Http\Controllers\Reporte;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mensual()
    {

        $periodo = Carbon::now()->format('Y');

        $registros = DB::table('venta')
                            ->select(DB::raw('SUM(monto) as total'),DB::raw('date_format(created_at,"%m") as fecha'))
                            ->groupBy(DB::raw('date_format(created_at,"%m")'))                            
                            ->where('anulada','=',0)                            
                            ->get();

        $grafica = $this->donut($registros);

        return response()->json(['data' => $grafica]);        
    }

    public function donut($data)
    {
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

        $etiquetas = array();  
        $valores = array();

                foreach ($data as $key => $value) {

                    $indice = (int)$value->fecha;

                    $etiquetas[$key] = $meses[$indice];
                    $valores[$key] = (int)$value->total;
                }

        $result = array('meses' => $etiquetas, 'montos' =>$valores);

        return $result;

    }

    public function mas_vendidos()
    {
        $registros = DB::table('detalle_venta')
                        ->join('venta','detalle_venta.venta_id','=','venta.id')
                        ->join('producto','detalle_venta.producto_id','=','producto.id')
                        ->select('producto.nombre',DB::raw('SUM(detalle_venta.cantidad) as total'))
                        ->where('venta.anulada','=',0)
                        ->groupBy('producto.nombre')
                        ->orderBy('total','desc')
                        ->take(3)
                        ->get();

        $grafica = $this->bar_chart($registros);

        return response()->json(['data' => $grafica]);
    }

    public function bar_chart($data)
    {
        $base = array();
        $barras = array();

        foreach ($data as $key => $value) {
            $base[$key] = $value->nombre;
        }

        $xaxis = array('categories' => $base);

        foreach ($data as $key => $value) {
            $barras[$key] = (int)$value->total;
        }

        $objeto = array('name' => 'Cantidad vendida','data' => $barras);

        $series = [$objeto];

        $result = array('base' => $xaxis,'series' => $series);

        return $result;
    }

    public function ventas()
    {

        $ventas = DB::table('venta')
                    ->select(DB::raw('SUM(monto) as total'),DB::raw('date_format(created_at,"%m") as fecha'))
                    ->groupBy(DB::raw('date_format(created_at,"%m")'))      
                    ->get();

        $registros = $this->linear_chart_ventas($ventas);

        return response()->json(['data' => $registros]);
    }

    public function linear_chart_ventas($ventas)
    {
        $meses = ['En', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ag', 'Sep','Oct','Nov','Dic'];

        $comprado = array();
        $etiquetas = array();  

                foreach ($ventas as $key => $value) {

                    $indice = (int)$value->fecha;

                    $etiquetas[$key] = $meses[$indice];

                    $comprado[$key] = (int)$value->total;
                }

        $valores = array('name' => 'Monto vendido','data' => $comprado);

        $series = [$valores];

        $xaxis = array('categories' => $etiquetas);

        $result = array('etiquetas' => $xaxis,'valores' => $series);

        return $result;
    }

     public function compras()
    {
        $compras = DB::table('compra')
                    ->select(DB::raw('SUM(monto) as total'),DB::raw('date_format(created_at,"%m") as fecha'))
                    ->groupBy(DB::raw('date_format(created_at,"%m")'))      
                    ->get();

        $registros = $this->linear_chart_compras($compras);

        return response()->json(['data' => $registros]);
    }

    public function linear_chart_compras($compras)
    {
        $meses = ['En', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ag', 'Sep','Oct','Nov','Dic'];

        $comprado = array();
        $etiquetas = array();  

                foreach ($compras as $key => $value) {

                    $indice = (int)$value->fecha;

                    $etiquetas[$key] = $meses[$indice];

                    $comprado[$key] = (int)$value->total;
                }

        $valores = array('name' => 'Monto comprado','data' => $comprado);

        $series = [$valores];

        $xaxis = array('categories' => $etiquetas);

        $result = array('etiquetas' => $xaxis,'valores' => $series);

        return $result;
    }

}

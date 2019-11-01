<?php

namespace App\Http\Controllers\Reporte;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportePdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function venta()
    {
        return view('reporte.venta');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function venta_obtener(Request $request)
    {
        try 
        {
            $ventas = DB::table('venta')
                        ->select('no_factura','monto')
                        ->where('anulada','=',0)
                        ->whereBetween('created_at', [$request->get('desde'), $request->get('hasta')])
                        ->get();

        $pdf = \PDF::loadView('reporte.imprimir-venta',['ventas' => $ventas,'desde'=> $request->get('desde'),'hasta'=>$request->get('hasta')]);

             $pdf->setPaper('letter', 'portrait');
            
             return $pdf->download('reporte_venta_'.Carbon::now()->format('dmY_h:m:s').'.pdf');
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error',$e->getMessage()],422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function compra()
    {
        return view('reporte.compra');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function compra_obtener(Request $request)
    {
         try 
        {
            $ventas = DB::table('compra')
                        ->select('factura_compra_no','monto')
                        ->where('anulada','=',0)
                        ->whereBetween('created_at', [$request->get('desde'), $request->get('hasta')])
                        ->get();

        $pdf = \PDF::loadView('reporte.imprimir-compra',['ventas' => $ventas,'desde'=> $request->get('desde'),'hasta'=>$request->get('hasta')]);

             $pdf->setPaper('letter', 'portrait');
            
             return $pdf->download('reporte_compra_'.Carbon::now()->format('dmY_h:m:s').'.pdf');
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error',$e->getMessage()],422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inventario()
    {
        return view('reporte.inventario');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inventario_obtener()
    {
        try 
        {
            $inventario = DB::table('inventario')
                        ->join('producto','inventario.producto_id','=','producto.id')
                        ->join('categoria','producto.categoria_id','=','categoria.id')
                        ->select('producto.nombre as producto','inventario.stock','categoria.nombre as categoria')
                        //->whereBetween('created_at', [$request->get('desde'), $request->get('hasta')])
                        ->orderBy('categoria.nombre','asc')
                        ->get();

        $pdf = \PDF::loadView('reporte.imprimir-inventario',['inventario' => $inventario]);

             $pdf->setPaper('letter', 'portrait');
            
             return $pdf->download('reporte_compra_'.Carbon::now()->format('dmY_h:m:s').'.pdf');
        } 
        catch (\Exception $e) 
        {
            return response()->json(['error',$e->getMessage()],422);
        }
    }

}

<?php

namespace App\Http\Controllers\Reporte;

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
        $registros = DB::table('venta')
                            ->select(DB::raw('SUM(monto) as total'),DB::raw('date_format(created_at,"%m") as fecha'))
                            ->groupBy(DB::raw('date_format(created_at,"%m")'))
                            ->where('anulada','=',0)                            
                            ->get();

        return response()->json(['data' => $registros]);        
    }

}

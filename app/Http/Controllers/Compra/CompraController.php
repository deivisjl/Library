<?php

namespace App\Http\Controllers\Compra;

use App\Compra;
use App\Producto;
use App\Proveedor;
use App\DetalleCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('compra.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('compra.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try 
        {
            $datos = $request->all();

            DB::beginTransaction();

            $compra = new Compra();
            $compra->proveedor_id = $request->get('proveedor_id');
            $compra->factura_compra_no = $request->get('factura');
            $compra->monto = $request->get('monto');
            $compra->save();

            foreach ($datos['detalle'] as $key => $value) {
                $detalle = new DetalleCompra();
                $detalle->compra_id = $compra->id;
                $detalle->producto_id = $value['id'];
                $detalle->cantidad = $value['cantidad'];
                $detalle->precio_unitario = $value['precio'];
                $detalle->save();
            }

            DB::commit();

            return response()->json(['data' => 'Compra registrada con éxito'],200);    
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()],422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show($criterio)
    {
        $proveedores = Proveedor::where('nit','LIKE','%'.$criterio.'%')->get();

        return response()->json(['data' => $proveedores,'code' => 200]);
    }

    public function producto($criterio)
    {
        $productos = Producto::with('marca')->where('producto.nombre','LIKE','%'.$criterio.'%')->get();

        return response()->json(['data' => $productos,'code' => 200]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }

    public function compra(Request $request){

        $ordenadores = array("compra.id","proveedor.nombre","compra.factura_compra_no","compra.monto");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $compras = DB::table('compra') 
                ->join('proveedor','proveedor.id','=','compra.proveedor_id')
                ->select('compra.id','proveedor.nombre as proveedor','compra.factura_compra_no as factura','compra.monto',DB::raw('date_format(compra.created_at,"%d-%m-%Y") as fecha')) 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('compra') 
                ->join('proveedor','proveedor.id','=','compra.proveedor_id')
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->count();
               
        $data = array(
        'draw' => $request->draw,
        'recordsTotal' => $count,
        'recordsFiltered' => $count,
        'data' => $compras,
        );

        return response()->json($data, 200);
    }
}

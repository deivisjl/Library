<?php

namespace App\Http\Controllers\Venta;

use App\Venta;
use App\Cliente;
use App\Producto;
use App\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('venta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('venta.create');
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

            $venta = new Venta();
            $venta->cliente_id = $request->get('cliente_id');
            $venta->monto = $request->get('monto');
            $venta->save();            

            foreach ($datos['detalle'] as $key => $value) {
                $detalle = new DetalleVenta();
                $detalle->venta_id = $venta->id;
                $detalle->producto_id = $value['id'];
                $detalle->cantidad = $value['cantidad'];
                $detalle->precio_unitario = $value['precio'];
                $detalle->save();
            }

            DB::commit();

            return response()->json(['data' => 'Venta registrada con éxito'],200);    
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($criterio)
    {
        $clientes = Cliente::where('nombres','LIKE','%'.$criterio.'%')->get();

        return response()->json(['data' => $clientes,'code' => 200]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function producto($criterio)
    {
        $productos = Producto::with('marca')->where('producto.nombre','LIKE','%'.$criterio.'%')->get();

        return response()->json(['data' => $productos,'code' => 200]);
    }

    public function venta(Request $request){

        $ordenadores = array("venta.id","cliente.nombres","cliente.nit","venta.monto");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $ventas = DB::table('venta') 
                ->join('cliente','venta.cliente_id','=','cliente.id')
                ->select('venta.id','venta.monto',DB::raw('CONCAT(cliente.nombres," ",cliente.apellidos) as cliente'),'cliente.nit',DB::raw('date_format(venta.created_at,"%d-%m-%Y") as fecha')) 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('venta') 
                ->join('cliente','venta.cliente_id','=','cliente.id')
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->count();
               
        $data = array(
        'draw' => $request->draw,
        'recordsTotal' => $count,
        'recordsFiltered' => $count,
        'data' => $ventas,
        );

        return response()->json($data, 200);
    }
}

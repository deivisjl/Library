<?php

namespace App\Http\Controllers\Administrar\Inventario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrar.inventario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ordenadores = array("producto.id","producto.nombre","marca.nombre","categoria.nombre","inventario.stock");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $productos = DB::table('producto') 
                ->join('categoria','producto.categoria_id','=','categoria.id')
                ->join('marca','producto.marca_id','=','marca.id')
                ->join('inventario','producto.id','=','inventario.producto_id')
                ->select('producto.id','producto.nombre as producto','producto.stock_minimo','marca.nombre as marca','categoria.nombre as categoria','inventario.stock') 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('producto') 
                ->join('categoria','producto.categoria_id','=','categoria.id')
                ->join('marca','producto.marca_id','=','marca.id')
                ->join('inventario','producto.id','=','inventario.producto_id')
                ->select('producto.id','producto.nombre as producto','producto.stock_minimo','marca.nombre as marca','categoria.nombre as categoria','inventario.stock') 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->count();
               
        $data = array(
        'draw' => $request->draw,
        'recordsTotal' => $count,
        'recordsFiltered' => $count,
        'data' => $productos,
        );

        return response()->json($data, 200);
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
}

<?php

namespace App\Http\Controllers\Administrar\Proveedor;

use App\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use HepplerDotNet\FlashToastr\Flash;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrar.proveedor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrar.proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
               'nombre' => 'required|string|max:100',
               'nit' => 'required|string|max:100',
               'direccion' => 'required|string|max:100',
               'telefono' => 'required|numeric|min:1',
               'email' => 'required|email',
            ];            

        $this->validate($request, $rules);

        $proveedor = new Proveedor();
        $proveedor->nombre = $request->get('nombre');
        $proveedor->nit = $request->get('nit');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->email = $request->get('email');
        $proveedor->save();        

        Flash::success('Mensaje','Registro guardado con éxito');

        return redirect('/proveedor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ordenadores = array("id","nombre","nit","direccion","telefono","email");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $users = DB::table('proveedor') 
                ->select('id','nombre','nit','direccion','telefono','email') 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('proveedor')
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->count();
               
        $data = array(
        'draw' => $request->draw,
        'recordsTotal' => $count,
        'recordsFiltered' => $count,
        'data' => $users,
        );

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
    return view('administrar.proveedor.edit',['proveedor' => $proveedor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
         $rules = [
               'nombre' => 'required|string|max:100',
               'nit' => 'required|string|max:100',
               'direccion' => 'required|string|max:100',
               'telefono' => 'required|numeric|min:1',
               'email' => 'required|email',
            ];            

        $this->validate($request, $rules);

        $proveedor->nombre = $request->get('nombre');
        $proveedor->nit = $request->get('nit');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->email = $request->get('email');
        $proveedor->save();        

        Flash::success('Mensaje','Registro actualizado con éxito');

        return redirect('/proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
}

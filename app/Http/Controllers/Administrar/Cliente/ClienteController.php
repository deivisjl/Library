<?php

namespace App\Http\Controllers\Administrar\Cliente;

use App\Venta;
use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use HepplerDotNet\FlashToastr\Flash;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrar.cliente.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrar.cliente.create');
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
               'apellido' => 'required|string|max:100',
               'nit' => 'required|string|max:10',
               'direccion' => 'required|string',
            ];            

        $this->validate($request, $rules);

        try {
            
            $cliente = new Cliente();
            $cliente->nombres = $request->get('nombre');
            $cliente->apellidos = $request->get('apellido');
            $cliente->nit = $request->get('nit');
            $cliente->direccion = $request->get('direccion');
            $cliente->save();        

            Flash::success('Mensaje','Registro guardado con éxito');

            return redirect('/cliente');

        } catch (\Exception $e) {

            Flash::error('Error',$e->getMessage());            

            return redirect()
                ->back()
                ->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ordenadores = array("id","nombre");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $categorias = DB::table('cliente') 
                ->select('id','nombres','apellidos','nit','direccion') 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('cliente')
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->count();
               
        $data = array(
        'draw' => $request->draw,
        'recordsTotal' => $count,
        'recordsFiltered' => $count,
        'data' => $categorias,
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
        $cliente = Cliente::findOrFail($id);

        return view('administrar.cliente.edit',['cliente' => $cliente]);
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
        $rules = [
               'nombre' => 'required|string|max:100',
               'apellido' => 'required|string|max:100',
               'nit' => 'required|string|max:10',
               'direccion' => 'required|string',
            ];            

        $this->validate($request, $rules);

        try {
            
            $cliente = Cliente::findOrFail($id);
            $cliente->nombres = $request->get('nombre');
            $cliente->apellidos = $request->get('apellido');
            $cliente->nit = $request->get('nit');
            $cliente->direccion = $request->get('direccion');
            $cliente->save();        

            Flash::success('Mensaje','Registro actualizado con éxito');

            return redirect('/cliente');

        } catch (\Exception $e) {

            Flash::error('Error',$e->getMessage());            

            return redirect()
                ->back()
                ->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        try {
            
            $relacion = Venta::where('cliente_id','=',$cliente->id)->count();

            if($relacion > 0){

                throw new \Exception("Este cliente tiene registros asociados", 1);
                
            }else{

                $cliente->delete();

                return response()->json(['data' => 'Registro eliminado con éxito'],200);  
            }

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()],422);
        }
    }
}

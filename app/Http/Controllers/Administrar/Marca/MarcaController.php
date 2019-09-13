<?php

namespace App\Http\Controllers\Administrar\Marca;

use App\Marca;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use HepplerDotNet\FlashToastr\Flash;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrar.marca.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrar.marca.create');
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
            ];            

        $this->validate($request, $rules);

        $marca = new Marca();
        $marca->nombre = $request->get('nombre');
        $marca->save();        

        Flash::success('Mensaje','Registro guardado con éxito');

        return redirect('/marca');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         $ordenadores = array("id","nombre");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $categorias = DB::table('marca') 
                ->select('id','nombre') 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('marca')
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
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        return view('administrar.marca.edit',['marca' => $marca]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
         $rules = [
               'nombre' => 'required|string|max:100',
            ];            

        $this->validate($request, $rules);

        $marca->nombre = $request->get('nombre');
        $marca->save();        

        Flash::success('Mensaje','Registro actualizado con éxito');

        return redirect('/marca');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        try {
            
            $relacion = Producto::where('marca_id','=',$marca->id)->first();

            if($relacion){

                throw new \Exception("Esta marca tiene registros asociados", 1);
                
            }else{

                $marca->delete();

                return response()->json(['data' => 'Registro eliminado con éxito'],200);  
            }

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()],422);
        }
    }
}

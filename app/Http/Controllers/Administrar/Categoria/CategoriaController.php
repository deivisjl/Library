<?php

namespace App\Http\Controllers\Administrar\Categoria;

use App\Producto;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use HepplerDotNet\FlashToastr\Flash;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrar.categoria.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrar.categoria.create');
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

        $categoria = new Categoria();
        $categoria->nombre = $request->get('nombre');
        $categoria->save();        

        Flash::success('Mensaje','Registro guardado con éxito');

        return redirect('/categoria');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ordenadores = array("id","nombre");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $categorias = DB::table('categoria') 
                ->select('id','nombre') 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('categoria')
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
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categorium)
    {
        return view('administrar.categoria.edit',['categoria' => $categorium]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categorium)
    {
        $rules = [
               'nombre' => 'required|string|max:100',
            ];            

        $this->validate($request, $rules);

        $categorium->nombre = $request->get('nombre');
        $categorium->save();        

        Flash::success('Mensaje','Registro actualizado con éxito');

        return redirect('/categoria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categorium)
    {
        try {
            
            $relacion = Producto::where('categoria_id','=',$categorium->id)->count();

            if($relacion > 0){

                throw new \Exception("Esta categoría tiene registros asociados", 1);
                
            }else{

                $categorium->delete();

                return response()->json(['data' => 'Registro eliminado con éxito'],200);  
            }

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()],422);
        }


    }
}

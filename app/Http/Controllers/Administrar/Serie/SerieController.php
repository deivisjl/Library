<?php

namespace App\Http\Controllers\Administrar\Serie;

use App\Serie;
use App\SerieHabilitada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use HepplerDotNet\FlashToastr\Flash;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrar.serie.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrar.serie.create');
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

        $serie = new Serie();
        $serie->nombre = $request->get('nombre');
        $serie->save();        

        Flash::success('Mensaje','Registro guardado con éxito');

        return redirect('/serie');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ordenadores = array("id","nombre");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $series = DB::table('serie') 
                ->select('id','nombre') 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('serie')
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->count();
               
        $data = array(
        'draw' => $request->draw,
        'recordsTotal' => $count,
        'recordsFiltered' => $count,
        'data' => $series,
        );

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $serie)
    {
        return view('administrar.serie.edit',['serie' => $serie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Serie $serie)
    {
         $rules = [
               'nombre' => 'required|string|max:100',
            ];            

        $this->validate($request, $rules);

        $serie->nombre = $request->get('nombre');
        $serie->save();        

        Flash::success('Mensaje','Registro actualizado con éxito');

        return redirect('/serie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie)
    {
        try {
            
            $relacion = SerieHabilitada::where('serie_id','=',$serie->id)->count();

            if($relacion > 0){

                throw new \Exception("Esta serie tiene registros asociados", 1);
                
            }else{

                $serie->delete();

                return response()->json(['data' => 'Registro eliminado con éxito'],200);  
            }

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()],422);
        }
    }
}

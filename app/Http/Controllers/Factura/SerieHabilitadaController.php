<?php

namespace App\Http\Controllers\Factura;

use App\Serie;
use App\SerieHabilitada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use HepplerDotNet\FlashToastr\Flash;

class SerieHabilitadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('factura.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $series = Serie::all();

        return view('factura.create',['series' => $series]);
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
               'serie' => 'required|numeric',
               'desde' => 'required|numeric',
               'hasta' => 'required|numeric',
            ];            

        $this->validate($request, $rules);

        $habilitar = new SerieHabilitada();
        $habilitar->serie_id = $request->get('serie');
        $habilitar->desde = $request->get('desde');
        $habilitar->hasta = $request->get('hasta');
        $habilitar->save();        

        Flash::success('Mensaje','Registro guardado con éxito');

        return redirect('/habilitar-facturas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SerieHabilitada  $serieHabilitada
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ordenadores = array("serie_habilitada.id","serie.nombre","serie_habilitada.desde","serie_habilitada.hasta");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $facturas = DB::table('serie_habilitada')
                ->join('serie','serie_habilitada.serie_id','=','serie.id')
                ->select('serie_habilitada.id','serie.nombre','serie_habilitada.desde','serie_habilitada.hasta','serie_habilitada.activo') 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('serie_habilitada')
                ->join('serie','serie_habilitada.serie_id','=','serie.id')
                ->select('serie_habilitada.id','serie.nombre','serie_habilitada.desde','serie_habilitada.hasta')
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->count();
               
        $data = array(
        'draw' => $request->draw,
        'recordsTotal' => $count,
        'recordsFiltered' => $count,
        'data' => $facturas,
        );

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SerieHabilitada  $serieHabilitada
     * @return \Illuminate\Http\Response
     */
    public function edit(SerieHabilitada $habilitar_factura)
    {
        $series = Serie::all();

        return view('factura.edit',['series' => $series,'factura' => $habilitar_factura]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SerieHabilitada  $serieHabilitada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SerieHabilitada $habilitar_factura)
    {
         $rules = [
               'serie' => 'required|numeric',
               'desde' => 'required|numeric',
               'hasta' => 'required|numeric',
            ];            

        $this->validate($request, $rules);

        $habilitar_factura->serie_id = $request->get('serie');
        $habilitar_factura->desde = $request->get('desde');
        $habilitar_factura->hasta = $request->get('hasta');
        $habilitar_factura->save();        

        Flash::success('Mensaje','Registro actualizado con éxito');

        return redirect('/habilitar-facturas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SerieHabilitada  $serieHabilitada
     * @return \Illuminate\Http\Response
     */
    public function destroy(SerieHabilitada $habilitar_factura)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Administrar\Producto;

use App\Marca;
use App\Producto;
use App\Categoria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use HepplerDotNet\FlashToastr\Flash;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrar.producto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();

        return view('administrar.producto.create',['categorias' => $categorias, 'marcas' => $marcas]);
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
                'categoria' => 'required|numeric|min:1',
                'marca' => 'required|numeric|min:1',
                'minimo' => 'required|numeric|min:1',
                'maximo' => 'required|numeric|min:1',
                'imagen' => 'required',
            ];            

        $this->validate($request, $rules);

        if ($request->file()) {
            $file = $request->file('imagen');
            $ruta = '/img/productos/';
            $name =  sha1(Carbon::now()).'.'.$file->guessExtension();
            $file->move(getcwd().$ruta, $name);
        }

        $producto = new Producto();
        $producto->nombre = $request->get('nombre');
        $producto->categoria_id = $request->get('categoria');
        $producto->marca_id = $request->get('marca');
        $producto->stock_minimo = $request->get('minimo');
        $producto->stock_maximo = $request->get('maximo');
        $producto->img_url = $ruta.$name;
        $producto->save();        

        Flash::success('Mensaje','Registro guardado con éxito');

        return redirect('/producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $ordenadores = array("producto.id","producto.nombre","marca.nombre","categoria.nombre");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $productos = DB::table('producto')
                ->join('categoria','producto.categoria_id','=','categoria.id')
                ->join('marca','producto.marca_id','=','marca.id') 
                ->select('producto.id','producto.nombre','producto.img_url','categoria.nombre as categoria','marca.nombre as marca') 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('producto')
                ->join('categoria','producto.categoria_id','=','categoria.id')
                ->join('marca','producto.marca_id','=','marca.id') 
                ->select('producto.id','producto.nombre','producto.img_url','categoria.nombre as categoria','marca.nombre as marca') 
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
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
         $categorias = Categoria::all();
        $marcas = Marca::all();

        return view('administrar.producto.edit',['categorias' => $categorias, 'marcas' => $marcas, 'producto' => $producto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $rules = [
               'nombre' => 'required|string|max:100',
                'categoria' => 'required|numeric|min:1',
                'marca' => 'required|numeric|min:1',
                'minimo' => 'required|numeric|min:1',
                'maximo' => 'required|numeric|min:1',
            ];            

        $this->validate($request, $rules);

        $producto->nombre = $request->get('nombre');
        $producto->categoria_id = $request->get('categoria');
        $producto->marca_id = $request->get('marca');
        $producto->stock_minimo = $request->get('minimo');
        $producto->stock_maximo = $request->get('maximo');

        if($request->hasFile('imagen')){            
            $file = $request->file('imagen');
            $ruta = '/img/productos/';
            $name = sha1(Carbon::now()).'.'.$file->guessExtension();
            $file->move(getcwd().$ruta, $name);
            if($producto->img_url){
                $rutaanterior = getcwd().$producto->img_url;
                    if(file_exists($rutaanterior)){
                        unlink(realpath($rutaanterior));
                        
                    }
            }
            $producto->img_url = $ruta.$name;
        }
        $producto->save();   

        Flash::success('Mensaje','Registro actualizado con éxito');

        return redirect('/producto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}

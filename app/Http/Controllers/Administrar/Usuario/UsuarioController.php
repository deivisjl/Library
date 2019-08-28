<?php

namespace App\Http\Controllers\Administrar\Usuario;

use App\Rol;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use HepplerDotNet\FlashToastr\Flash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrar.usuario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();

        return view('administrar.usuario.create',['roles' => $roles]);
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
               'nombres' => 'required|string|max:100',
               'apellidos' => 'required|string|max:100',
               'dpi' => 'required|string|max:100',
               'direccion' => 'required|string|max:100',
               'telefono' => 'required|numeric|min:1',
               'rol' => 'required|numeric|min:1',
               'email' => 'required|string|email|max:255|unique:users',
               'password' => 'required|string|min:5|confirmed',               
            ];            

        $this->validate($request, $rules);

        $usuario = new User();
        $usuario->nombres = $request->get('nombres');
        $usuario->apellidos = $request->get('apellidos');
        $usuario->dpi = $request->get('dpi');
        $usuario->direccion = $request->get('direccion');
        $usuario->telefono = $request->get('telefono');
        $usuario->email = $request->get('email');
        $usuario->password = bcrypt($request->get('password'));
        $usuario->rol_id = $request->get('rol');
        $usuario->save();      

        Flash::success('Mensaje','Registro guardado con éxito');  

        return redirect('/usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         $ordenadores = array("users.id","users.apellidos","users.nombres","users.sexo","users.direccion","users.email","rol.nombre");

        $columna = $request['order'][0]["column"];
        
        $criterio = $request['search']['value'];


        $users = DB::table('users') 
                ->join('rol','users.rol_id','=','rol.id')             
                ->select('users.id','users.nombres','users.apellidos','users.direccion','users.email','rol.nombre as rol') 
                // ->whereNull('users.deleted_at') 
                ->where($ordenadores[$columna], 'LIKE', '%' . $criterio . '%')
                ->orderBy($ordenadores[$columna], $request['order'][0]["dir"])
                ->skip($request['start'])
                ->take($request['length'])
                ->get();
              
        $count = DB::table('users')
                ->join('rol','users.rol_id','=','rol.id')
                // ->whereNull('users.deleted_at') 
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        $roles = Rol::all();

        return view('administrar.usuario.edit',['roles' => $roles,'usuario'=>$usuario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $rules = [
               'nombres' => 'required|string|max:100',
               'apellidos' => 'required|string|max:100',
               'dpi' => 'required|string|max:100',
               'direccion' => 'required|string|max:100',
               'telefono' => 'required|numeric|min:1',
               'rol' => 'required|numeric|min:1',
            ];            

        $this->validate($request, $rules);
        
        $usuario->nombres = $request->get('nombres');
        $usuario->apellidos = $request->get('apellidos');
        $usuario->dpi = $request->get('dpi');
        $usuario->direccion = $request->get('direccion');
        $usuario->telefono = $request->get('telefono');        
        $usuario->rol_id = $request->get('rol');
        $usuario->save();        

        Flash::success('Mensaje','Registro guardado con éxito');
        
        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        //
    }
}

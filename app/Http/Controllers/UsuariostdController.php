<?php

namespace App\Http\Controllers;

use App\Models\ProductoModel;
use App\Models\UsuariotdModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UsuariostdController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function registro()
    {
        return view('registrotd');
    }
    public function Home()
    {
        $productos = ProductoModel::all();
        return view('Home', ['productos' => $productos]);
    }
    public function perfil($id, $nombre)
    {
        $usuario = UsuariotdModel::where('id', $id)->first();
        return view('perfiltd',['usuario' => $usuario]);
    }
    public function registrar(Request $datos)
    {
        if (!$datos->nombre || !$datos->app || !$datos->apm || !$datos->correo || !$datos->password1 || !$datos->password2)
            return view('registrotd', ['estatus' => 'success', 'mensaje' => 'Los campos no deben de estar vacios']);

        $usuario = UsuariotdModel::where('correo', $datos->correo)->first();

        if ($usuario)
            return view('registrotd', ['estatus' => 'error', 'mensaje' => 'Ya existe esa cuenta']);

        $nombre = $datos->nombre;
        $app = $datos->app;
        $apm = $datos->apm;
        $correo = $datos->correo;
        $password1 = $datos->password1;
        $password2 = $datos->password2;

        if ($password1 != $password2)
            return view('registrotd', ['estatus' => 'error', 'mensaje' => 'Las contraseñas no coinciden']);

        $tipo_usuario = UsuariotdModel::all()->count();

        $usuario = new UsuariotdModel();
        $usuario->nombre = $nombre;
        $usuario->apellido_pat = $app;
        $usuario->apellido_mat = $apm;
        $usuario->correo = $correo;
        $usuario->password = bcrypt($password1);
        if ($tipo_usuario == 0) {
            $usuario->tipo_usuario = 1;
        }else{
            $usuario->tipo_usuario = 2;
        }
        $usuario->save();

        return view('login', ['estatus' => 'success', 'mensaje' => 'Usuario registrado']);
    }
    public function verificaciondelUsuario(Request $datos)
    {
        if (!$datos->correo || !$datos->password)
            return view('login', ['estatus' => 'success', 'mensaje' => 'Los campos no deben de estar vacios']);

        $usuario = UsuariotdModel::where('correo', $datos->correo)->first();

        if (!$usuario)
            return view('login', ['estatus' => 'error', 'mensaje' => 'No existe esa cuenta']);

        if (!Hash::check($datos->password, $usuario->password))
            return view('login', ['estatus' => 'error', 'mensaje' => '¡Datos incorrectos!']);

        Session::put('usuario', $usuario);

        if(isset($datos->url)){
            $url = decrypt($datos->url);
            return redirect($url);
        }else{
            return redirect()->route('home');
        }
    }
    public function actualizarlosUsuario(Request $datos)
    {
        if (!$datos->nombre || !$datos->app || !$datos->apm || !$datos->correo)
            return json_encode(['estatus' => 'error', 'mensaje' => 'Los campos no deben de ser vacios']);

        $usuario = UsuariotdModel::find($datos->id);
        $usuario->nombre = $datos->nombre;
        $usuario->apellido_pat = $datos->app;
        $usuario->apellido_mat = $datos->apm;
        $usuario->correo = $datos->correo;
        $usuario->save();

        return json_encode(['estatus' => 'success', 'mensaje' => 'Usuario actualizado']);
    }
    public function signout()
    {
        if(Session::has('usuario'))
            Session::forget('usuario');

        return redirect()->route('home');
    }
}

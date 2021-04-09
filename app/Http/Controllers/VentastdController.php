<?php

namespace App\Http\Controllers;

use App\Models\carritotdModel;
use App\Models\UsuariotdModel;
use Illuminate\Http\Request;

class VentastdController extends Controller
{
    public function pedidos()
    {
        $usuarios = UsuariotdModel::where('id', '<>', session('usuario')->id)->get();
        $ventas = carritotdModel::where('compra', 1)->get()->count();
        $productos = carritotdModel::where('compra', 1)->get();
        return view('todoslos-pedidos', ['usuarios' => $usuarios, 'ventas' => $ventas, 'productos' => $productos]);
    }
    public function realizarlasCompra($idusuario)
    {
        $carrito = carritotdModel::where('usuario_id', $idusuario)->where('compra', 0)->get();
        foreach ($carrito as $producto) {
            $producto->compra = 1;
            $producto->save();
        }
        return json_encode(['estatus' => 'success', 'mensaje' => 'Productos comprados']);
    }
    public function misPedidos()
    {
        $productos = carritotdModel::where('compra', 1)->where('usuario_id', session('usuario')->id)->get();
        $ventas = carritotdModel::where('compra', 1)->where('usuario_id', session('usuario')->id)->get()->count();
        return view('pedidotienda', ['ventas' => $ventas ,'productos' => $productos]);
    }
}

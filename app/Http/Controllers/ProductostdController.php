<?php

namespace App\Http\Controllers;

use App\Models\ProductoModel;
use Illuminate\Http\Request;

class ProductostdController extends Controller
{
    public function addProducto()
    {
        return view('agregar-producto');
    }
    public function productos()
    {
        $productos = ProductoModel::all();
        return view('productostd', ['productos' => $productos]);
    }
    public function agregarProductoN(Request $datos)
    {
        $datos->validate([
            'img1' => 'required|image',
            'img2' => 'required|image',
        ]);

        if (!$datos->nombre || !$datos->precio || !$datos->cantidad || !$datos->descripcion)
            return view('add-producto', ['estatus' => 'error', 'mensaje' => 'Ningun campo debe estar vacio']);

        $producto = new ProductoModel();
        $producto->nombre = $datos->nombre;
        $producto->precio = $datos->precio;
        $producto->foto1 = $datos->file('img1')->store('public');
        $producto->foto2 = $datos->file('img2')->store('public');
        $producto->descripcion = $datos->descripcion;
        $producto->cantidad = $datos->cantidad;
        $producto->administrador_id = session('usuario')->id;
        $producto->save();

        return view('agregar-producto', ['estatus' => 'success', 'mensaje' => 'Producto guardado']);
    }
    public function obtenerdatosobreProducto($id)
    {
        $producto = ProductoModel::where('id', $id)->first();
        return json_encode(['estatus' => 'success', 'producto' => $producto]);
    }
    public function updateProducto(Request $datos)
    {
        if (!$datos->nombre || !$datos->precio || !$datos->cantidad || !$datos->descripcion || !$datos->id)
            return json_encode(['estatus' => 'error', 'mensaje' => 'Los campos no pueden ser vacios']);

        $producto = ProductoModel::find($datos->id);
        $producto->nombre = $datos->nombre;
        $producto->precio = $datos->precio;
        $producto->cantidad = $datos->cantidad;
        $producto->descripcion = $datos->descripcion;
        $producto->save();

        return json_encode(['estatus' => 'success', 'mensaje' => 'Actualizado']);
    }
}

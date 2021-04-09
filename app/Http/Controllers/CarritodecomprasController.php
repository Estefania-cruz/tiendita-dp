<?php

namespace App\Http\Controllers;


use App\Models\carritotdModel;
use App\Models\ProductoModel;
use Illuminate\Http\Request;

class CarritodecomprasController extends Controller
{
    public function addCarrito($idproducto ,$cantidad)
    {
        $producto = ProductoModel::where('id', $idproducto)->first();

        if(!($producto->cantidad >= $cantidad))
            return json_encode(['estatus' => 'error', 'mensaje' => 'No hay tantos productos sorry']);

        $total_precio = $producto->precio * $cantidad;

        $carrito = new carritotdModel();
        $carrito->producto_id = $producto->id;
        $carrito->usuario_id = session('usuario')->id;
        $carrito->cantidad = $cantidad;
        $carrito->precio = $total_precio;
        $carrito->save();

        $producto->cantidad = $producto->cantidad - $cantidad;
        $producto->save();

        return json_encode(['estatus' => 'success', 'mensaje' => 'Añadido al carrito']);
    }
    public function mideCarrito()
    {
        $productos = carritotdModel::where('usuario_id', session('usuario')->id)->where('compra', 0)->get();
        return view('mi-carrito', ['productos' => $productos]);
    }
    public function miCarrito($id)
    {
        $productoCarrito = carritotdModel::find($id);

        $producto = ProductoModel::where('id', $productoCarrito->producto_id)->first();
        $producto->cantidad = $producto->cantidad + $productoCarrito->cantidad;
        $producto->save();

        $productoCarrito->delete();

        return json_encode(['estatus' => 'success', 'mensaje' => 'Pedido cancelado']);
    }
}

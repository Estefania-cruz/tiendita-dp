<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [\App\Http\Controllers\UsuariostdController::class, 'home'])->name('home');

Route::get('/log-in', [\App\Http\Controllers\UsuariostdController::class, 'login'])->name('login');
Route::post('/log-in', [\App\Http\Controllers\UsuariostdController::class, 'verificaciondelUsuario'])->name('verificaciondelUsuario');

Route::get('/registro', [\App\Http\Controllers\UsuariostdController::class, 'registro'])->name('registro');
Route::post('/registro', [\App\Http\Controllers\UsuariostdController::class, 'registrar'])->name('registrar');

Route::get('/salir', [\App\Http\Controllers\UsuariostdController::class, 'signout'])->name('sign-out');

Route::prefix('/usuario')->middleware('VerificarUsuario')->group(function (){
    Route::get('/perfil/{id}/{nombre}', [\App\Http\Controllers\UsuariostdController::class, 'perfil'])->name('perfil');
    Route::post('/update', [\App\Http\Controllers\UsuariostdController::class, 'actualizarlosUsuario'])->name('actualizarlosUsuario');

    Route::get('/addProducto', [\App\Http\Controllers\ProductostdController::class, 'addProducto'])->name('addProducto');
    Route::post('/addProducto', [\App\Http\Controllers\ProductostdController::class, 'agregarProductoN'])->name('agregarProductoN');
    Route::get('/productos', [\App\Http\Controllers\ProductostdController::class, 'productos'])->name('productos');
    Route::post('/obtenerDatosProducto/{idproducto?}', [\App\Http\Controllers\ProductostdController::class, 'obtenerdatosobreProducto'])->name('obtenerdatosobreProducto');
    Route::post('/updateProducto', [\App\Http\Controllers\ProductostdController::class, 'updateProducto'])->name('updateProducto');

    Route::post('/addCarrito/{idproducto?}/{cantidad?}', [\App\Http\Controllers\CarritodecomprasController::class, 'addCarrito'])->name('addCarrito');
    Route::post('/eliminarProductoCarrito/{id?}', [\App\Http\Controllers\CarritodecomprasController::class, 'deleteproductodemiCarrito'])->name('deleteproductodemiCarrito');

    Route::get('/total-pedidos', [\App\Http\Controllers\VentastdController::class, 'pedidos'])->name('pedidos');
    Route::get('/mis-pedidos', [\App\Http\Controllers\VentastdController::class, 'misPedidos'])->name('misPedidos');

    Route::get('/mi-carrito', [\App\Http\Controllers\CarritodecomprasController::class, 'miCarrito'])->name('miCarrito');
    Route::post('/hacer-compra/{idusuario?}', [\App\Http\Controllers\VentastdController::class, 'realizarlasCompra'])->name('realizarlasCompra');
});

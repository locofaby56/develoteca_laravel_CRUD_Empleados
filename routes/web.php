<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpleadosController;


/* 
Route::get('/empleados', function () {
    return view('empleados.index');
});
Route::get('/empleados/create', [EmpleadosController::class, 'create'])->name('empleados.create');
 */

Route::get('/', function () {
    return view('auth.login');
});
// Para acceder a todas las funciones o clases del controlador Empleados, 
// llamamos los todos los metodos por el siguiente comando 
Route::resource('empleados', EmpleadosController::class)->middleware('auth');

// ['register' => false, 'reset' => false] esta sentencia nos ayuda a quitar los 
// elementos que no necesitamos (por el momento)
Auth::routes(['register' => true, 'reset' => false]);

Route::get('/home', [EmpleadosController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [EmpleadosController::class, 'index'])->name('home');
});

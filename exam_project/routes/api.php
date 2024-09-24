<?php
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('productos', ProductoController::class);
Route::apiResource('clientes', ClienteController::class);

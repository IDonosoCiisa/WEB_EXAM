<?php

use App\Http\Controllers\LoginController;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    $totalUsers = User::count();
    $totalProducts = Producto::count();
    $totalClients = Cliente::count();

    return view('landing.index', [
        'totalUsers' => $totalUsers,
        'totalProducts' => $totalProducts,
        'totalClients' => $totalClients
    ]);
})->name('raiz');

Route::get('/login',
    [LoginController::class, 'formLogin']
)->name('formLogin');

Route::post('/login',
    [LoginController::class, 'validateLogin']
)->name('validateLogin');

Route::post('logout', [LoginController::class, 'logout']
)->name('logout');


Route::get('/register',
    [LoginController::class, 'newUser']
)->name('newUser');

Route::post('/register',
    [LoginController::class, 'register']
)->name('validateRegister');

Route::get('/backoffice/dashboard', function () {
    $user = Auth::user();
    $clientesCount = Cliente::count();
    $productosCount = Producto::count();
    $usuariosCount = User::count();
    if($user == null){
        return redirect()->route('formLogin')->withErrors([
            'email' => 'Usuario no autenticado'
        ]);
    }
    return view('backoffice.dashboard', ['user' => $user, 'clientesCount' => $clientesCount,
        'productosCount' => $productosCount, 'usuariosCount' => $usuariosCount]);
})->name('backoffice.dashboard');

Route::get('/backoffice/dashboard/users', function () {
    $user = Auth::user();
    if($user == null){
        return redirect()->route('formLogin')->withErrors([
            'email' => 'Usuario no autenticado'
        ]);
    }
    $Users = User::All();

    return view('backoffice.dashboard-user', ['user' => $user, 'totalUsers' => $Users]);
})->name('backoffice.dashboard.user');

Route::get('/backoffice/dashboard/products', function () {
    $user = Auth::user();
    if($user == null){
        return redirect()->route('formLogin')->withErrors([
            'email' => 'Usuario no autenticado'
        ]);
    }
    $products = Producto::All();

    return view('backoffice.dashboard-product', ['user' => $user, 'totalproducts' => $products]);
})->name('backoffice.dashboard.product');

Route::get('/backoffice/dashboard/clients', function () {
    $user = Auth::user();
    if($user == null){
        return redirect()->route('formLogin')->withErrors([
            'email' => 'Usuario no autenticado'
        ]);
    }
    $clients = Cliente::All();

    return view('backoffice.dashboard-client', ['user' => $user, 'totalclients' => $clients]);
})->name('backoffice.dashboard.client');

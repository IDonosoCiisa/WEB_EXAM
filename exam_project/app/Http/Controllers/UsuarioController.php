<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $usuario = User::create($request->all());
        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            return $usuario;
        }
        return response()->json(['message' => 'Usuario not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            $usuario->update($request->all());
            return $usuario;
        }
        return response()->json(['message' => 'Usuario not found'], 404);
    }

    public function destroy($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            $usuario->delete();
            return response()->json(null, 204);
        }
        return response()->json(['message' => 'Usuario not found'], 404);
    }
}

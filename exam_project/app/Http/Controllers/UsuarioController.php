<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::all();
    }

    public function store(Request $request)
    {
        $usuario = Usuario::create($request->all());
        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario) {
            return $usuario;
        }
        return response()->json(['message' => 'Usuario not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if ($usuario) {
            $usuario->update($request->all());
            return $usuario;
        }
        return response()->json(['message' => 'Usuario not found'], 404);
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario) {
            $usuario->delete();
            return response()->json(null, 204);
        }
        return response()->json(['message' => 'Usuario not found'], 404);
    }
}

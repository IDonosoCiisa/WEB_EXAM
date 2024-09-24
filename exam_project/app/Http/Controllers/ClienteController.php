<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return Cliente::all();
    }

    public function store(Request $request)
    {
        $cliente = Cliente::create($request->all());
        return response()->json($cliente, 201);
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente) {
            return $cliente;
        }
        return response()->json(['message' => 'Cliente not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->update($request->all());
            return $cliente;
        }
        return response()->json(['message' => 'Cliente not found'], 404);
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->delete();
            return response()->json(null, 204);
        }
        return response()->json(['message' => 'Cliente not found'], 404);
    }
}

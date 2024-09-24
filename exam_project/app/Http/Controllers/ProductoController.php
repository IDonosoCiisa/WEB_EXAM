<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        return Producto::all();
    }

    public function store(Request $request)
    {
        $producto = Producto::create($request->all());
        return response()->json($producto, 201);
    }

    public function show($id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            return $producto;
        }
        return response()->json(['message' => 'Producto not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $producto->update($request->all());
            return $producto;
        }
        return response()->json(['message' => 'Producto not found'], 404);
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $producto->delete();
            return response()->json(null, 204);
        }
        return response()->json(['message' => 'Producto not found'], 404);
    }
}

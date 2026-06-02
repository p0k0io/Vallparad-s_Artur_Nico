<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    /**
     * Mostrar todos los tipos de documento.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(DocumentType::all());
    }

    /**
     * Crear un tipo de documento.
     * @param \Illuminate\Http\Request $request Pasa la información necesaria para crear un tipo de documento
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $type = DocumentType::create($validated);

        return response()->json([
            'message' => 'Tipo de documento creado correctamente.',
            'data' => $type
        ], 201);
    }

    /**
     * Mostrar un tipo de documento.
     * @param int $id El ID del tipo de documento a mostrar
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $type = DocumentType::findOrFail($id);
        return response()->json($type);
    }

    /**
     * Actualizar un tipo de documento.
     */
    public function update(Request $request, $id)
    {
        $type = DocumentType::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $type->update($validated);

        return response()->json([
            'message' => 'Tipo de documento actualizado correctamente.',
            'data' => $type
        ]);
    }

    /**
     * Eliminar un tipo de documento.
     * @param int $id El ID del tipo de documento a eliminar
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $type = DocumentType::findOrFail($id);
        $type->delete();

        return response()->json([
            'message' => 'Tipo de documento eliminado correctamente.'
        ]);
    }
}

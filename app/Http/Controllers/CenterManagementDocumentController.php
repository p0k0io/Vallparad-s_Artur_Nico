<?php

namespace App\Http\Controllers;

use App\Models\CenterManagementDocument;
use App\Models\DocumentType;
use App\Models\Center;
use Illuminate\Http\Request;

class CenterManagementDocumentController extends Controller
{
    /**
     * Mostrar todos los documentos.
     */
public function index()
{
    $documents = CenterManagementDocument::with(['center', 'type'])->get();
    $types = DocumentType::all(); // Obtener todos los tipos de documentos
    $centers = Center::all();

    return view('documents.index', [
        'documents' => $documents,
        'types' => $types,
        'centers' => $centers
    ]);
}

    /**
     * Crear un nuevo documento.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'path' => 'required|string|max:255',
            'center_id' => 'required|exists:centers,id',
            'type_id' => 'required|exists:document_types,id',
        ]);

        $document = CenterManagementDocument::create($validated);

        return response()->json([
            'message' => 'Documento creado correctamente',
            'data' => $document
        ], 201);
    }

    /**
     * Mostrar un documento.
     */
    public function show($id)
    {
        $document = CenterManagementDocument::with(['center', 'type'])->findOrFail($id);

        return response()->json($document);
    }

    /**
     * Actualizar un documento.
     */
    public function update(Request $request, $id)
    {
        $document = CenterManagementDocument::findOrFail($id);

        $validated = $request->validate([
            'description' => 'sometimes|string|max:255',
            'path' => 'sometimes|string|max:255',
            'center_id' => 'sometimes|exists:centers,id',
            'type_id' => 'sometimes|exists:document_types,id',
        ]);

        $document->update($validated);

        return response()->json([
            'message' => 'Documento actualizado correctamente',
            'data' => $document
        ]);
    }

    /**
     * Eliminar un documento.
     */
    public function destroy($id)
    {
        $document = CenterManagementDocument::findOrFail($id);
        $document->delete();

        return response()->json([
            'message' => 'Documento eliminado correctamente'
        ]);
    }
}

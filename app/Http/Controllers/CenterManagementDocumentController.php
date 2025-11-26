<?php

namespace App\Http\Controllers;

use App\Models\CenterManagementDocument;
use App\Models\DocumentType;
use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
    // Validación
    $data = $request->validate([
        'description' => 'nullable|string|max:255',
        'archivo'     => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        'center_id'   => 'required|exists:centers,id',
        'type_id'     => 'required|exists:document_types,id', // CORREGIDO
    ]);

    // Guardar archivo
    $ruta = $request->file('archivo')->store('documents', 'public');

    // Crear documento (CORREGIDO)
    $document = CenterManagementDocument::create([
        'description' => $data['description'] ?? null,
        'path'        => $ruta,
        'center_id'   => $data['center_id'],
        'type_id'     => $data['type_id'],
    ]);

    return redirect()->back()->with('success', 'Documento subido correctamente.');
}

public function download($id)
{
    $document = CenterManagementDocument::findOrFail($id);

    // ruta en storage/app/public/documents/xxx
    $filePath = $document->path;

    if (!Storage::disk('public')->exists($filePath)) {
        abort(404, 'Archivo no encontrado.');
    }

    return Storage::disk('public')->download($filePath);
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

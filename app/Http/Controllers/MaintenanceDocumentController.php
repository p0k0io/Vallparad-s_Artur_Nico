<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MaintenanceDocument;

class MaintenanceDocumentController extends Controller
{
    /**
     * Descarga el documento especificado.
     * @param MaintenanceDocument $document
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(MaintenanceDocument $document)
    {
        return response()->download(Storage::disk('maintenance')->path($document->path));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ComplementaryServiceDocument;

class ComplementaryServiceDocumentController extends Controller
{
    /**
     * Descarga el documento especificado.
     * @param ComplementaryServiceDocument $document
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(ComplementaryServiceDocument $document)
    {
        return response()->download(Storage::disk('complementaryService')->path($document->path));
    }
}

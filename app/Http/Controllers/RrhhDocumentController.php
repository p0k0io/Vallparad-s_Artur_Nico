<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\RrhhDocument;

class RrhhDocumentController extends Controller
{
        /**
        * Descarga el documento especificado.
        * @param RrhhDocument $document
        * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
        */
    public function download(RrhhDocument $document)
    {
        return response()->download(Storage::disk('complementaryService')->path($document->path));
    }
}

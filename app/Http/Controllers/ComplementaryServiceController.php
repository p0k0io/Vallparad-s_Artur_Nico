<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\ComplementaryService;
use App\Models\ComplementaryServiceDocument;

class ComplementaryServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complementaryServices = ComplementaryService::all();

        return view('serveisComplementaris.complementaryServiceIndex', 
            [
                'complementaryServices' => $complementaryServices
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $complementaryService=ComplementaryService::create([
            'name'=>request('name'),
            'description'=>request('description'),
            'manager'=>request('manager'),
            'contact'=> request('contact'),
            'startDate'=>request('startDate'),
            'observations'=>request('observations'),
            'center_id'=>1,
        ]);

        $validated = $request->validate([
            'files.*' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $name_file = time().'-'. $file->getClientOriginalName();
                $storage_path = Storage::disk('complementaryService')->putFileAs('', $file, $name_file);
                ComplementaryServiceDocument::create([
                    'complementary_service_id' => $complementaryService->id,
                    'path' => $storage_path,  // Ruta del archivo
                ]);
            }
        }

        return redirect()->route('complementaryService.index');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $servei = ComplementaryService::findOrFail($id);

        return view('serveisGenerals.edit', compact('servei'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComplementaryService $complementaryService)
    {
        $complementaryService->update([
            'name'=>request('name'),
            'description'=>request('description'),
            'manager'=>request('manager'),
            'contact'=> request('contact'),
            'startDate'=>request('startDate'),
            'observations'=>request('observations'),
        ]);

        $request->validate([
            'files.*' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('files')) {

            foreach ($complementaryService->documents as $document) {
                Storage::disk('complementaryService')->delete($document->path);
                $document->delete();
            }

            foreach ($request->file('files') as $file) {
                $name_file = time() . '-' . $file->getClientOriginalName();
                $path = Storage::disk('complementaryService')
                    ->putFileAs('', $file, $name_file);

                $complementaryService->documents()->create([
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('complementaryService.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function complementaryServiceDelete(int $id)
    {
        $servei = ComplementaryService::findOrFail($id);
        $servei->delete();

        return redirect()->route('complementaryService.index')->with('success', 'Servei complementari eliminat correctament.');
    }


    public function searchComplementaryService(Request $request)
    {
        $search = $request->input('search');

        $complementaryServices=ComplementaryService::where('name', 'like', "%{$search}%")
            ->orWhere('manager', 'like', "%{$search}%")
            ->orWhere('contact', 'like', "%{$search}%")
            ->orWhere('startDate', 'like', "%{$search}%")
            ->get();

        return view(
            'serveisComplementaris.complementaryServiceIndex',
            [
                'complementaryServices' => $complementaryServices,
            ]
        );
    }

}

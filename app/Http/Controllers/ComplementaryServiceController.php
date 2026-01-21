<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ComplementaryService;

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
        ComplementaryService::create([
            'name'=>request('name'),
            'description'=>request('description'),
            'manager'=>request('manager'),
            'contact'=> request('contact'),
            'startDate'=>request('startDate'),
            'observations'=>request('observations'),
            'docs'=>request('docs'),
            'center_id'=>1,
        ]);

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
        $complementaryService->update($request->all());

        return redirect()->route('complementaryService.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servei = ComplementaryService::findOrFail($id);
        $servei->delete();

        return redirect()->route('complementaryService.index')->with('success', 'Servei complementari eliminat correctament.');
    }
}

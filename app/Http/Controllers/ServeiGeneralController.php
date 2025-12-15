<?php

namespace App\Http\Controllers;

use App\Models\ServeiGeneral;
use App\Models\Center;
use Illuminate\Http\Request;

class ServeiGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $serveis = ServeiGeneral::with('center')->get();
    $centers = Center::all();   // ⬅️ Añadido

    return view('serveisGenerals.index', compact('serveis', 'centers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centers = Center::all();
        return view('serveisGenerals.create', compact('centers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'center_id'     => 'required|exists:centers,id',
        'nom_servei'    => 'required|string',
        'personal_info' => 'required|string',
        'responsable' => 'required|string', // llega como JSON
    ]);

    ServeiGeneral::create([
        'center_id'     => $request->center_id,
        'nom_servei'    => $request->nom_servei,
        'personal_info' => $request->personal_info, // se guarda tal cual
        'responsable'   => $request->responsable,
    ]);

    return redirect()->route('serveisGenerals.index')
        ->with('success', 'Servei creat correctament!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $servei = ServeiGeneral::findOrFail($id);
        return view('serveisGenerals.show', compact('servei'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $servei = ServeiGeneral::findOrFail($id);
        $centers = Center::all();

        return view('serveisGenerals.edit', compact('servei', 'centers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServeiGeneral $serveisGeneral)
{
    $request->validate([
        'center_id'     => 'required',
        'nom_servei'    => 'required',
        'personal_info' => 'required',
        'responsable'   => 'required',
    ]);

    $serveisGeneral->update($request->all());

    return redirect()->route('serveisGenerals.index')
                     ->with('success','Actualitzat!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servei = ServeiGeneral::findOrFail($id);
        $servei->delete();

        return redirect()->route('serveisGenerals.index')
                         ->with('success', 'Servei general eliminat correctament.');
    }
}

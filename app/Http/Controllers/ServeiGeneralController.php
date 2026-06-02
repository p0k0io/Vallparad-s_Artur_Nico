<?php

namespace App\Http\Controllers;

use App\Models\ServeiGeneral;
use App\Models\Center;
use Illuminate\Http\Request;

class ServeiGeneralController extends Controller
{
    /**
     * Muestra una lista de servicios generales.
     */
    public function index()
    {
     $serveis = ServeiGeneral::with('center')->get();
    $centers = Center::all();

    return view('serveisGenerals.index', compact('serveis', 'centers'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        $centers = Center::all();
        return view('serveisGenerals.create', compact('centers'));
    }

    /**
     * Almacena un servicio general nuevo en la base de datos.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
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
     * Muestra el recurso especificado.
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        $servei = ServeiGeneral::findOrFail($id);
        return view('serveisGenerals.show', compact('servei'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     */
    public function edit(string $id)
    {
        $servei = ServeiGeneral::findOrFail($id);
        $centers = Center::all();

        return view('serveisGenerals.edit', compact('servei', 'centers'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param ServeiGeneral $serveisGeneral
     * @return \Illuminate\Http\RedirectResponse
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
     * Borra el recurso especificado de almacenamiento.
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $servei = ServeiGeneral::findOrFail($id);
        $servei->delete();

        return redirect()->route('serveisGenerals.index')
                         ->with('success', 'Servei general eliminat correctament.');
    }


    
}

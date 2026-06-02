<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExternalContact;
use App\Models\Center;



class ExternalContactController extends Controller
{
    /**
     * Muestra una lista de los contactos externos, con sus centros relacionados.
      * @return \Illuminate\View\View
      *
     */
    public function index()
    {
        $externalContacts =  ExternalContact::all();
        $centers = Center::all();
        return view('externalContacts.indexExternalContacts',[
            'externalContacts'=> $externalContacts,
            'centers' => $centers
        ]);
    }

    
    public function create()
    {
       
    }

    /**
     * Guarda un nuevo contacto externo en la base de datos.
     * @param \Illuminate\Http\Request $request Pasa la información necesaria para crear un contacto externo
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        //
        ExternalContact::create([
                'name'=>request('name'),
                'description'=> request('description'),
                'manager'=> request('manager'),
                'phone' => request('phone'),
                'address' => request('address'),
                'email' => request('email'),
                'type' => request('type'),
                'center_id' =>1
        ]);

        return redirect()
        ->route('externalContact.indexExternalContacts')
        ->with('success', 'Contacto creado');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

        /**
        * Busca contactos externos por nombre, manager o email.
        * @param \Illuminate\Http\Request $request Pasa la información necesaria para buscar contactos externos
        * @return \Illuminate\View\View
        */
    public function searchExternalContacts(Request $request)
    {
        $search = $request->input('search');

        $externalContacts=ExternalContact::where('name', 'like', "%{$search}%")
            ->orWhere('manager', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->get();

        $centers = Center::all();

        return view('externalContacts.indexExternalContacts',[
            'externalContacts'=> $externalContacts,
            'centers' => $centers
        ]);
    }
}

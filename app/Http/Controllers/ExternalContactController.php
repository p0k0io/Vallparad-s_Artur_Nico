<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExternalContact;
use App\Models\Center;



class ExternalContactController extends Controller
{
    /**
     * Display a listing of the resource.
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
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
}

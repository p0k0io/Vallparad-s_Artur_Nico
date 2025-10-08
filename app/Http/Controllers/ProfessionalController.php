<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professionals = Professional::all();
        
        return view('professional.indexProfessional', compact('professionals'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("professional.altaProfessional");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Professional::create([
            'name'=>request('name'),
            'surname1'=>request('surname1'),
            'surname2'=>request('surname2'),
            'email'=>request('email'),
            'address'=>request('address'),
            'phone'=>request('phone'),
            'locker'=>request('locker'),
            'profession'=>request('profession'),
            'linkStatus'=>request('linkStatus'),
            'keyCode'=>request('keyCode'),
            'locker_id'=>request('locker_id'),
            'key_id'=>request('key_id'),
            'center_id'=>request('center_id'),
            'rol_id'=>request('rol_id'),
            'cv_id'=>request('cv_id')
        ]);
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

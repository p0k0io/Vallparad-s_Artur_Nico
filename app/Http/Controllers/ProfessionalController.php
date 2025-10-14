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
        
        return view('professional.indexProfessional', 
                    [
                        'professionals' => $professionals
                    ]
        );
        
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
    public function edit(Professional $professional)
    {
        return view("professional.editProfessional",
        [
            "professional" => $professional
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Professional $professional)
    {
        $professional->update($request->all());

        return redirect()->route('professional.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
         
    }

    //Change Professional State Actiu-Desactivat
    public function changeState(Request $request, Professional $professional)
    {
        if ($professional-> status == 0){
            $professional-> status = 1;
        } 
        else{
            $professional-> status = 0;
        }
        $professional->update($request->all());

        return redirect()->route('professional.index');
    }
}

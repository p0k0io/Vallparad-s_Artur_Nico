<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centers = Center::all();
        return view('center.indexCenter', 
                    [
                        'centers' => $centers
                    ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("center.formularioAlta");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Center::create([
            'name'=>request('name'),
            'phone'=>request('phone'),
            'email'=>request('email'),
            'location'=>request('location')
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
    public function edit(Center $center)
    {
        return view("center.editCenter",
        [
            "center" => $center
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Center $center)
    {
        $center->update($request->all());

        return redirect()->route('center.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changeStateC(Request $request, Center $center)
    {
        if ($center-> status == 0){
            $center-> status = 1;
        } 
        else{
            $center-> status = 0;
        }
        $center->update($request->all());

        return redirect()->route('center.index');
    }
}

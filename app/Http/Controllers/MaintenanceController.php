<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;


class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $maintenances = Maintenance::all();

        return view('maintenance.indexMaintenance', 
            [
                'maintenances' => $maintenances
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
        Maintenance::create([
            'context'=>request('context'),
            'description'=>request('description'),
            'path'=>request('path'),
            'professional_id'=> 1,
            'status'=> 'pendent'

        ]);

        return redirect()->route('maintenance.index');
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



    ////////////////////////////////////////////////////////////////////////////////

    public function changeStateM(Request $request){
        $id=$request->input('id');
        $id=(int) $id;

        $maintenance=Maintenance::find($id);

        if($maintenance->status == 'Pendent'){
            $maintenance->status = 'Resolt';
        }
        else{
            $maintenance->status = 'Pendent';
        }

        
        $maintenance->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Estat actualitzat.',
            'data' => $maintenance->status
        ]);
    }
}

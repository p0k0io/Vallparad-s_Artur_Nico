<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\MaintenanceDocument;
use App\Models\MaintenanceTracking;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


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
                'maintenances' => $maintenances,
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
        
        $idUser = auth()->user();
        $idProf = $idUser->professional->id;

        $maintenance=Maintenance::create([
            'context'=>request('context'),
            'description'=>request('description'),
            'responsible'=>request('responsible'),
            'professional_id'=> $idProf,
            'status'=> 'pendent',
            'signature'=> request('signature')
        ]);

        $validated = $request->validate([
            'files.*' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $name_file = time().'-'. $file->getClientOriginalName();
                $storage_path = Storage::disk('maintenance')->putFileAs('', $file, $name_file);
                MaintenanceDocument::create([
                    'maintenance_id' => $maintenance->id,
                    'path' => $storage_path,  // Ruta del archivo
                ]);
            }
        }

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
    public function update(Request $request, Maintenance $maintenance)
    {
        $maintenance->update($request->all());

        return redirect()->route('maintenance.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    ////////////////////////////////////////////////////////////////////////////////

    public function createMaintenanceTracking(Request $request){
        MaintenanceTracking::create([
            'context'=>request('context'),
            'description'=>request('description'),
            'maintenance_id'=>request('maintenance_id')
        ]);
        return redirect()->route('maintenance.index');
    }

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

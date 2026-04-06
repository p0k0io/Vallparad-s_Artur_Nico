<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\MaintenanceDocument;
use App\Models\MaintenanceTracking;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/**
 * Controller of maintenance, the controller shows all the maintenances, shows the pages to create/edit and creates, deletes, change states, searches, create trackings and edits maintenances
 */
class MaintenanceController extends Controller
{
    
    /**
     * Display a listing of the resource.
     * 
     * @return .reutrns all maintenances
     */

    public function index()
    {
        $maintenances = Maintenance::all();

        return view(
            'maintenance.indexMaintenance',
            [
                'maintenances' => $maintenances,
            ]
        );

    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param .request $request Passes the necessary information to create a maintenance
     * 
     */
    public function store(Request $request)
    {

        $idUser = auth()->user();
        $idProf = $idUser->professional->id;

        $maintenance = Maintenance::create([
            'context' => request('context'),
            'description' => request('description'),
            'responsible' => request('responsible'),
            'professional_id' => $idProf,
            'status' => 'pendent',
            'signature' => request('signature')
        ]);

        $validated = $request->validate([
            'files.*' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $name_file = time() . '-' . $file->getClientOriginalName();
                $storage_path = Storage::disk('maintenance')->putFileAs('', $file, $name_file);
                MaintenanceDocument::create([
                    'maintenance_id' => $maintenance->id,
                    'path' => $storage_path,  // Ruta del archivo
                ]);
            }
        }

        return redirect()->route('maintenance.index');
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param .request $request Passes the id of the maintenance and the information in $maintenance to update the specific maintenance
     * 
     * @return .void
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $maintenance->update([
            'context' => request('context'),
            'description' => request('description'),
            'responsible' => request('responsible'),
        ]);

        $request->validate([
            'files.*' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('files')) {
            foreach ($maintenance->documents as $document) {
                Storage::disk('maintenance')->delete($document->path);
                $document->delete();
            }

            foreach ($request->file('files') as $file) {
                $name_file = time() . '-' . $file->getClientOriginalName();
                $storage_path = Storage::disk('maintenance')->putFileAs('', $file, $name_file);
                
                MaintenanceDocument::create([
                    'maintenance_id' => $maintenance->id,
                    'path' => $storage_path,  // Ruta del archivo
                ]);
            }
        }

        return redirect()->route('maintenance.index');
    }

    
    public function destroy(string $id)
    {
        //
    }

    /**
     * Delete a specific mainenance
     * 
     * @param .string $id Id of the maintenance that you want to delete
     * 
     * @return .void
     */

    public function maintenanceDelete(int $id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();

        return redirect()->route('maintenance.index');
    }

    /**
     * Create the tracking of a specific mainenance
     * 
     * @param .request $request The necessary information to create a card with info of the maintenance: id of maintenance, context, description
     * 
     * @return .void
     */
    public function createMaintenanceTracking(Request $request)
    {
        MaintenanceTracking::create([
            'context' => request('context'),
            'description' => request('description'),
            'maintenance_id' => request('maintenance_id')
        ]);
        return redirect()->route('maintenance.index');
    }

    /**
     * Change the state of a maintenance from active to resolved
     * 
     * @param .request $request Passes the id of the maintenance
     * 
     * @return .status to change in real time the status of the maintenance
     * 
     *          return response()->json([
     *              'success' => true,
     *              'message' => 'Estat actualitzat.',
     *              'data' => $maintenance->status
     *          ]);
     */

    public function changeStateM(Request $request)
    {
        $id = $request->input('id');
        $id = (int) $id;

        $maintenance = Maintenance::find($id);

        if ($maintenance->status == 'Pendent') {
            $maintenance->status = 'Resolt';
        } else {
            $maintenance->status = 'Pendent';
        }


        $maintenance->save();

        return response()->json([
            'success' => true,
            'message' => 'Estat actualitzat.',
            'data' => $maintenance->status
        ]);
    }

    /*
    public function searchMaintenances(Request $request)
    {
        $search = $request->input('search');

        $manintenances=Maintenance::where('context', 'like', "%{$search}%")->get();

        return response()->json([
            'trobat' => $manintenances->isNotEmpty(),
            'maintenances' => $manintenances,
        ]);
    }
    */

    /**
     * Searches the maintenances
     * 
     * @param .request $request Passes the text that you are searching
     * 
     * @return .return view(
     *              'maintenance.indexMaintenance',
     *              [
     *                  'maintenances' => $maintenances,
     *              ]
     *          );
     */

    public function searchMaintenances(Request $request)
    {
        $search = $request->input('search');

        $maintenances=Maintenance::where('context', 'like', "%{$search}%")
            ->orWhere('responsible', 'like', "%{$search}%")
            ->orWhere('status', 'like', "%{$search}%")
            ->get();

        return view(
            'maintenance.indexMaintenance',
            [
                'maintenances' => $maintenances,
            ]
        );
    }
    
}

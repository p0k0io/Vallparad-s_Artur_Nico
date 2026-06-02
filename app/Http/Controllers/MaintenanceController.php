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
     * Muestra una lista de los mantenimientos, con sus documentos y seguimientos relacionados.
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
    * Guarda un nuevo mantenimiento en la base de datos.
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
     * Actualiza un mantenimiento específico en la base de datos.
     * @param \Illuminate\Http\Request $request Pasa la información necesaria para actualizar un mantenimiento
     * @param Maintenance $maintenance El mantenimiento que se va a actualizar
     * @return \Illuminate\Http\RedirectResponse
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
     * Borra un mantenimiento de la base de datos.
     * 
     * @param .int $id Id del mantenimiento a borrar
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
     * Crea un seguimiento para un mantenimiento.
     * @param \Illuminate\Http\Request $request Pasa la información necesaria para crear un seguimiento de mantenimiento
     * @return \Illuminate\Http\RedirectResponse
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

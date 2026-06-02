<?php

namespace App\Http\Controllers;

use App\Models\ProjectComissionAssigned;
use App\Models\ProjectComission;
use Illuminate\Http\Request;
use App\Exports\ProjectComissionExport;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjectComissionAssignedController extends Controller
{
    /**
     * Muestra una lista de lso proyectos y comisiones asignados.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return ProjectComissionAssigned::with(['professional', 'project_comision'])->get();
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        //
    }

    /**
     * Almacena el recurso recién creado en el almacenamiento.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {       
        $data = $request->validate([
            'project_comision_id' => 'required|integer|exists:projects_comisions,id',
            'professional_id' => 'required|integer|exists:professional,id'
        ]);

        $projectId = $data['project_comision_id'];
        $professionalId = $data['professional_id'];

        $professionalAssignation= ProjectComissionAssigned::where('project_comision_id',$projectId)->where('professional_id',$professionalId);
        
        if($professionalAssignation->count() < 1){
            $success=true;
            $message="Professional assignat correctament";
            ProjectComissionAssigned::create($data);
        }
        else{
            $success=false;
            $message="Aquest professional ja estava assignat";
        }
        
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    /**
     * Muestra el recurso especificado.
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
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
    public function update(Request $request, $id)
    {
        /*
        $assignment = ProjectComissionAssigned::findOrFail($id);

        $data = $request->validate([
            'mode' => 'sometimes|string',
        ]);

        $assignment->update($data);

        return $assignment;
        */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
    }

    public function exportAssigned()
    {
        return Excel::download(new ProjectComissionExport, 'ProjectesIComisionsAsignats.csv');
    }

    /**
     * Borra la asignación de un profesional a un proyecto o comision.
     *
     * @param int $idPC ID del proyecto o comisión
     * @param int $idProf ID del profesional
     * @return void
     */
    public function removeAssignation($idPC, $idProf){
        $asignacio = ProjectComissionAssigned::where(['project_comision_id' => $idPC,'professional_id' => $idProf,])->firstOrFail();
        $asignacio->delete();

        return redirect()->route('projects_comisions.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ProjectComissionAssigned;
use Illuminate\Http\Request;
use App\Exports\ProjectComissionExport;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjectComissionAssignedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProjectComissionAssigned::with(['professional', 'project_comision'])->get();
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
     * Display the specified resource.
     */
    public function show($id)
    {
        return ProjectComissionAssigned::with(['professional', 'project_comision'])->findOrFail($id);
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
}

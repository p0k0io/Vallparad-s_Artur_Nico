<?php

namespace App\Http\Controllers;

use App\Models\ProjectComissionAssigned;
use Illuminate\Http\Request;

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
            'name' => request('name'),
            'description' => request('project_comission_id'),
            'observations' => request('professional_id'), 
        ]);
        $assignment = ProjectComissionAssigned::create($data);

        
        return response()->json([
            'success' => true,
            'message' => 'Profesional asignado correctamente',
            'data' => $assignment
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
        $assignment = ProjectComissionAssigned::findOrFail($id);

        $data = $request->validate([
            'mode' => 'sometimes|string',
        ]);

        $assignment->update($data);

        return $assignment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ProjectComissionAssigned::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}

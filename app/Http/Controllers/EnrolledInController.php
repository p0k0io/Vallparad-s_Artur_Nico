<?php

namespace App\Http\Controllers;

use App\Models\EnrolledIn;
use Illuminate\Http\Request;

class EnrolledInController extends Controller
{
    public function index()
    {
        return EnrolledIn::with(['professional', 'course'])->get();
    }

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'professional_id' => 'required|exists:professional,id', // tabla singular
            'course_id' => 'required|exists:courses,id',
            'mode' => 'required|string',
        ]);

        
        $enrollment = EnrolledIn::create($data);

        
        return response()->json([
            'success' => true,
            'message' => 'Profesional asignado correctamente',
            'data' => $enrollment
        ]);
    }

    public function show($id)
    {
        return EnrolledIn::with(['professional', 'course'])->findOrFail($id);
    }

   public function update(Request $request, $id)
{
    try {
        $enrolled_in =EnrolledIn::findOrFail($id);
        $data = $request->validate([
            'mode' => 'required|in:enrolled,completed,cancelled'
        ]);
        $enrolled_in->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente.',
            'data' => $enrolled_in
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage(),
        ], 500);
    }
}



    

}


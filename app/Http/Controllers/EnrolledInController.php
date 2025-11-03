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
        $enrollment = EnrolledIn::findOrFail($id);

        $data = $request->validate([
            'mode' => 'sometimes|string',
        ]);

        $enrollment->update($data);

        return $enrollment;
    }

    public function destroy($id)
    {
        EnrolledIn::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}


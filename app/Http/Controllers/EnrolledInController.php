<?php

namespace App\Http\Controllers;

use App\Models\EnrolledIn;
use Illuminate\Http\Request;
use App\Exports\CourseExport;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;


class EnrolledInController extends Controller
{
        /**
        * Muestra una lista de los profesionales inscritos en cursos, con su información relacionada.
        * @return \Illuminate\Http\JsonResponse
        */
    public function index()
    {
        return EnrolledIn::with(['professional', 'course'])->get();
    }

   
    /**
     * Muestra el formulario para crear un nuevo recurso.
     * @return \Illuminate\Http\Response
     * 
     */
   public function store(Request $request)
{
    $data = $request->validate([
        'professional_id' => 'required|exists:professional,id',
        'course_id' => 'required|exists:courses,id',
        'mode' => 'required|string',
    ]);

    // Si no existe, crearla
    $enrollment = EnrolledIn::create($data);

    return response()->json([
        'success' => true,
        'message' => 'Profesional asignado correctamente',
        'data' => $enrollment
    ]);

    return redirect()->route('course')->with('success', 'Uniforme creado correctamente');
}


    /**
     * Muestra el recurso especificado.
     * @param int $id El ID del recurso a mostrar
     * @return \Illuminate\Http\JsonResponse
     */

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

    
    /**
     * exporta los profesionales inscritos en cursos a un archivo CSV.
     * @return \Illuminate\Http\JsonResponse
     */
    public function export()
    {
        return Excel::download(new CourseExport, 'CourseExport.csv');
    } 

}


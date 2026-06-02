<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Professional;
use App\Models\Center;

use App\Models\Course;
class CourseController extends Controller
{
    /**
     * Muestra la lista de cursos.
     * @return \Illuminate\View\View
     */
   public function index()
    {
        $centers = Center::all();
        $professionals = Professional::all();
        $courses = Course::all(); 

        return view('course.indexCourse', [
            'centers' => $centers,
            'professionals' => $professionals,
            'courses' => $courses
        ]);
    }

 
    public function create()
    {
        
    }

    /**
     * Guarda un nuevo curso en la base de datos.
     * @param \Illuminate\Http\Request $request Pasa la información necesaria para crear un curso
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'mode'            => 'required|in:onsite,online',
            'event_type'      => 'nullable|in:workshop,seminar,congress',
            'attendee'        => 'nullable|integer',
            'startDate'       => 'nullable|date',
            'endDate'         => 'nullable|date|after_or_equal:startDate',
            'center_id'       => 'required|exists:centers,id',
            'professional_id' => 'required|exists:professional,id',
        ]);

        $validated['attendee'] = $validated['attendee'] ?? 0;

        $course = Course::create($validated);

       return redirect()->route('professional.index');
    
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

  
    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }


    /**
     * Busca cursos por nombre, modo o tipo de evento.
     * @param \Illuminate\Http\Request $request Pasa la información necesaria para buscar cursos
     * @return \Illuminate\View\View
     */
    public function searchCourses(Request $request)
    {
        $search = $request->input('search');

        $courses=Course::where('name', 'like', "%{$search}%")
            ->orWhere('mode', 'like', "%{$search}%")
            ->orWhere('event_type', 'like', "%{$search}%")
            ->get();;

        $centers = Center::all();
        $professionals = Professional::all();

        return view('course.indexCourse', [
            'centers' => $centers,
            'professionals' => $professionals,
            'courses' => $courses
        ]);
    }
}

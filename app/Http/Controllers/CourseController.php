<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Professional;
use App\Models\Center;

use App\Models\Course;
class CourseController extends Controller
{
   public function index()
    {
        $centers = Center::all();
        $professionals = Professional::all();
        $courses = Course::all(); // Traemos los cursos

        return view('course.indexCourse', [
            'centers' => $centers,
            'professionals' => $professionals,
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

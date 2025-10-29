<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Professional;
use App\Models\Center;

class CourseController extends Controller
{
    public function index()
    {
        $centers = Center::all();
        $professionals = Professional::all();

        return view('course.indexCourse',[
            'centers'=> $centers,
            'professionals' => $professionals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Cv::create([
            'path'=>request('path')
        ]);
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

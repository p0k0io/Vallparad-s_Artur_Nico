<?php

namespace App\Http\Controllers;

use App\Models\Center;

use Illuminate\Http\Request;
use App\Models\ProjectComision;
use App\Models\Professional;


class ProjectComisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professionals = Professional::all();
        $projectscomisions = ProjectComision::all();
        
        return view('projectscomisions.indexProjectComision', compact('projectscomisions', 'professionals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $professionals = Professional::all();
        $centers = Center::all();
        return view("projectscomisions.altaProjectComision", compact('professionals', 'centers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ProjectComision::create([
        'name' => request('name'),
        'description' => request('description'),
        'observations' => request('observations'), 
        'type' => request('type'),
        'responsible' => request('responsible'),
        'center_id' => request('center_id'),
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

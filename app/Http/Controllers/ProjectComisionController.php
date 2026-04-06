<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use App\Models\ProjectComision;
use App\Models\Professional;

/**
 * Controller of Projects and comissions, the controller shows all the maintenances, shows the pages to create/edit and creates, deletes, edits maintenances
 */
class ProjectComisionController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return .reutrns all projects and comisions, with the centers and professionals
     */
    public function index()
    {
        $centers = Center::all();
        $professionals = Professional::all();
        $projectscomisions = ProjectComision::all();
        
        return view('projectscomisions.indexProjectComision',
            [
                'centers' => $centers,
                'professionals' => $professionals,
                'projectscomisions'=> $projectscomisions
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param .request $request Passes the necessary information to create a maintenance
     * 
     * @return .returns the centers and professionals
     *          
     *           return view("projectscomisions.altaProjectComision",
     *              [
     *                  'professionals' => $professionals
     *              ],
     *              [
     *                  'centers'=> $centers
     *              ]
     *   );
     */
    public function create()
    {
        //
        $professionals = Professional::all();
        $centers = Center::all();
        return view("projectscomisions.altaProjectComision",
            [
                'professionals' => $professionals
            ],
            [
                'centers'=> $centers
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param .request $request Passes the necessary information to create a project/comission
     * 
     * @return .void
     * 
     */
    public function store(Request $request)
    {
        ProjectComision::create([
        'name' => request('name'),
        'description' => request('description'),
        'observations' => request('observations'), 
        'type' => request('type'),
        'startDate' => request('startDate'),
        'professional_id' => request('professional_id'),
        'center_id' => request('center_id'),
        ]);
        return redirect()->route('projects_comisions.index');
    }


    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param .request $request Passes the necessary information to edit a project/comission
     * 
     * @return .projects and comissions 
     * 
     *          return view("projectscomisions.editProjectComision", 
     *              [
     *                  "projects_comision" => $projects_comision
     *              ]
     *          );
     *
     * 
     */
    public function edit(ProjectComision $projects_comision)
    {
       return view("projectscomisions.editProjectComision", 
        [
            "projects_comision" => $projects_comision
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param .request $request Passes the necessary information to update a project/comission
     * 
     * @return .void
     * 
     */
    public function update(Request $request, ProjectComision $projects_comision)
    {
        $projects_comision->update($request->all());

        return redirect()->route('projects_comisions.index');
    }

    public function destroy(string $id)
    {
        //
    }


    /**
     * Delete the specified resource in storage.
     * 
     * @param .int $int id to delete the project/comission
     * 
     * @return .void
     * 
     */

    public function projectComisionDelete(int $id)
    {
        $projectComision = ProjectComision::findOrFail($id);
        $projectComision->delete();

        return redirect()->route('projects_comisions.index');
    }
}

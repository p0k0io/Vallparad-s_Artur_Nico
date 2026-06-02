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
     * devuelve una lista de los proyectos y comisiones, con los centros y profesionales relacionados.
     * @return \Illuminate\View\View
     * 
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
     * Mestra el formulario para crear un nuevo proyecto o comisión.
     * 
     * @param .request $request Passes the necessary information to create a maintenance
     * 
     * @return .returns the centers and professionals
     *          
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
     * Guarda un nuevo proyecto o comision en la base de datos.
     * 
     * @param .request $request Pasa la información necesaria para crear un proyecto o comisión
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
     * Muestra el formulario para editar un proyecto o comisión existente.
     * 
     * @param .request $request Passes the necessary information to edit a project or commission
     * 
     * @return .returns the project or commission to edit
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
     * Actualiza un proyecto o comisión existente en la base de datos.
     * 
     * @param .request $request Pasa la información necesaria para actualizar un proyecto o comisión
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
     * Borra un proyecto o comisión de la base de datos.
     * 
     * @param .int $int id del proyecto o comisión a borrar
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;

class CenterController extends Controller
{
    /**
     * Muestra una lista de todos los centros registrados en el sistema.
      * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers = Center::all();
        return view('center.indexCenter', 
                    [
                        'centers' => $centers
                    ]
        );
    }

    /**
     * Muestra el formulario para crear un nuevo centro.
      * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("center.formularioAlta");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Center::create([
            'name'=>request('name'),
            'phone'=>request('phone'),
            'email'=>request('email'),
            'location'=>request('location')
        ]);
        
    }

    /**
     * Muestra el formulario para visualizar un centro específico.
     * @param string $id El ID del centro a mostrar
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Muestra el formulario para editar un centro específico.
     * @param Center $center El centro a editar
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si el centro no se encuentra
     */
    public function edit(Center $center)
    {
        return view("center.editCenter",
        [
            "center" => $center
        ]
        );
    }

    /**
     * Actualiza un centro específico en la base de datos.
     * @param Request $request La solicitud HTTP
     * @param Center $center El centro a actualizar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Center $center)
    {
        $center->update($request->all());

        return redirect()->route('center.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id El ID del centro a eliminar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Cambia el estado de un centro específico.
     * @param Request $request La solicitud HTTP
     * @param Center $center El centro a actualizar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStateC(Request $request, Center $center)
    {
        if ($center-> status == 0){
            $center-> status = 1;
        } 
        else{
            $center-> status = 0;
        }
        $center->update($request->all());

        return redirect()->route('center.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Evaluation;

use Illuminate\Support\Facades\DB;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professionals = Professional::all();
        
        return view('professional.indexProfessional', 
                    [
                        'professionals' => $professionals
                    ]
        );
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("professional.altaProfessional");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Professional::create([
            'name'=>request('name'),
            'surname1'=>request('surname1'),
            'surname2'=>request('surname2'),
            'email'=>request('email'),
            'address'=>request('address'),
            'phone'=>request('phone'),
            'locker'=>request('locker'),
            'profession'=>request('profession'),
            'linkStatus'=>request('linkStatus'),
            'keyCode'=>request('keyCode'),
            'center_id'=>request('center_id'),
            'role'=>request('role'),
            'cv_id'=>request('cv_id')
        ]);

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
    public function edit(Professional $professional)
    {
        return view("professional.editProfessional",
        [
            "professional" => $professional
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Professional $professional)
    {
        $professional->update($request->all());

        return redirect()->route('professional.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
         
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Change Professional State Actiu-Desactivat
    public function changeStateP(Request $request, Professional $professional)
    {
        if ($professional-> status == 0){
            $professional-> status = 1;
        } 
        else{
            $professional-> status = 0;
        }
        $professional->update($request->all());

        return redirect()->route('professional.index');
    }

    //Valorar professionals

    public function assessView(Professional $professional)
    {
        return view("professional.assessProfessional",
        [
            "professional" => $professional
        ]
        );
    }
    public function assess(Request $request, Professional $professional)
    {
        Evaluation::create([
            'P1'=>request('P1'),
            'P2'=>request('P2'),
            'evaluated'=>$professional->id,
            'evaluator'=>$professional->id
        ]);
        return redirect()->route('professional.index');
    }

    public function getAssessment(Request $request){
        $id=$request->input('idP2');
        $id=(int) $id;
        $evaluations= Evaluation::where('evaluated',$id)->get();
        $P1=0;
        $P2=0;
        $medianCounter=0;
        $median=0;

        foreach($evaluations as $evaluation){
            $P1+=$evaluation->P1;
            $P2+=$evaluation->P2;
            $medianCounter+=2;
        }

        $median=($P1+$P2)/$medianCounter;

        return response()->json([
                'trobat' => true,
                'median' => $median
        ]);
    }



    //Funcio search amb javascript, no funca

    public function search(Request $request){
        $name = $request->input('search');

        // Aquí fariem la consulta a la BBDD
        $professionals = Professional::where('name',$name)->get();
        dd($professionals->toArray());
        /*
        $usuari = [
            'name' => $name
        ];
        */
        if ($professionals->count() > 0) {
            return response()->json([
                'trobat' => true,
                'professionals' => $professionals
        ]);
        } else {
            return response()->json([
                'trobat' => false,
                'professionals' => []
        ]);
    }
    }
}

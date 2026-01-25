<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accidentability;
use Barryvdh\DomPDF\Facade\Pdf;


class AccidentabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accidents = Accidentability::all();

        return view('accidentability.indexAccidentability', 
            [
                'accidents' => $accidents
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(request('type')=="Sense Baixa"){
            $status="Sense Baixa";
        }
        else{
            $status="En Baixa";
        }

        $idUser = auth()->user();
        $idProf = $idUser->professional->id;

        Accidentability::create([
            'type'=>request('type'),
            'context'=>request('context'),
            'description'=>request('description'),
            'duration'=>request('duration'),
            'startDate'=>request('startDate'),
            'endDate'=>request('endDate'),
            'signature'=>request('signature'),
            'status'=> $status,
            'professional_id'=> $idProf
        ]);

        return redirect()->route('accidentability.index');
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


    public function changeStateBaixa(Request $request){
        $id=$request->input('id');
        $id=(int) $id;

        $accident=Accidentability::find($id);

        if($accident->status == 'En Baixa'){
            $accident->status = 'Baixa Finalitzada';
        }
        elseif($accident->status == 'Baixa Finalitzada'){
            $accident->status = 'En Baixa';
        }
        else{
            $accident->status = 'Sense Baixa';
        }

        $accident->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Estat actualitzat.',
            'data' => $accident->status
        ]);
    }

    public function downloadAccident(Accidentability $accident)
    {
        if($accident->type=='Sense Baixa'){
            $dades = [
                'type' => $accident->type,
                'context' => $accident->context,
                'description' => $accident->description,
            ];
            $pdf = Pdf::loadView('accidentabilityFitxas.senseBaixa', $dades);
        }
        elseif($accident->type=='Amb Baixa'){
            $dades = [
                'type' => $accident->type,
                'context' => $accident->context,
                'description' => $accident->description,
                'duration' => $accident->duration,
            ];
            $pdf = Pdf::loadView('accidentabilityFitxas.ambBaixa', $dades);
        }
        else{
            $dades = [
                'type' => $accident->type,
                'context' => $accident->context,
                'description' => $accident->description,
                'startDate' => $accident->startDate,
                'endDate' => $accident->endDate,
            ];
            $pdf = Pdf::loadView('accidentabilityFitxas.baixaLlarga', $dades);
        }
        

        return $pdf->download('fitxaAccident.pdf');
    }




}

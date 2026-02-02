<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accidentability;
use App\Models\Professional;
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
                'accidents' => $accidents,
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
        $status = request('type');

        if($status === "Amb Baixa" || $status === "Baixa Llarga"){
            $status="En Baixa";
        }
        else{
            $status="Sense Baixa";
        }
        
        $idUser = auth()->user();
        $idProf = $idUser->professional->id;

        $affectedProfessionalId=request('professional_id');

        Accidentability::create([
            'type'=>request('type'),
            'context'=>request('context'),
            'description'=>request('description'),
            'duration'=>request('duration'),
            'startDate'=>request('startDate'),
            'endDate'=>request('endDate'),
            'signature'=>request('signature'),
            'status'=> $status,
            'professional_id'=> request('professional_id'),
            'whoWrites'=> $idProf
        ]);

        return redirect()->route(
            'accidentability.indexPerProfessional',
            ['professional' => $affectedProfessionalId] //Si que torna amb sols la id
        );
        
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
    public function update(Request $request, Accidentability $accident)
    {
        $type=$accident->type;

        $dades = [
            'context' => request('context'),
            'description' => request('description'),
        ];

        if($type==='Amb Baixa'){
            $dades['duration']=request('duration');
        }
        elseif($type==='Baixa Llarga'){
            $dades['startDate']=request('startDate');
            $dades['endDate']=request('endDate');
        }

        $accident->update($dades);

        $professional = Professional::findOrFail($request->input('professional_id'));
        
        return redirect()->route('accidentability.indexPerProfessional', [
            'professional' => $professional
        ]);

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

        if($accident->status === 'En Baixa'){
            $accident->status = 'Baixa Finalitzada';
        }
        elseif($accident->status === 'Baixa Finalitzada'){
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


    public function indexPerProfessional(Professional $professional)
    {
        if(Auth()->user()->role==="Equip Directiu" || Auth()->user()->role==="Administracio"){
            $accidents = Accidentability::where('professional_id', $professional->id)->get();
        }
        else{
            $accidents = Accidentability::where('professional_id', $professional->id)
                ->where('type',['Sense Baixa', 'Amb Baixa'])->get();
        }

        return view('accidentability.indexAccidentability', 
            [
                'accidents' => $accidents,
                'professional'=> $professional,
            ]
        );
    }


    public function accidentDelete(int $id, Professional $professional)
    {
        $accid = Accidentability::findOrFail($id);
        $accid->delete();

        return redirect()->route('accidentability.indexPerProfessional', [
            'professional' => $professional->id
        ]);
    }

    public function searchAccidents(Request $request, Professional $professional)
    {
        $search = $request->input('search');

        if(Auth()->user()->role==="Equip Directiu" || Auth()->user()->role==="Administracio"){
            $accidents = Accidentability::where('professional_id', $professional->id)->where('context', 'like', "%{$search}%")
            ->orWhere('type', 'like', "%{$search}%")
            ->orWhere('duration', 'like', "%{$search}%")
            ->orWhere('startDate', 'like', "%{$search}%")
            ->orWhere('endDate', 'like', "%{$search}%")
            ->get();
        }
        else{
            $accidents = Accidentability::where('professional_id', $professional->id)
            ->where('type','Sense Baixa')
            ->where('type','Amb Baixa')
            ->where('type','Sense Baixa')
            ->where('type','Amb Baixa')
            ->where('context', 'like', "%{$search}%")
            ->orWhere('type', 'like', "%{$search}%")
            ->orWhere('duration', 'like', "%{$search}%")
            ->orWhere('startDate', 'like', "%{$search}%")
            ->orWhere('endDate', 'like', "%{$search}%")
            ->get();
        }

        return view('accidentability.indexAccidentability', 
            [
                'accidents' => $accidents,
                'professional'=> $professional,
            ]
        );
    }

}

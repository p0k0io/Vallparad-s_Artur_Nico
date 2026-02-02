<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalTracking;
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
        $professionals = Professional::paginate(6);

        
        
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
            'cv_id'=>request('cv_id'),
            'user_id'=>request('user_id')
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

    //Seguiment professionals

    public function trackingViewProfessional(Professional $professional)
    {
        if(Auth()->user()->role==="Equip Directiu"){
            $trackings= ProfessionalTracking::where('tracked',$professional->id)->orderBy('id','desc')->get();
        }
        else{
            $trackings= ProfessionalTracking::where('tracked',$professional->id)
                ->where('type', ['obert','fi de la vinculacio'])
                ->orderBy('id','desc')->get();
        }

        return view("professional.trackingViewProfessional",
        [
            "professional" => $professional,
            "trackings" => $trackings
        ]
        );
    }


    public function trackingView(Professional $professional)
    {
        

        if(Auth()->user()->role==="Equip Directiu"){
            $trackings= ProfessionalTracking::where('tracked',$professional->id)->orderBy('id','desc');
        }
        else{
            $trackings= ProfessionalTracking::where('tracked',$professional->id)
                ->where('type', ['obert','fi de la vinculacio'])
                ->orderBy('id','desc');
        }

        return view("professional.trackingProfessional",
        [
            "professional" => $professional,
            "trackings"=> $trackings
        ]
        );
    }

    public function track(Professional $professional)
    {
        $idTracker = auth()->user();
        $idTracker = $idTracker->professional->id;

        ProfessionalTracking::create([
            'type'=>request('type'),
            'subject'=>request('subject'),
            'description'=>request('description'),
            'tracked'=>request('tracked'),
            'tracker'=> $idTracker,
        ]);
        return redirect()->route('trackingViewProfessional.professional', $professional);
    }

    public function getTracking(Request $request){
        
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

    public function assessViewProfessional(Professional $professional)
    {
        $evaluations= Evaluation::where('evaluated',$professional->id)->get();
        return view("professional.assessViewProfessional",
        [
            "professional" => $professional,
            "evaluations" => $evaluations
        ]
        );
    }

    public function assess(Request $request, Professional $professional)
    {
        Evaluation::create([
            'P1'=>request('P1'),
            'P2'=>request('P2'),
            'P3'=>request('P3'),
            'P4'=>request('P4'),
            'P5'=>request('P5'),
            'P6'=>request('P6'),
            'P7'=>request('P7'),
            'P8'=>request('P8'),
            'P9'=>request('P9'),
            'P10'=>request('P10'),
            'P11'=>request('P11'),
            'P12'=>request('P12'),
            'P13'=>request('P13'),
            'P14'=>request('P14'),
            'P15'=>request('P15'),
            'P16'=>request('P16'),
            'P17'=>request('P17'),
            'P18'=>request('P18'),
            'P19'=>request('P19'),
            'P20'=>request('P20'),
            'evaluated'=>$professional->id,
            'evaluator'=>$professional->id
        ]);
        return redirect()->route('assessViewProfessional.professional', $professional);
    }

    public function getAssessment(Request $request){
        $id=$request->input('idP2');
        $id=(int) $id;
        $evaluations= Evaluation::where('evaluated',$id)->get();
        if($evaluations->count()> 0){
            $P1=0;
            $P2=0;
            $P3=0;
            $P4=0;
            $P5=0;
            $P6=0;
            $P7=0;
            $P8=0;
            $P9=0;
            $P10=0;
            $P11=0;
            $P12=0;
            $P13=0;
            $P14=0;
            $P15=0;
            $P16=0;
            $P17=0;
            $P18=0;
            $P19=0;
            $P20=0;
            $medianCounter=0;
            $median=0;

            foreach($evaluations as $evaluation){
                $P1+=$evaluation->P1;
                $P2+=$evaluation->P2;
                $P3+=$evaluation->P3;
                $P4+=$evaluation->P4;
                $P5+=$evaluation->P5;
                $P6+=$evaluation->P6;
                $P7+=$evaluation->P7;
                $P8+=$evaluation->P8;
                $P9+=$evaluation->P9;
                $P10+=$evaluation->P10;
                $P11+=$evaluation->P11;
                $P12+=$evaluation->P12;
                $P13+=$evaluation->P13;
                $P14+=$evaluation->P14;
                $P15+=$evaluation->P15;
                $P16+=$evaluation->P16;
                $P17+=$evaluation->P17;
                $P18+=$evaluation->P18;
                $P19+=$evaluation->P19;
                $P20+=$evaluation->P20;
                $medianCounter+=20;
            }

            $median=($P1+$P2+$P3+$P4+$P5+$P6+$P7+$P8+$P9+$P10+$P11+$P12+$P13+$P14+$P15+$P16+$P17+$P18+$P19+$P20)/$medianCounter;

            $median=round($median, 2);

            return response()->json([
                    'trobat' => true,
                    'median' => $median
            ]);
        }
        else{
            return response()->json([
                    'trobat' => false
            ]);
        }
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accidentability;
use App\Models\Professional;
use Barryvdh\DomPDF\Facade\Pdf;


class AccidentabilityController extends Controller
{
    /**
     * Muestra una lista de todos los accidentes registrados.
     * @return \Illuminate\Http\Response
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

   
    public function create()
    {
        //
    }

    /**
     * Guarda un nuevo accidente en la base de datos.
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos del accidente
     * @return \Illuminate\Http\RedirectResponse Redirige a la página de índice de accidentes para el profesional afectado
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

   
    public function show(string $id)
    {
        //
    }

 
    public function edit(string $id)
    {
        //
    }

    /**
     * Actualiza un accidente específico en la base de datos.
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos actualizados
     * @param Accidentability $accident El accidente que se va a actualizar
     * @return \Illuminate\Http\RedirectResponse Redirige a la página de índice de accidentes para el profesional afectado
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


    public function destroy(string $id)
    {
        //
    }

    /**
     * Cambia el estado de un accidente específico entre "En Baixa", "Baixa Finalitzada" y "Sense Baixa
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene el ID del accidente a actualizar
      * @return \Illuminate\Http\JsonResponse Respuesta JSON que indica el éxito de la operación y el nuevo estado del accidente
     */
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

    /**
     * Descarga un PDF con los detalles de un accidente específico.
     * @param Accidentability $accident El accidente del que se generará el PDF
     * @return \Illuminate\Http\Response El archivo PDF generado para su descarga
     */
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

    /**
     * Muestra una lista de accidentes para un profesional específico.
     * @param Professional $professional El profesional del que se mostrarán los accidentes
     * @return \Illuminate\Http\Response La vista con la lista de accidentes para el profesional especificado
     */
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

    /**
     * Elimina un accidente específico de la base de datos.
     * @param int $id El ID del accidente a eliminar
     * @param Professional $professional El profesional al que pertenece el accidente a eliminar
     * @return \Illuminate\Http\RedirectResponse Redirige a la página de índice de accidentes para el profesional afectado
     */    
    public function accidentDelete(int $id, Professional $professional)
    {
        $accid = Accidentability::findOrFail($id);
        $accid->delete();

        return redirect()->route('accidentability.indexPerProfessional', [
            'professional' => $professional->id
        ]);
    }

    /**
     * Busca accidentes para un profesional específico según un término de búsqueda.
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene el término de búsqueda
     * @param Professional $professional El profesional del que se mostrarán los accidentes encontrados
     * @return \Illuminate\Http\Response La vista con la lista de accidentes encontrados para el profesional especificado
     */
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

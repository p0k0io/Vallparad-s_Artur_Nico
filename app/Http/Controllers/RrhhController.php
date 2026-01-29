<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RRHH;
use App\Models\Professional;
use App\Models\RrhhTracking;
use App\Models\RrhhDocument;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class RrhhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rrhhs = RRHH::all();
        $professionals = Professional::all();

        return view('rrhh.indexRrhh', 
            [
                'rrhhs' => $rrhhs,
                'professionals' =>$professionals
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
        $idUser = auth()->user();
        $idProf = $idUser->professional->id;

        

        $rrhh=RRHH::create([
            'context'=>request('context'),
            'description'=>request('description'),
            'status'=> 'pendent',
            'signature'=>request('signature'),
            'professional_id'=> $idProf,
            'professional_afectat'=>request('professional_afectat'),
            'professional_derivat'=>request('professional_derivat'),
        ]);

        $validated = $request->validate([
            'files.*' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $name_file = time().'-'. $file->getClientOriginalName();
                $storage_path = Storage::disk('pending_hr')->putFileAs('', $file, $name_file);
                RrhhDocument::create([
                    'rrhh_id' => $rrhh->id,
                    'path' => $storage_path,  // Ruta del archivo
                ]);
            }
        }

        return redirect()->route('rrhh.index');
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

    ////////////////////////////////////////////////////////////////////////////////

    public function createRrhhTracking(Request $request){
        RrhhTracking::create([
            'context'=>request('context'),
            'description'=>request('description'),
            'rrhh_id'=>request('rrhh_id')
        ]);
        return redirect()->route('rrhh.index');
    }

    public function changeStateRrhh(Request $request){
        $id=$request->input('id');
        $id=(int) $id;

        $rrhh=RRHH::find($id);

        if($rrhh->status == 'Pendent'){
            $rrhh->status = 'Resolt';
        }
        else{
            $rrhh->status = 'Pendent';
        }

        
        $rrhh->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Estat actualitzat.',
            'data' => $rrhh->status
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\TestExport;

use App\Models\Uniforms;
use Illuminate\Http\Request;
use App\Models\Professional;


use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;


use App\Exports\UniformsExport;
class UniformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
        {
            $uniforms = Uniforms::where('status', 0)->get();


            $professionals = Professional::all();

            return view('uniform.indexUnifoms', [
                'uniforms' => $uniforms,
                'professionals' => $professionals
            ]);
        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $professionals = Professional::all();
        $uniforms = Uniforms::all(); 
        return view('uniform.nouUniforme', compact('professionals', 'uniforms'));

    }

        public function changeState(Request $request, Uniforms $uniform)
    {

        $uniform->status = 1;
        $uniform->save();

        return redirect()->back()->with('success', 'Uniforme entregado');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([
            'shirtSize' => 'required|string|max:4',
            'pantsSize' => 'required|string|max:4',
            'shoeSize'  => 'required|integer',
            'shirtAm' => 'required |integer',
            'pantAm' => 'required| integer',
            'shoeAm' => 'required|integer',
            'professional_id' => 'required|exists:professional,id',
            'lastUniform' => 'nullable|exists:uniforms,id',
        ]);

        Uniforms::create([
            'shirtSize' => $request->shirtSize,
            'pantsSize' => $request->pantsSize,
            'shoeSize' => $request->shoeSize,
            'shirtAm'=>$request->shirtAm,
            'pantAm'=>$request->pantAm,
            'shoeAm'=>$request->shoeAm,
            'status'=> '0',
            'professional_id' => $request->professional_id,
            'lastUniform' => $request->lastUniform,
        ]);

        return redirect()->route('uniforms.index')->with('success', 'Uniforme creado correctamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(Uniforms $uniforms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Uniforms $uniforms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Uniforms $uniforms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uniforms $uniforms)
    {
        //
    }

    public function export()
    {
        return Excel::download(new UniformsExport, 'uniforms.xlsx');
    }

  public function exportTest()
{
    $data = [
        ['ID', 'Name', 'Email'],
        [1, 'John Doe', 'john@example.com'],
        [2, 'Jane Smith', 'jane@example.com'],
    ];

    return Excel::download(new TestExport($data), 'test.xlsx');
}


}

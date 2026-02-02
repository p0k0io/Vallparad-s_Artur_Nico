<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\ProjectComissionAssigned;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\ProfessionalTracking;
use App\Models\Evaluation;
use App\Models\EnrolledIn;

class ProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $trackings= ProfessionalTracking::where('tracked',$user->professional->id)->get();
        $evaluations= Evaluation::where('evaluated',$user->professional->id)->get();

        $numTrackings= ProfessionalTracking::where('tracked',$user->professional->id)->get();
        $numTrackings= $numTrackings->count();

        $numAvaluacions= Evaluation::where('evaluated',$user->professional->id)->get();
        $numAvaluacions=$numAvaluacions->count();

        $numProjectes= ProjectComissionAssigned::where('professional_id', $user->professional->id)->get();
        $numProjectes=$numProjectes->count();
        
        $numCourses= EnrolledIn::where('professional_id', $user->professional->id)->get();
        $numCourses=$numCourses->count();

        $evaluations= Evaluation::where('evaluated',$user->professional->id)->get();
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
        }
        else{
            $median="No tens avaluacions";
        }
        
        return view('profile.profileView',
        [
                "user" => $user,
                "trackings" => $trackings,
                "evaluations" => $evaluations,
                "numTrackings"=> $numTrackings,
                "numAvaluacions"=> $numAvaluacions,
                "median"=> $median,
                "numProjectes" => $numProjectes,
                "numCourses"=> $numCourses
            ]
        );
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

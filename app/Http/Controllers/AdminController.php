<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Professional;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{

    public function index()
    {
        return view('admin.index', [
            'users' => User::latest()->get(),
        ]);
    }

  public function store(Request $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {

            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'lowercase',
                    'email',
                    'max:255',
                    'unique:users,email',
                ],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $request->role,
                'password' => Hash::make($validated['password']),
            ]);

            Professional::create([
                'name' => $request->name,
                'surname1' => $request->surname1,
                'surname2' => $request->surname2,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'locker' => $request->locker,
                'profession' => $request->profession,
                'linkStatus' => 'test',
                'keyCode' => $request->keyCode,
                'center_id' => 1,
                'role' => $request->role,
                'cv_id' => 1,
                'user_id' => $user->id,
            ]);

            event(new Registered($user));
        });

        return redirect()
            ->route('admin.index')
            ->with('success', 'Usuario y profesional registrados correctamente');
    }


    public function destroy(User $user): RedirectResponse
    {
        
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('admin.index')
                ->with('success', 'No puedes eliminar tu propio usuario');
        }

        $user->delete();

        return redirect()
            ->route('admin.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        return redirect()
            ->route('admin.index')
            ->with('success', 'Usuario registrado correctamente');
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
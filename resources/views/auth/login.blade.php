@vite('resources/css/app.css')

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<div class="relative min-h-screen flex items-center justify-center bg-slate-100 overflow-hidden">

    <!-- Imagen de fondo en la parte baja -->
    <img 
        src="{{ asset('images/asset_login_superpossed.png') }}" 
        alt="Decorative background"
        class="absolute bottom-0 left-0 w-full h- object-cover pointer-events-none select-none"
    />

    <!-- Contenedor del formulario -->
    <div class="relative z-10 bg-white px-6 md:px-10 py-10 rounded-2xl shadow-xl w-11/12 sm:w-3/4 md:w-2/5 lg:w-1/3">
        
        <!-- Logo -->
        <div class="flex justify-center mb-8">
            <x-application-logo class="h-12 w-auto" />
        </div>

        <!-- Formulario -->
        <form method="POST" action="{{ route('login') }}" class="flex flex-col space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input 
                    id="email" 
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required autofocus autocomplete="username" 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input 
                    id="password" 
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500" 
                    type="password" 
                    name="password" 
                    required autocomplete="current-password" 
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    name="remember" 
                    class="h-4 w-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500"
                >
                <label for="remember_me" class="ml-2 text-sm text-gray-700">
                    {{ __('Remember me') }}
                </label>
            </div>

            <!-- Botón y enlace -->
            <div class="flex flex-col items-center mt-6 space-y-3">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 hover:text-orange-600 transition" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button 
                    type="submit" 
                    class="w-4/5 bg-orange-500 hover:bg-orange-600 transition rounded-full px-8 py-3 text-white font-bold shadow-md"
                >
                    {{ __('Iniciar sesión') }}
                </button>
            </div>
        </form>
    </div>
</div>

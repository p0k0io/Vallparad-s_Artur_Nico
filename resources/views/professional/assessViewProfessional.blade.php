@extends('../layouts.app')

@section('title','Valoració Professionals')

@section('content')

<div class="min-h-screen bg-slate-100 flex flex-col items-center py-16 relative">

    <img 
        src="{{ asset('images/asset_login_superpossed.png') }}" 
        alt="Decorative background"
        class="absolute bottom-0 left-0 w-full h-auto object-cover pointer-events-none select-none opacity-80 z-0"
    />

    <div class="relative z-10 w-full max-w-6xl space-y-8">

        <h2 class="text-4xl font-extrabold text-orange-500 text-center tracking-tight">
            Avaluacions de {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($evaluations as $evaluation)
                <div class="bg-white rounded-3xl shadow-lg p-6 space-y-4 hover:shadow-xl transition-all">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-semibold text-gray-700">Avaluador: {{ $evaluation->evaluator }}</h3>
                        <span class="text-sm font-medium text-gray-500">{{ $evaluation->created_at->format('d/m/Y') }}</span>
                    </div>

                    <div class="space-y-2">
                        @for ($i = 1; $i <= 20; $i++)
                            @php
                                $value = $evaluation->{'P'.$i};
                                $bg = match($value) {
                                    0 => 'bg-red-400',
                                    1 => 'bg-yellow-400',
                                    2 => 'bg-green-300',
                                    3 => 'bg-green-500',
                                    default => 'bg-gray-200',
                                };
                                $width = ($value + 1) * 20; // barra proporcional
                            @endphp
                            <div class="flex items-center gap-3">
                                <span class="w-10 text-sm text-gray-700 font-medium">P{{ $i }}</span>
                                <div class="w-full h-4 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="{{ $bg }} h-4 rounded-full transition-all duration-300" style="width: {{ $width }}%;"></div>
                                </div>
                                <span class="w-6 text-sm text-gray-700 font-semibold text-right">{{ $value }}</span>
                            </div>
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex flex-wrap justify-center gap-4 mt-6">
            <a href="{{ route('professional.index')}}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-2xl shadow-md hover:shadow-lg transition-all">
                Tornar
            </a>
            <a href="{{ route('assessView.professional', $professional)}}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-2xl shadow-md hover:shadow-lg transition-all">
                Nova Avaluacio
            </a>
            <a href="{{ route('trackingViewProfessional.professional', $professional)}}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-2xl shadow-md hover:shadow-lg transition-all">
                Veure Seguiments
            </a>
            <x-assess-questions-modal class="mx-2"/>
        </div>
    </div>
</div>

@endsection

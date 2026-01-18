@extends('../layouts.app')

@section('title','Valoració Professionals')

@section('content')
<div class="relative bg-slate-100 flex justify-center items-start py-16 min-h-screen">

    <img 
        src="{{ asset('images/asset_login_superpossed.png') }}" 
        alt="Decorative background"
        class="absolute bottom-0 left-0 w-full h-auto object-cover pointer-events-none select-none opacity-80 z-0"
    />

    <form action="{{ route('assess.professional',$professional) }}" method="post" class="relative bg-white rounded-3xl shadow-2xl p-12 w-full max-w-5xl z-10 space-y-8">
        @csrf
        @method('PUT')

        <h1 class="text-4xl md:text-5xl font-extrabold text-orange-500 text-center mb-10 tracking-tight">
            Estàs avaluant a {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
        </h1>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-orange-100 text-orange-700 font-semibold">
                        <th class="py-3 px-4 rounded-tl-xl">Aspecte a valorar</th>
                        <th class="py-3 px-4 text-center">Gens d'acord</th>
                        <th class="py-3 px-4 text-center">Poc d'acord</th>
                        <th class="py-3 px-4 text-center">Bastant d'acord</th>
                        <th class="py-3 px-4 text-center rounded-tr-xl">Molt d'acord</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach([
                        'Realitza una correcta atenció a l\'usuari',
                        'Es preocupa per satisfer les seves necessitats dins dels recursos dels que disposa',
                        'S\'ha integrat dins l\'equip de treball i participa i coopera sense dificultats',
                        'Pot treballar amb altres equips diferents al seu si es necessita',
                        'Compleix amb les funcions establertes',
                        'Assoleix els objectius utilitzant els recursos disponibles per aconseguir els resultats esperats',
                        'És coherent amb el que diu i amb les seves actuacions',
                        'Les seves actuacions van alineades amb els valors de la nostra Entitat',
                        'Mostra capacitat i interès en entendre i aplicar la normativa i els procediments establerts',
                        'La seva actitud envers els seus responsables/comandaments és correcta',
                        'Té capacitat per a comprendre i acceptar i adequar-se als canvis',
                        'Desenvolupa amb autonomia les seves funcions, sense necessitat de recolzament immediat/constant',
                        'Fa suggeriments i propostes de millora',
                        'Assoleix els objectius, esforçant-se per aconseguir el resultat esperat',
                        'La quantitat de treball que desenvolupa en relació amb el treball encomanat és adequada',
                        'Realitza les tasques amb la qualitat esperada i/o necessària',
                        'Expressa amb claredat i ordre els aspectes rellevants de la informació',
                        'Disposa del coneixements necessaris per a desenvolupar les tasques requerides del lloc de treball',
                        'Mostra interès i motivació envers el seu lloc de treball',
                        'La seva entrada i permanència en el lloc de treball es duu a terme sense retards o absències no justificades'
                    ] as $i => $question)
                    <tr class="hover:bg-orange-50 transition">
                        <td class="py-4 px-4 text-gray-700">{{ $question }}</td>
                        @for($v=0;$v<=3;$v++)
                        <td class="py-4 px-4 text-center">
                            <input type="radio" name="P{{ $i+1 }}" value="{{ $v }}" required class="accent-orange-500 w-5 h-5">
                        </td>
                        @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-center mt-8">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-10 py-3 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                Enviar Avaluació
            </button>
        </div>
    </form>
</div>
@endsection

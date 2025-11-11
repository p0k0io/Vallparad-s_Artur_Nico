@extends('../layouts.app')

@section('title','Valoracio Professionals')

@section('content')
    <div class="relative bg-gray-100 flex justify-center items-center py-10">
        <img 
            src="{{ asset('images/asset_login_superpossed.png') }}" 
            alt="Decorative background"
            class="absolute bottom-0 left-0 w-full h-auto object-cover pointer-events-none select-none z-0"
        />
        <form action="{{ route('assess.professional',$professional) }}" method="post" class="relative bg-white rounded-2xl shadow-lg p-8 w-3/4 z-10">
            @csrf
            @method('PUT')
            <table class="w-full text-left border-collapse">
                <h1 class="text-5xl mb-8 font-semibold text-orange-400">
                    Estàs avaluant a {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
                </h1>
                <tr>
                    <th></th>
                    <th class="text-center">Gens d'acord</th>
                    <th class="text-center">Poc d'acord</th>
                    <th class="text-center">Bastant d'acord</th>
                    <th class="text-center">Molt d'acord</th>
                </tr>
                <tr>
                    <td>Realitza una correcta atenció a l'usuari</td>
                    <td class="text-center"><input type="radio" name="P1" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P1" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P1" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P1" value="3" required></td>
                </tr>
                <tr>
                    <td>Es preocupa per satisfer les seves necessitats dins dels recursos dels que disposa</td>
                    <td class="text-center"><input type="radio" name="P2" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P2" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P2" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P2" value="3" required></td>
                </tr>
                <tr>
                    <td>S'ha integrat dins l'equip de treball i participa i coopera sense dificultats</td>
                    <td class="text-center"><input type="radio" name="P3" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P3" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P3" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P3" value="3" required></td>
                </tr>
                <tr>
                    <td>Pot treballar amb altres equips diferents al seu si es necessita</td>
                    <td class="text-center"><input type="radio" name="P4" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P4" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P4" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P4" value="3" required></td>
                </tr>
                <tr>
                    <td>Compleix amb les funcions establertes</td>
                    <td class="text-center"><input type="radio" name="P5" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P5" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P5" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P5" value="3" required></td>
                </tr>
                <tr>
                    <td>Assoleix els objectius utilitzant els recursos disponibles per aconseguir els resultats esperats</td>
                    <td class="text-center"><input type="radio" name="P6" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P6" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P6" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P6" value="3" required></td>
                </tr>
                <tr>
                    <td>És coherent amb el que diu i amb les seves actuacions</td>
                    <td class="text-center"><input type="radio" name="P7" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P7" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P7" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P7" value="3" required></td>
                </tr>
                <tr>
                    <td>Les seves actuacions van alineades amb els valors de la nostra Entitat</td>
                    <td class="text-center"><input type="radio" name="P8" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P8" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P8" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P8" value="3" required></td>
                </tr>
                <tr>
                    <td>Mostra capacitat i interès en entendre i aplicar la normativa i els procediments establerts</td>
                    <td class="text-center"><input type="radio" name="P9" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P9" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P9" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P9" value="3" required></td>
                </tr>
                <tr>
                    <td>La seva actitud envers els seus responsables/comandaments és correcta</td>
                    <td class="text-center"><input type="radio" name="P10" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P10" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P10" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P10" value="3" required></td>
                </tr>
                <tr>
                    <td>Té capacitat per a comprendre i acceptar i adequar-se als canvis</td>
                    <td class="text-center"><input type="radio" name="P11" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P11" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P11" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P11" value="3" required></td>
                </tr>
                <tr>
                    <td>Desenvolupa amb autonomia les seves funcions, sense necessitat de recolzament immediat/constant</td>
                    <td class="text-center"><input type="radio" name="P12" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P12" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P12" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P12" value="3" required></td>
                </tr>
                <tr>
                    <td>Fa suggeriments i propostes de millora</td>
                    <td class="text-center"><input type="radio" name="P13" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P13" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P13" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P13" value="3" required></td>
                </tr>
                <tr>
                    <td>Assoleix els objectius, esforçant-se per aconseguir el resultat esperat</td>
                    <td class="text-center"><input type="radio" name="P14" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P14" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P14" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P14" value="3" required></td>
                </tr>
                <tr>
                    <td>La quantitat de treball que desenvolupa en relació amb el treball encomanat és adequada</td>
                    <td class="text-center"><input type="radio" name="P15" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P15" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P15" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P15" value="3" required></td>
                </tr>
                <tr>
                    <td>Realitza les tasques amb la qualitat esperada i/o necessària</td>
                    <td class="text-center"><input type="radio" name="P16" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P16" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P16" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P16" value="3" required></td>
                </tr>
                <tr>
                    <td>Expressa amb claredat i ordre els aspectes rellevants de la informació</td>
                    <td class="text-center"><input type="radio" name="P17" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P17" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P17" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P17" value="3" required></td>
                </tr>
                <tr>
                    <td>Disposa del coneixements necessaris per a desenvolupar les tasques requerides del lloc de treball</td>
                    <td class="text-center"><input type="radio" name="P18" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P18" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P18" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P18" value="3" required></td>
                </tr>
                <tr>
                    <td>Mostra interès i motivació envers el seu lloc de treball</td>
                    <td class="text-center"><input type="radio" name="P19" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P19" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P19" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P19" value="3" required></td>
                </tr>
                <tr>
                    <td>La seva entrada i permanència en el lloc de treball es duu a terme sense retards o absències no justificades</td>
                    <td class="text-center"><input type="radio" name="P20" value="0" required></td>
                    <td class="text-center"><input type="radio" name="P20" value="1" required></td>
                    <td class="text-center"><input type="radio" name="P20" value="2" required></td>
                    <td class="text-center"><input type="radio" name="P20" value="3" required></td>
                </tr>
            </table>
            <input class="bg-orange-400 text-white px-8 py-1" type="submit" value="Enviar">
        </form>
    </div>
@endsection

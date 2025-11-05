@extends('../layouts.app')

@section('title','Valoracio Professionals')

@section('content')
    <div class="m-5 relative z-10">
        <h1 class="text-5xl mb-8 font-semibold">
            Estàs avaluant a {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
        </h1>
    </div>
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
                <tr>
                    <th></th>
                    <th>Gens d'acord</th>
                    <th>Poc d'acord</th>
                    <th>Bastant d'acord</th>
                    <th>Molt d'acord</th>
                </tr>
                <tr>
                    <td>Realitza una correcta atenció a l'usuari</td>
                    <td><input type="radio" name="P1" id="" value="0" required></td>
                    <td><input type="radio" name="P1" id="" value="1" required></td>
                    <td><input type="radio" name="P1" id="" value="2" required></td>
                    <td><input type="radio" name="P1" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Es preocupa per satisfer les seves necessitats dins dels recursos dels que disposa</td>
                    <td><input type="radio" name="P2" id="" value="0" required></td>
                    <td><input type="radio" name="P2" id="" value="1" required></td>
                    <td><input type="radio" name="P2" id="" value="2" required></td>
                    <td><input type="radio" name="P2" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>S'ha integrat dins l'equip de treball i participa i coopera sense dificultats</td>
                    <td><input type="radio" name="P3" id="" value="0" required></td>
                    <td><input type="radio" name="P3" id="" value="1" required></td>
                    <td><input type="radio" name="P3" id="" value="2" required></td>
                    <td><input type="radio" name="P3" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Pot treballar amb altres equips diferents al seu si es necessita</td>
                    <td><input type="radio" name="P4" id="" value="0" required></td>
                    <td><input type="radio" name="P4" id="" value="1" required></td>
                    <td><input type="radio" name="P4" id="" value="2" required></td>
                    <td><input type="radio" name="P4" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Compleix amb les funcions establertes</td>
                    <td><input type="radio" name="P5" id="" value="0" required></td>
                    <td><input type="radio" name="P5" id="" value="1" required></td>
                    <td><input type="radio" name="P5" id="" value="2" required></td>
                    <td><input type="radio" name="P5" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Assoleix els objectius utilitzant els recursos disponibles  per aconseguir els resultats esperats</td>
                    <td><input type="radio" name="P6" id="" value="0" required></td>
                    <td><input type="radio" name="P6" id="" value="1" required></td>
                    <td><input type="radio" name="P6" id="" value="2" required></td>
                    <td><input type="radio" name="P6" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>És coherent amb el que diu i amb les seves actuacions</td>
                    <td><input type="radio" name="P7" id="" value="0" required></td>
                    <td><input type="radio" name="P7" id="" value="1" required></td>
                    <td><input type="radio" name="P7" id="" value="2" required></td>
                    <td><input type="radio" name="P7" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Les seves actuacions van alineades amb els valors de la nostra Entitat</td>
                    <td><input type="radio" name="P8" id="" value="0" required></td>
                    <td><input type="radio" name="P8" id="" value="1" required></td>
                    <td><input type="radio" name="P8" id="" value="2" required></td>
                    <td><input type="radio" name="P8" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Mostra capacitat i interès en entendre i aplicar la normativa i els procediments establerts </td>
                    <td><input type="radio" name="P9" id="" value="0" required></td>
                    <td><input type="radio" name="P9" id="" value="1" required></td>
                    <td><input type="radio" name="P9" id="" value="2" required></td>
                    <td><input type="radio" name="P9" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>La seva actitud envers els seus responsables/comandaments és correcta</td>
                    <td><input type="radio" name="P10" id="" value="0" required></td>
                    <td><input type="radio" name="P10" id="" value="1" required></td>
                    <td><input type="radio" name="P10" id="" value="2" required></td>
                    <td><input type="radio" name="P10" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Té capacitat per a comprendre i acceptar  i adequar-se als canvis</td>
                    <td><input type="radio" name="P11" id="" value="0" required></td>
                    <td><input type="radio" name="P11" id="" value="1" required></td>
                    <td><input type="radio" name="P11" id="" value="2" required></td>
                    <td><input type="radio" name="P11" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Desenvolupa amb autonomia les seves funcions, sense necessitat de recolzament immediat/constant</td>
                    <td><input type="radio" name="P12" id="" value="0" required></td>
                    <td><input type="radio" name="P12" id="" value="1" required></td>
                    <td><input type="radio" name="P12" id="" value="2" required></td>
                    <td><input type="radio" name="P12" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Fa suggeriments i propostes de millora</td>
                    <td><input type="radio" name="P13" id="" value="0" required></td>
                    <td><input type="radio" name="P13" id="" value="1" required></td>
                    <td><input type="radio" name="P13" id="" value="2" required></td>
                    <td><input type="radio" name="P13" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Assoleix els objectius, esforçant-se per aconseguir el resultat esperat</td>
                    <td><input type="radio" name="P14" id="" value="0" required></td>
                    <td><input type="radio" name="P14" id="" value="1" required></td>
                    <td><input type="radio" name="P14" id="" value="2" required></td>
                    <td><input type="radio" name="P14" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>La quantitat de treball que desenvolupa en relació amb el treball encomanat és adequada</td>
                    <td><input type="radio" name="P15" id="" value="0" required></td>
                    <td><input type="radio" name="P15" id="" value="1" required></td>
                    <td><input type="radio" name="P15" id="" value="2" required></td>
                    <td><input type="radio" name="P15" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Realitza les tasques amb la qualitat esperada i/o necessària</td>
                    <td><input type="radio" name="P16" id="" value="0" required></td>
                    <td><input type="radio" name="P16" id="" value="1" required></td>
                    <td><input type="radio" name="P16" id="" value="2" required></td>
                    <td><input type="radio" name="P16" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Expressa amb claredat i ordre els aspectes rellevants de la informació</td>
                    <td><input type="radio" name="P17" id="" value="0" required></td>
                    <td><input type="radio" name="P17" id="" value="1" required></td>
                    <td><input type="radio" name="P17" id="" value="2" required></td>
                    <td><input type="radio" name="P17" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Disposa del coneixements necessaris per a desenvolupar les tasques requerides del lloc de treball</td>
                    <td><input type="radio" name="P18" id="" value="0" required></td>
                    <td><input type="radio" name="P18" id="" value="1" required></td>
                    <td><input type="radio" name="P18" id="" value="2" required></td>
                    <td><input type="radio" name="P18" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>Mostra interès i motivació envers el seu lloc de treball</td>
                    <td><input type="radio" name="P19" id="" value="0" required></td>
                    <td><input type="radio" name="P19" id="" value="1" required></td>
                    <td><input type="radio" name="P19" id="" value="2" required></td>
                    <td><input type="radio" name="P19" id="" value="3" required></td>
                </tr>
                <tr>
                    <td>La seva entrada i permanència en el lloc de treball es duu a terme sense retards o absències no justificades</td>
                    <td><input type="radio" name="P20" id="" value="0" required></td>
                    <td><input type="radio" name="P20" id="" value="1" required></td>
                    <td><input type="radio" name="P20" id="" value="2" required></td>
                    <td><input type="radio" name="P20" id="" value="3" required></td>
                </tr>
            </table>
            <input class="bg-orange-400 text-white px-8 py-1" type="submit" value="Enviar">
        </form>
    </div>
@endsection

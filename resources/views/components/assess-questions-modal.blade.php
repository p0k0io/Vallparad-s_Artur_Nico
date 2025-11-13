<div x-data="{openQuestions:false}">
    <button @click="openQuestions= true" class="text-center font-semibold text-orange-400 border-2 border-orange-400 mr-2 w-44 rounded-lg py-1">
        Veure Preguntes
    </button>
    <div x-show="openQuestions" class="fixed inset-0 backdrop-blur-sm flex items-center justify-center">
        <div
            class="bg-white/95 rounded-3xl p-6 w-5/6 shadow-xl border border-orange-200 flex"
            @click.outside="openQuestions=false"
        >
            <div class="w-2/4">
                <div>
                    <h1>Pregunta 1</h1>
                    <p>Realitza una correcta atenció a l'usuari</p>
                </div>
                <div>
                    <h1>Pregunta 2</h1>
                    <p>Es preocupa per satisfer les seves necessitats dins dels recursos dels que disposa</p>
                </div>
                <div>
                    <h1>Pregunta 3</h1>
                    <p>S'ha integrat dins l'equip de treball i participa i coopera sense dificultats</p>
                </div>
                <div>
                    <h1>Pregunta 4</h1>
                    <p>Pot treballar amb altres equips diferents al seu si es necessita</p>
                </div>
                <div>
                    <h1>Pregunta 5</h1>
                    <p>Compleix amb les funcions establertes</p>
                </div>
                <div>
                    <h1>Pregunta 6</h1>
                    <p>Assoleix els objectius utilitzant els recursos disponibles per aconseguir els resultats esperats</p>
                </div>
                <div>
                    <h1>Pregunta 7</h1>
                    <p>És coherent amb el que diu i amb les seves actuacions</p>
                </div>
                <div>
                    <h1>Pregunta 8</h1>
                    <p>Les seves actuacions van alineades amb els valors de la nostra Entitat</p>
                </div>
                <div>
                    <h1>Pregunta 9</h1>
                    <p>Mostra capacitat i interès en entendre i aplicar la normativa i els procediments establerts</p>
                </div>
                <div>
                    <h1>Pregunta 10</h1>
                    <p>La seva actitud envers els seus responsables/comandaments és correcta</p>
                </div>
            </div>
            <div class="w-2/4">
                <div>
                    <h1>Pregunta 11</h1>
                    <p>Té capacitat per a comprendre i acceptar i adequar-se als canvis</p>
                </div>
                <div>
                    <h1>Pregunta 12</h1>
                    <p>Desenvolupa amb autonomia les seves funcions, sense necessitat de recolzament immediat/constant</p>
                </div>
                <div>
                    <h1>Pregunta 13</h1>
                    <p>Fa suggeriments i propostes de millora</p>
                </div>
                <div>
                    <h1>Pregunta 14</h1>
                    <p>Assoleix els objectius, esforçant-se per aconseguir el resultat esperat</p>
                </div>
                <div>
                    <h1>Pregunta 15</h1>
                    <p>La quantitat de treball que desenvolupa en relació amb el treball encomanat és adequada</p>
                </div>
                <div>
                    <h1>Pregunta 16</h1>
                    <p>Realitza les tasques amb la qualitat esperada i/o necessària</p>
                </div>
                <div>
                    <h1>Pregunta 17</h1>
                    <p>Expressa amb claredat i ordre els aspectes rellevants de la informació</p>
                </div>
                <div>
                    <h1>Pregunta 18</h1>
                    <p>Disposa del coneixements necessaris per a desenvolupar les tasques requerides del lloc de treball</p>
                </div>
                <div>
                    <h1>Pregunta 19</h1>
                    <p>Mostra interès i motivació envers el seu lloc de treball</p>
                </div>
                <div>
                    <h1>Pregunta 20</h1>
                    <p>La seva entrada i permanència en el lloc de treball es duu a terme sense retards o absències no justificades</p>
                </div>
            </div>
        </div>
    </div>
</div>
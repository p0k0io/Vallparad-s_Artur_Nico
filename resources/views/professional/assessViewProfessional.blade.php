<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguiment Professional</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <img 
        src="{{ asset('images/asset_login_superpossed.png') }}" 
        alt="Decorative background"
        class="absolute bottom-0 left-0 w-full h-auto object-cover pointer-events-none select-none z-0"
    />

    <div class="bg-white bg-opacity-95 shadow-xl rounded-2xl p-10 w-3/4 flex flex-col space-y-4 z-10">
        <h2 class="text-3xl font-semibold text-orange-600 text-center">
            Avaluacions de {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
        </h2>
        <div id="seguiments" class="overflow-x-auto rounded-xl shadow-md mt-6">
            <table class="min-w-full border-collapse text-sm text-center">
                <thead class="bg-orange-300 text-white">
                    <tr>
                        <th class="w-20 py-2 border border-orange-200">P1</th>

                        <th class="w-20 py-2 border border-orange-200">P2</th>
                        <th class="w-20 py-2 border border-orange-200">P3</th>
                        <th class="w-20 py-2 border border-orange-200">P4</th>
                        <th class="w-20 py-2 border border-orange-200">P5</th>
                        <th class="w-20 py-2 border border-orange-200">P6</th>
                        <th class="w-20 py-2 border border-orange-200">P7</th>
                        <th class="w-20 py-2 border border-orange-200">P8</th>
                        <th class="w-20 py-2 border border-orange-200">P9</th>
                        <th class="w-20 py-2 border border-orange-200">P10</th>
                        <th class="w-20 py-2 border border-orange-200">P11</th>
                        <th class="w-20 py-2 border border-orange-200">P12</th>
                        <th class="w-20 py-2 border border-orange-200">P13</th>
                        <th class="w-20 py-2 border border-orange-200">P14</th>
                        <th class="w-20 py-2 border border-orange-200">P15</th>
                        <th class="w-20 py-2 border border-orange-200">P16</th>
                        <th class="w-20 py-2 border border-orange-200">P17</th>
                        <th class="w-20 py-2 border border-orange-200">P18</th>
                        <th class="w-20 py-2 border border-orange-200">P19</th>
                        <th class="w-20 py-2 border border-orange-200">P20</th>
                        <th class="px-3 py-2 border border-orange-200">Avaluador</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($evaluations as $evaluation)
                        <tr class="hover:bg-orange-50 border-b">
                            @for ($i = 1; $i <= 20; $i++)
                                @if($evaluation->{'P'.$i}==0)
                                    <td class="py-2 border border-gray-200 bg-red-200">{{ $evaluation->{'P'.$i} }}</td>
                                @elseif($evaluation->{'P'.$i}==1)
                                    <td class="py-2 border border-gray-200 bg-yellow-100">{{ $evaluation->{'P'.$i} }}</td>
                                @elseif($evaluation->{'P'.$i}==2)
                                    <td class="py-2 border border-gray-200 bg-green-100">{{ $evaluation->{'P'.$i} }}</td>
                                @else
                                    <td class="py-2 border border-gray-200 bg-green-200">{{ $evaluation->{'P'.$i} }}</td>
                                @endif
                            @endfor
                            <td class="px-3 py-2 border border-gray-200 font-medium text-gray-700">
                                {{ $evaluation->evaluator }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-center">
            <a href="{{ route('professional.index')}}" class="text-center font-semibold text-white bg-orange-400 mx-2 w-44 rounded-lg py-1">Tornar</a>
            <a href="{{ route('assessView.professional', $professional)}}" class="text-center font-semibold text-white bg-orange-400 mx-2 w-44 rounded-lg py-1">Nova Avaluacio</a>
            <a href="{{ route('trackingViewProfessional.professional', $professional)}}" class="text-center font-semibold text-white bg-orange-400 mx-2 w-44 rounded-lg py-1">Veure Seguiments</a>
            <x-assess-questions-modal class="mx-2"/>
        </div>
    </div>
</body>
</html>
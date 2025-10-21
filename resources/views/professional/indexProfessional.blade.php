@extends('../layouts.app')

@section('title','Professionals')

@section('content')
<div class="flex">

    <img 
        src="{{ asset('images/asset_login_superpossed.png') }}" 
        alt="Decorative background"
        class="absolute bottom-0 left-0 w-full h-auto object-cover pointer-events-none select-none z-0"
    />

    <div class="w-2/4">

    </div>
    <div class="flex w-2/4 bg-white bg-opacity-90 z-50 min-h-screen justify-center">
        <div class="flex flex-col w-3/4">
            <form class="flex flex-row w-full justify-between mt-32 mb-10" action="">
                <input class="bg-white border-2 w-2/3 border-grey-400 rounded-xl" type="text" name="" id="" placeholder="Buscar Professional">
                <input class="bg-white border-2 w-20 border-orange-400 rounded-3xl" type="button" value="">
                <input class="bg-white border-2 w-20 border-orange-700 rounded-3xl" type="button" value="">
            </form>
            <table class="w-full border-separate border-spacing-y-2">
                <tbody>
                    @foreach ($professionals as $professional)
                        @if($professional->status==1)
                            <tr class="bg-white border border-yellow-400 rounded-xl shadow-sm hover:border-orange-600 transition flex items-center justify-between px-4 py-2 my-5">
                        @else
                            <tr class="bg-gray-300 border border-gray-400 rounded-xl flex items-center justify-between px-4 py-2 my-5">
                        @endif
                            <td class="text-lg font-medium text-gray-800">
                                {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
                            </td>

                            <td class="flex items-center gap-3">
                                <form action="{{ route('changeStateProfessional', $professional) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    @if($professional->status==1)
                                        <input type="submit" value="Desactivar" class="px-3 py-1 w-28 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-lg transition">
                                    @else
                                        <input type="submit" value="Activar" class="px-3 py-1 w-28 text-sm font-semibold text-white bg-green-500 hover:bg-green-600 rounded-lg transition">
                                    @endif
                                </form>

                                <a href="{{ route('professional.edit', $professional) }}" class="px-3 py-1 text-sm font-semibold text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-end">
                <a class="bg-orange-500 text-white text-center text-2xl w-20 py-1 rounded-full hover:bg-orange-400 transition" href="<?php echo route('professional.create')?>">+</a>
            </div>
        </div>
    </div>
</div>

@endsection

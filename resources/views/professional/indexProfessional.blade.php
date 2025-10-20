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
    <div class="w-2/4 m-auto bg-white h-max z-50">
        <table class="" border="1" cellpadding="5">
            <tbody>
                @foreach ($professionals as $professional)
            
                    <tr class="bg-white border-2 border-orange-400 space-x-10 rounded-3xl">
                        <td>{{ $professional->id }}</td>
                        <td>{{ $professional->name }}</td>
                        <td>{{ $professional->surname1 }}</td>
                        <td>{{ $professional->email }}</td>
                        <td>{{ $professional->profession }}</td>
                        <td>{{ $professional->center->name }}</td>
                        @if($professional->status==1)
                        <td class="bg-green-300">
                        @elseif($professional->status==0)
                        <td class="bg-red-500">
                        @endif
                            <form action="{{route('changeStateProfessional', $professional)}}" method="post">
                                @csrf
                                @method('PUT')
                                @if($professional->status==1)
                                    <input type="submit" value="Desactivar" >
                                @elseif($professional->status==0)
                                    <input type="submit" value="Activar">
                                @endif
                            </form>
                            
                        </td>
                        <td>
                            <a href="<?php echo route('professional.edit', $professional)?>">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="<?php echo route('professional.create')?>">Introduir nou Professional</a>

    </div>
</div>

@endsection

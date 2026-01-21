<div class="fixed inset-0 backdrop-blur-sm bg-black/40 flex items-center justify-center z-50 px-4 hidden">
    <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200 z-50">
        <h1 class="text-orange-500 font-bold text-2xl text-center mb-6 ">
            Fer Seguiment
        </h1>
        <form action="{{route('createMaintenanceTracking.maintenance')}}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="maintenance_id" value="{{$maintenance->id}}">
            <div>
                <label class="block text-sm text-orange-600 mb-1 font-medium">Context</label>
                <input type="text" name="context" required
                    class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                >
            </div>
            <div>
                <label class="block text-sm text-orange-600 mb-1 font-medium">Descripcio</label>
                <input type="text" name="description" required
                    class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                >
            </div>
            <input type="submit" value="Crear" class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition w-full">
        </form>
    </div>
</div>
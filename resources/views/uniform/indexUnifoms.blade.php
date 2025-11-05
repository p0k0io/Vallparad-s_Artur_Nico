@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="w-full flex flex-col gap-16 justify-center items-center p-10 bg-slate-100 min-h-screen">
  <div class="w-5/6 bg-white rounded-3xl shadow-lg p-8 flex flex-col gap-6" x-data="{ openCard: null }">
    

    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
      <h1 class="text-2xl font-bold text-orange-500">Pendents d’entrega</h1>

      <div class="flex items-center gap-4 w-full md:w-1/2">
        <input 
          type="text" 
          placeholder="Cerca un professional..." 
          class="flex-grow border border-orange-400 rounded-full px-4 py-2 text-gray-700 focus:ring-2 focus:ring-orange-400 focus:outline-none"
        >
        <a 
          href="{{ route('uniforms.export') }}" 
          class="bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-full px-5 py-2 flex items-center gap-2 transition-all duration-300 shadow-md"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
          </svg>
          Descarrega pendents
        </a>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 items-start mt-6">
      @foreach($uniforms as $index => $uniform)
        @if($uniform->estat == 0)
        <div 
          class="bg-white border border-orange-300 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden"
          :class="{ 'ring-2 ring-orange-400': openCard === {{ $index }} }"
        >

          <div 
            class="flex justify-between items-center px-5 py-4 cursor-pointer select-none"
            @click="openCard === {{ $index }} ? openCard = null : openCard = {{ $index }}"
          >
            <div class="font-semibold text-orange-600 truncate">
              {{ $uniform->professional->name ?? 'N/A' }}
              {{ $uniform->professional->surname1 ?? '' }}
              {{ $uniform->professional->surname2 ?? '' }}
            </div>

            <div class="flex items-center gap-2 text-sm text-gray-600">
              <span>{{ $uniform->created_at->format('d/m/Y') }}</span>
              <svg 
                xmlns="http://www.w3.org/2000/svg" 
                class="w-5 h-5 text-orange-500 transform transition-transform duration-300" 
                :class="{ 'rotate-180': openCard === {{ $index }} }"
                fill="none" viewBox="0 0 24 24" stroke="currentColor"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
          </div>


          <div 
            x-ref="content{{ $index }}"
            x-bind:style="openCard === {{ $index }} ? 'max-height:' + $refs.content{{ $index }}.scrollHeight + 'px' : 'max-height: 0px'"
            class="transition-all duration-500 ease-in-out overflow-hidden"
          >
            <div class="p-5 space-y-4">

              <div class="flex flex-row  gap-3">
                @if($uniform->shirtSize || $uniform->pantsSize || $uniform->shoeSize)
                  <div class="flex  flex-col lg:flex-row gap-3 w-full">

                    @if($uniform->shirtSize)
                      <div class="flex items-center flex-col border-2 border-orange-200 rounded-xl px-3 py-2 bg-white shadow-sm">
                        <div class="flex items-center gap-2">
                            

                          <x-lucide-shirt class="w-6 h-6 text-orange-500" />
                          <span class="text-gray-500 text-sm">({{ $uniform->shirtSize }})</span>
                        </div>
                        <span class="font-semibold text-gray-800">{{ $uniform->shirtAm }}</span>
                      </div>
                    @endif

                    @if($uniform->pantsSize)
                      <div class="flex items-center flex-col border-2 border-orange-200 rounded-xl px-3 py-2 bg-white shadow-sm">
                        <div class="flex items-center gap-2">
                        
                          
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="oklch(70.5% 0.213 47.604)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trousers-icon lucide-trousers"><path d="M4 6h16"/><path d="M6 22a2 2 0 0 1-2-2V3c0-.6.4-1 1-1h14c.6 0 1 .4 1 1v17a2 2 0 0 1-2 2h-3l-3-10-3 10Z"/><path d="m6 11-2 1"/><path d="M9 8.5V6"/><path d="M15 6v2.5"/><path d="m20 12-2-1"/><path d="M4 18h6"/><path d="M14 18h6"/></svg>
                          <span class="text-gray-500 text-sm">({{ $uniform->pantsSize }})</span>
                        </div>
                        <span class="font-semibold text-gray-800">{{ $uniform->pantAm }}</span>
                      </div>
                    @endif

                    @if($uniform->shoeSize)
                      <div class="flex items-center flex-col border-2 border-orange-200 rounded-xl px-3 py-2 bg-white shadow-sm">
                        <div class="flex items-center gap-2">
                          <x-lucide-footprints class="w-6 h-6 text-orange-500"/>
                          <span class="text-gray-500 text-sm">({{ $uniform->shoeSize }})</span>
                        </div>
                        <span class="font-semibold text-gray-800">{{ $uniform->shoeAm }}</span>
                      </div>
                    @endif

                  </div>
                @else
                  <p class="text-gray-400 italic">Sense informació de peces.</p>
                @endif
              </div>


              <div class="flex justify-end items-center pt-3">

                <button 
                  class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold rounded-full px-4 py-2 flex items-center gap-1 transition-all"
                >
                  Confirmar
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                </button>
              </div>

            </div>
          </div>
        </div>
        @endif
      @endforeach
    </div>
  </div>


@vite('resources/css/app.css')

<div class="max-w-5xl mx-auto bg-white p-10 rounded-3xl shadow-2xl mt-10 border border-orange-100">
  <div class="text-center mb-10">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-2 tracking-tight">Crear Nuevo Uniforme</h1>
    <p class="text-gray-500 text-sm">Gestiona las tallas y cantidades del uniforme de manera rápida y visual</p>
  </div>

  <form action="{{ route('uniforms.store') }}" method="POST" class="space-y-12">
    @csrf

    <!-- Sección 1: Cantidades -->
    <section class="bg-gradient-to-br from-orange-50 to-white rounded-2xl p-8 shadow-inner flex flex-col md:flex-row items-center justify-around gap-10">
      
      <!-- Camisetas -->
      <div class="flex flex-col items-center gap-4">
        <div class="p-5 rounded-2xl border-2 border-orange-400 bg-white flex items-center justify-center shadow-sm hover:shadow-md hover:bg-orange-100 transition-all duration-300">
          <x-lucide-shirt class="w-10 h-10 text-orange-500" />
        </div>
        <label for="shirtAm" class="text-lg font-semibold text-gray-700">Camisetas</label>
        <input type="number" min="0" name="shirtAm" id="shirtAm" placeholder="0" class="text-center text-lg font-medium border-gray-300 rounded-xl w-24 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none transition-all">
      </div>

      <!-- Pantalones -->
      <div class="flex flex-col items-center gap-4">
        <div class="p-5 rounded-2xl border-2 border-orange-400 bg-white flex items-center justify-center shadow-sm hover:shadow-md hover:bg-orange-100 transition-all duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="oklch(70.5% 0.213 47.604)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 6h16"/><path d="M6 22a2 2 0 0 1-2-2V3c0-.6.4-1 1-1h14c.6 0 1 .4 1 1v17a2 2 0 0 1-2 2h-3l-3-10-3 10Z"/>
            <path d="m6 11-2 1"/><path d="M9 8.5V6"/><path d="M15 6v2.5"/><path d="m20 12-2-1"/><path d="M4 18h6"/><path d="M14 18h6"/>
          </svg>
        </div>
        <label for="pantAm" class="text-lg font-semibold text-gray-700">Pantalones</label>
        <input type="number" min="0" name="pantAm" id="pantAm" placeholder="0" class="text-center text-lg font-medium border-gray-300 rounded-xl w-24 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none transition-all">
      </div>

      <!-- Zapatos -->
      <div class="flex flex-col items-center gap-4">
        <div class="p-5 rounded-2xl border-2 border-orange-400 bg-white flex items-center justify-center shadow-sm hover:shadow-md hover:bg-orange-100 transition-all duration-300">
          <x-lucide-footprints class="w-10 h-10 text-orange-500" />
        </div>
        <label for="shoeAm" class="text-lg font-semibold text-gray-700">Zapatos</label>
        <input type="number" min="0" name="shoeAm" id="shoeAm" placeholder="0" class="text-center text-lg font-medium border-gray-300 rounded-xl w-24 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none transition-all">
      </div>

    </section>

    <!-- Sección 2: Tallas -->
    <section class="grid md:grid-cols-3 gap-8">
      <!-- Camisa -->
      <div>
        <label for="shirtSize" class="block text-sm font-medium text-gray-700 mb-2">Talla de Camisa</label>
        <select name="shirtSize" id="shirtSize" class="w-full rounded-xl px-4 py-3 border-gray-300 shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
          <option value="">Selecciona talla</option>
          @foreach(['S','M','L','XL','2XL','3XL','4XL'] as $size)
            <option value="{{ $size }}">{{ $size }}</option>
          @endforeach
        </select>
      </div>

      <!-- Pantalón -->
      <div>
        <label for="pantsSize" class="block text-sm font-medium text-gray-700 mb-2">Talla de Pantalón</label>
        <select name="pantsSize" id="pantsSize" class="w-full rounded-xl px-4 py-3 border-gray-300 shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
          <option value="">Selecciona talla</option>
          @foreach(['S','M','L','XL','2XL','3XL','4XL'] as $size)
            <option value="{{ $size }}">{{ $size }}</option>
          @endforeach
        </select>
      </div>

      <!-- Zapato -->
      <div>
        <label for="shoeSize" class="block text-sm font-medium text-gray-700 mb-2">Talla de Zapato</label>
        <select name="shoeSize" id="shoeSize" class="w-full rounded-xl px-4 py-3 border-gray-300 shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
          <option value="">Selecciona número</option>
          @for ($i = 34; $i <= 45; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
          @endfor
        </select>
      </div>
    </section>

    <!-- Sección 3: Profesional y último uniforme -->
    <section class="grid md:grid-cols-2 gap-8">
      <div>
        <label for="professional_id" class="block text-sm font-medium text-gray-700 mb-2">Profesional</label>
        <select name="professional_id" id="professional_id" class="w-full rounded-xl px-4 py-3 border-gray-300 shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
          <option value="">--Selecciona--</option>
          @foreach($professionals as $prof)
            <option value="{{ $prof->id }}">{{ $prof->name }} {{ $prof->surname1 }} {{ $prof->surname2 }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label for="lastUniform" class="block text-sm font-medium text-gray-700 mb-2">Último Uniforme</label>
        <select name="lastUniform" id="lastUniform" class="w-full rounded-xl px-4 py-3 border-gray-300 shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
          <option value="">Ninguno</option>
          @foreach($uniforms as $u)
            <option value="{{ $u->id }}">Uniforme #{{ $u->id }}</option>
          @endforeach
        </select>
      </div>
    </section>

    <!-- Sección 4: Botón -->
    <div class="flex justify-end">
      <button type="submit" class="px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
        Crear Uniforme
      </button>
    </div>
  </form>
</div>



</div>





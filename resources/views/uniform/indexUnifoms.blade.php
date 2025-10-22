@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="overflow-x-auto bg-gray-50 p-6 rounded-lg shadow-lg">
    <table class="min-w-full table-auto bg-white border-collapse rounded-lg shadow-md">
        <thead>
            <tr class="bg-orange-600 text-white">
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Shirt Size</th>
                <th class="px-4 py-2 text-left">Pants Size</th>
                <th class="px-4 py-2 text-left">Shoe Size</th>
                <th class="px-4 py-2 text-left">Professional</th>
                <th class="px-4 py-2 text-left">Last Uniform</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($uniforms as $uniform)
                <tr class="border-t border-gray-200 hover:bg-orange-50">
                    <td class="px-4 py-2 text-gray-800">{{ $uniform->id }}</td>
                    <td class="px-4 py-2 text-gray-800">{{ $uniform->shirtSize }}</td>
                    <td class="px-4 py-2 text-gray-800">{{ $uniform->pantsSize }}</td>
                    <td class="px-4 py-2 text-gray-800">{{ $uniform->shoeSize }}</td>
                    <td class="px-4 py-2 text-gray-800">
                        {{ $uniform->professional->name ?? 'N/A' }}
                        {{ $uniform->professional->surname1 ?? '' }}
                        {{ $uniform->professional->surname2 ?? '' }}
                    </td>
                    <td class="px-4 py-2 text-gray-800">
                        @if($uniform->lastUniform)
                            Uniform #{{ $uniform->lastUniform->id }}
                        @else
                            None
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-6 flex justify-between">
    <a href="{{ route('uniforms.create') }}" class="inline-block px-6 py-3 bg-orange-600 text-white font-semibold rounded-lg shadow-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">
        Add New Uniform
    </a>
    <a href="{{ route('uniforms.export') }}" class="inline-block px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
        Export to Excel
    </a>
</div>





<div class="w-full flex justify-center items-center p-10 bg-slate-100 min-h-screen">
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
            class="transition-all duration-500 ease-in-out overflow-hidden bg-orange-50/50"
          >
            <div class="p-5 space-y-4">
              <h2 class="text-orange-500 font-semibold text-lg">Detalls de l'entrega</h2>

              <div class="flex flex-row  gap-3">
                @if($uniform->shirtSize || $uniform->pantsSize || $uniform->shoeSize)
                  <div class="flex flex-col gap-3 w-full">

                    @if($uniform->shirtSize)
                      <div class="flex items-center justify-between border border-orange-200 rounded-xl px-3 py-2 bg-white shadow-sm">
                        <div class="flex items-center gap-2">
                 
                          <span class="text-gray-600 text-sm">Samarreta</span>
                          <span class="text-gray-500 text-sm">({{ $uniform->shirtSize }})</span>
                        </div>
                        <span class="font-semibold text-gray-800">{{ $uniform->shirtAm }}</span>
                      </div>
                    @endif

                    @if($uniform->pantsSize)
                      <div class="flex items-center justify-between border border-orange-200 rounded-xl px-3 py-2 bg-white shadow-sm">
                        <div class="flex items-center gap-2">
                        
                          
                          <span class="text-gray-600 text-sm">Pantalons</span>
                          <span class="text-gray-500 text-sm">({{ $uniform->pantsSize }})</span>
                        </div>
                        <span class="font-semibold text-gray-800">{{ $uniform->pantAm }}</span>
                      </div>
                    @endif

                    @if($uniform->shoeSize)
                      <div class="flex items-center justify-between border border-orange-200 rounded-xl px-3 py-2 bg-white shadow-sm">
                        <div class="flex items-center gap-2">
                          <span class="text-gray-600 text-sm">Sabates</span>
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
</div>





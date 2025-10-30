@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="overflow-x-auto min-w-screen flex flex-col lg:flex-row bg-gray-50 p-6 rounded-lg shadow-lg">
    <div class="flex flex-col lg:flex-row items-center justify-center gap-10 w-full px-10 py-4 lg:px-28">
        <div class="bg-green-300 w-full lg:w-1/2 rounded-2xl p-10">
            <div class="w-full h-64">
                <div></div>
            </div>
            <div class=" w-full h-auto flex items-center justify-center bg-yellow-400">
                <button class=" h-auto py-2 px-10 lg:w-2/5 rounded-3xl bg-orange-400 text-white font-bold shadow-lg">
                        Crear nuevo curso
                </button>
            </div>
        </div>

        <div class="bg-blue-300  w-full lg:w-1/2 p-10 rounded-2xl">
            <div class="w-full bg-slate-600 rounded-full h-12 flex flex-col md:flex-row lg:gap-4">
                <div class="w-full lg:w-3/4 h-full bg-red-300 rounded-full">

                </div>
                <button class="w-full lg:w-1/4 bg-green-200 h-full rounded-full">

                </button>

            </div>
            <div class="p-10 bg-black mt-5 h-64 rounded-xl">


            </div>
        </div>
    </div>
       
</div>


<div class=" flex items-center justify-center min-w-screen  h-48 bg-red-950" >
    <div class="w-full lg:w-3/4 p-10 bg-lime-100 rounded-3xl flex gap-3">


        <div class="h-auto bg-purple-300 w-1/4  flex items-center justify-center py-3">
            <div class="w-16 h-16 rounded-full border-4 border-yellow-300 flex items-center justify-center">
                <h1 class="text-3xl font-bold text-yellow-300">
                    1
                </h1>
            </div>



        </div>
                <div class="h-auto bg-purple-300 w-1/4  flex items-center justify-center py-3">
            <div class="w-16 h-16 rounded-full border-4 border-yellow-300 flex items-center justify-center">
                <h1 class="text-3xl font-bold text-yellow-300">
                    1
                </h1>
            </div>

            

        </div>

                <div class="h-auto bg-purple-300 w-1/4  flex items-center justify-center py-3">
            <div class="w-16 h-16 rounded-full border-4 border-yellow-300 flex items-center justify-center">
                <h1 class="text-3xl font-bold text-yellow-300">
                    1
                </h1>
            </div>

            

        </div>

                <div class="h-auto bg-purple-300 w-1/4  flex items-center justify-center py-3">
            <div class="w-full h-auto py-3 rounded-3xl  bg-orange-500 border-4 border-orange-500 flex items-center justify-center">
                <h1 class="text-xl font-bold text-white">
                    Crear curso
                </h1>
            </div>

            

        </div>


    </div>




</div>


<x-filter-professional />









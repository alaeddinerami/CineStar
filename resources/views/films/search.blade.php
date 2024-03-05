{{-- 
    @foreach ($films as $film)
        <div class="min-h-screen bg-gray-100 w-full sm:py-12">
            <div class="py-3 sm:max-w-xl  sm:mx-auto">
                <div class="bg-white shadow-lg border-gray-100 max-h-80 border sm:rounded-3xl p-8 flex flex-col-6 sm:flex-row space-y-4 sm:space-y-0 sm:space-x-8">
                    <div class="h-48 overflow-visible w-full sm:w-1/2">
                        <img class="rounded-3xl shadow-lg object-cover" src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/1LRLLWGvs5sZdTzuMqLEahb88Pc.jpg" alt="">
                    </div>
                    <div class="flex flex-col w-full sm:w-1/2 space-y-4">
                        <div class="flex justify-between items-start">
                            <h2 class="text-3xl font-bold"> {{$film->title}} </h2>
                        </div>
                        <div class="flex gap-2">
                            @foreach ($film->genres as $genre)
                                <div class="text-sm text-blue-400">{{ $genre->name }}</div>
                            @endforeach
                        </div>
                        <p class="text-gray-400 max-h-40 overflow-y-hidden"> {{ substr($film->overview, 0, 70) . '...' }} </p>
                        <button type="button" class="px-6 py-2 rounded text-white text-sm tracking-wider font-medium outline-none border-2 border-[#333] bg-[#222] hover:bg-transparent hover:text-black transition-all duration-300">Réserver</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

 --}}

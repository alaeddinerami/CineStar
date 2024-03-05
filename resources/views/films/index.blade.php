@if (session()->has('message'))
    @stack('scripts')
    <script>
        Swal.fire({
            title: '{{ session('operationSuccessful') ? 'Success' : 'Error' }}!',
            icon: '{{ session('operationSuccessful') ? 'success' : 'error' }}',
            confirmButtonText: 'Ok',
            html: '{{ session('message') }}'
        })
    </script>
@endif
<x-app-layout>
    <div class="w-11/12 mx-auto flex flex-col items-start justify-start mt-8 gap-8 text-gray-900">
        <div class="flex items-center flex-wrap">
            <ul class="flex items-center">
                <li class="inline-flex items-center">
                    <a href="/" class="hover:text-blue-500">
                        <svg class="w-5 h-auto fill-current " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z" />
                        </svg>
                    </a>
                    <span class="mx-4 h-auto text-gray-400 font-medium">/</span>
                </li>
                <li class="inline-flex items-center">
                    <a href="{{ route('films.index') }}" class="hover:text-blue-500">Films</a>
                </li>
            </ul>
        </div>
    </div>
    <form id="searchForm" action="{{ route('films.index') }}" method="GET"
        class="mx-auto mt-5 relative min-w-sm max-w-2xl flex flex-col md:flex-row items-center justify-center py-2 px-2 rounded-2xl gap-2">
        <input id="search_input" name="search" placeholder="Your keyword here"
            class="px-6 py-2 w-full rounded-md flex-1 outline-none">
        <button type="submit"
            class="w-full md:w-auto px-6 py-3 bg-black border-black text-white active:scale-95 duration-100 border will-change-transform overflow-hidden relative rounded-xl transition-all disabled:opacity-70">
            <div class="relative">
                <div
                    class="flex items-center justify-center h-3 w-3 absolute inset-1/2 -translate-x-1/2 -translate-y-1/2 transition-all">
                    <svg class="opacity-0 animate-spin w-full h-full" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
                <div class="flex items-center transition-all opacity-1 valid:"><span
                        class="text-sm font-semibold whitespace-nowrap truncate mx-auto">Search</span></div>
            </div>
        </button>
    </form>

    <div class="ALL grid grid-cols-1 sm:grid-cols-2">

        @foreach ($films as $film)
            <div class="bg-gray-100 w-full sm:py-12 my-4">
                <div class="py-3 sm:max-w-xl  sm:mx-auto">
                    <div
                        class="bg-white shadow-lg border-gray-100 h-[60vh] max-h-80 border sm:rounded-3xl p-8 flex space-y-4 gap-2 sm:space-y-0 sm:space-x-8">
                        <div class="h-48 overflow-visible w-1/2">
                            @if ($film->image == null)
                                <img src="{{ asset('assets/images/poster.jpg') }}"
                                    class="rounded-3xl shadow-lg object-cover" alt="">
                            @else
                                <img src="{{ asset('storage/' . $film->image->path) }}"
                                    class="rounded-3xl shadow-lg object-cover" alt="">
                            @endif
                        </div>
                        <div class="flex flex-col justify-between w-1/2">
                            <div class="flex justify-between items-start">
                                <h2 class="text-3xl font-bold"> {{ $film->title }} </h2>
                            </div>
                            <div class="flex gap-2">
                                @foreach ($film->genres as $genre)
                                    <div class="text-sm text-blue-400">{{ $genre->name }}</div>
                                @endforeach
                            </div>
                            <p class="text-gray-400 max-h-40 overflow-y-hidden">
                                {{ substr($film->overview, 0, 70) . '...' }} </p>
                            <button type="button"
                                class="px-6 py-2 rounded text-white text-sm tracking-wider font-medium outline-none border-2 border-[#333] bg-[#222] hover:bg-transparent hover:text-black transition-all duration-300">Réserver</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="w-11/12 mx-auto my-8">{{ $films->links() }}</div>


    @stack('vite')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/js/ajax_search.js')
</x-app-layout>

<x-dashboard-layout>
    @push('vite')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    @endpush
    @isset($message)
        @stack('scripts')
        <script>
            Swal.fire({
                title: '{{ $operationSuccessful ? 'Success' : 'Error' }}!',
                text: '{{ $message }}',
                icon: '{{ $operationSuccessful ? 'success' : 'error' }}',
                confirmButtonText: 'Ok'
            })
        </script>
    @endisset
    <div id="Modal" class="fixed w-full h-full top-0 left-0 items-center flex justify-center hidden z-50">
        <div
            class="bg-white w-full md:w-7/12 h-fit border-2 border-[#202257] flex flex-col justify-start items-center overflow-y-auto md:h-fit">
            <div class="bg-[#202257] w-full md:w-7/12 h-8 fixed">
                <div class="flex justify-end">
                    <span onclick="closeModal()" class="text-2xl text-white font-bold cursor-pointer mr-3">&times;</span>
                </div>
            </div>
            <form method="post" action="{{ route('screening.store') }}" onsubmit="return validateForm()"
                class="flex flex-col justify-between items-center h-full w-full mt-[10vh]">
                @csrf
                <div class="flex flex-col justify-center items-center mb-3 w-full">
                    <div class="flex flex-col w-[65%] border-2 border-[#A1A1A1] p-2 rounded-md">
                        <p class="text-xs">Film</p>
                        <select name="film" id="films">
                            @unless (count($films) == 0)
                                
                            @endunless
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <div class="flex flex-col w-[65%] border-2 border-[#A1A1A1] p-2 rounded-md">
                        <p class="text-xs">Category name</p>

                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <div class="flex flex-col w-[65%] border-2 border-[#A1A1A1] p-2 rounded-md">
                        <p class="text-xs">Date</p>
                        <input required class="placeholder:font-light placeholder:text-xs focus:outline-none"
                            id="categoryname" type="date" name="date
                            " placeholder="Name"
                            autocomplete="off">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <div class="flex flex-col w-[65%] border-2 border-[#A1A1A1] p-2 rounded-md">
                        <p class="text-xs">Category name</p>
                        <input required class="placeholder:font-light placeholder:text-xs focus:outline-none"
                            id="categoryname" type="text" name="category" placeholder="Name" autocomplete="off">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="flex justify-end mb-4 w-[65%]">
                    <input required type="submit" name="submit"
                        class="cursor-pointer w-full px-8 py-2 bg-blue-500 font-semibold rounded-lg border-2 border-blue-600 text-white"
                        value="Add category">
                </div>
            </form>
        </div>
    </div>
    {{-- Content --}}
    <div class="w-11/12 mx-auto flex flex-col items-start justify-start mt-8 text-gray-900">
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
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-500">Dashboard</a>
                    <span class="mx-4 h-auto text-gray-400 font-medium">/</span>
                </li>
                <li class="inline-flex items-center">
                    <a href="{{ route('screening.index') }}" class="hover:text-blue-500">Screenings</a>
                </li>
            </ul>
        </div>
        <div class="w-full flex justify-between items-center px-2 mt-4">
            <p class="text-none text-xl font-semibold indent-4">Screenings</p>
            <button onclick="openModal()" class="text-xl font-semibold hover:underline">Reserve a screening</button>
        </div>
    </div>
    @stack('scripts')
    <script src="{{ asset('assets/js/modal.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#films').select2();
        });
        $(document).ready(function() {
            $('#halls').select2();
        });
    </script>

</x-dashboard-layout>

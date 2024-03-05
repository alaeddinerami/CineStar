<x-app-layout>
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
    <div class="w-11/12 md:h-[90vh] mx-auto flex flex-col items-start justify-start mt-8 mb-20 gap-8 text-gray-900">
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
                    <a href="{{ route('reservation.index') }}" class="hover:text-blue-500">My Reservations</a>
                    <span class="mx-4 h-auto text-gray-400 font-medium">/</span>
                </li>
                <li class="inline-flex items-center">
                    <a href="{{ route('reservation.show', [$reservation->id, $film->slug]) }}"
                        class="hover:text-blue-500">Reservation-{{ $reservation->id }}</a>
                </li>
            </ul>
        </div>
        <p class="text-4xl font-semibold">My Ticket:</p>
        <div class="w-full flex flex-col gap-6 border-t-2 py-8 rounded-md shadow-lg p-3 h-[60vh] sm:h-[80vh]">
            <div class="relative bg-ticket bg-contain bg-no-repeat w-full h-full text-gray-200">
                <div class="flex justify-around transform rotate-180 h-3/5 ml-4 [&>*]:text-3xl"
                    style="writing-mode: vertical-rl">
                    <p>Ticket Number:</p>
                    <p>{{ $reservation->id }}</p>
                </div>
                <div class="[&>*]:absolute">
                    <p class="top-16 left-32 text-5xl font-bold">CineStar</p>
                    <p class="top-32 left-32 text-3xl w-[260px] font-bold">{{ $film->title }}</p>
                    <p class="bottom-4 left-32 text-3xl">{{ $reservation->seat->hall->name }}</p>
                    <p class="bottom-12 left-[35%] text-2xl">Date:</p>
                    <p class="bottom-4 left-[35%] text-3xl">{{ $reservation->screening_date }}</p>
                    <p class="bottom-12 left-[65%] text-2xl">Seat:</p>
                    <p class="bottom-4 left-[65%] text-3xl">{{ $reservation->seat->id }}</p>
                </div>
            </div>
        </div>
    </div>
    @stack('vite')
    <style>
        .bg-ticket {
            background-image: url('{{ asset('assets/images/ticket-bg.jpeg') }}');
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>

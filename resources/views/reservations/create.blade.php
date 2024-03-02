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
    <div class="w-11/12 h-[90vh] mx-auto flex flex-col items-start justify-start mt-8 mb-20 gap-8 text-gray-900">
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
                    <span class="mx-4 h-auto text-gray-400 font-medium">/</span>
                </li>
                <li class="inline-flex items-center">
                    <a href="{{ route('film.show', $film->slug) }}" class="hover:text-blue-500">{{ $film->title }}</a>
                    <span class="mx-4 h-auto text-gray-400 font-medium">/</span>
                </li>
                <li class="inline-flex items-center">
                    <a href="{{ route('reservation.create', [$date, $hall->id, $film->slug]) }}"
                        class="hover:text-blue-500">Reservation</a>
                </li>
            </ul>
        </div>
        <p class="text-4xl font-semibold">{{ $hall->name }}:</p>
        <div
            class="w-full flex flex-col gap-6 border-t-2 rounded-md shadow-lg p-3 h-[70vh] sm:h-[80vh] overflow-x-auto">
            <form method="post" action="{{ route('reservation.store') }}" class="flex h-full flex-col justify-around">
                @csrf
                @php
                    $disabled = false;
                @endphp
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="screening_date" id="" value="{{ $date }}">
                <div class="flex flex-wrap w-[1223px] justify-center items-center transition-all duration-100">
                    @foreach ($seats = $hall->seats()->get() as $seat)
                        @dd($seat->reservations()->where('screening_date', $date)->get())
                        @php
                            if ($seat->reservations()->where('screening_date', $date)->exists()) {
                                $disabled = true;
                            }
                        @endphp
                        <div>
                            <x-radio-input id="seat{{ $seat->id }}" name="seat_id" value="{{ $seat->id }}"
                                :disabled="$disabled" />
                            <x-label-seat for="seat{{ $seat->id }}"
                                data-tooltip-target="tooltip{{ $seat->id }}" :disabled="$disabled" :seat="$seat" />
                        </div>
                    @endforeach
                </div>
                <x-hall-screen />
                <x-primary-button class="absolute z-10 sm:right-20 sm:bottom-0 bottom-8 right-10">
                    {{ __('Reserve') }}
                </x-primary-button>
            </form>
        </div>
    </div>
    @stack('vite')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>

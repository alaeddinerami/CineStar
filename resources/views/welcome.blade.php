@php
    $screeningsByDate = $screenings->groupBy(function ($screening) {
        return $screening->date->format('Y-m-d');
    });
@endphp
<x-app-layout>
    <div id="indicators-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-[80vh]">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                <img src="{{ asset('assets/images/carousel_1.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('assets/images/carousel_2.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('assets/images/carousel_3.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('assets/images/carousel_4.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('assets/images/carousel_5.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                data-carousel-slide-to="4"></button>
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-10 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
    <div class="w-11/12 ml-9 flex flex-col items-start justify-start my-14 text-gray-900">
        <p class="text-5xl font-semibold my-4">Film Screenings</p>

        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                data-tabs-toggle="#default-styled-tab-content"
                data-tabs-active-classes="text-purple-600 hover:text-purple-600 border-purple-600 dark:border-purple-500"
                data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 border-gray-100 hover:border-gray-300 dark:border-gray-700"
                role="tablist">
                @foreach ($screeningsByDate as $date => $screenings)
                    @if ($loop->index < 7)
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="{{ 'day-' . $loop->index }}"
                                data-tabs-target="{{ '#day-' . $loop->index . '-content' }}" type="button"
                                role="tab" aria-controls="{{ 'day-' . $loop->index }}-content"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ \Carbon\Carbon::parse($date)->format('l') }}
                            </button>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div id="default-styled-tab-content">

            @foreach ($screeningsByDate as $date => $screenings)
                @if ($loop->index < 7)
                    <div class="hidden p-4 rounded-lg shadow-xl bg-gray-50 w-[90%] md:w-4/5"
                        id="{{ 'day-' . $loop->index . '-content' }}" role="tabpanel"
                        aria-labelledby="{{ 'day-' . $loop->index }}">
                        <ul class="flex flex-col gap-8">
                            @foreach ($screenings->groupBy('film_id') as $id => $screenings2)
                                @php
                                    $screening = $screenings2->first();
                                @endphp

                                <li>
                                    <div class="flex flex-col md:flex-row gap-4">
                                        @if ($screening->film->image == null)
                                            <img src="{{ asset('assets/images/poster.jpg') }}"
                                                class="w-full md:w-[25%] h-[80%] inline-block shrink-0 rounded-2xl"
                                                alt="">
                                        @else
                                            <img src="{{ asset('storage/' . $film->image->path) }}"
                                                class="w-full md:w-[25%] h-[80%] inline-block shrink-0 rounded-2xl"
                                                alt="">
                                        @endif
                                        <div class="flex flex-col justify-between">
                                            <div class="w-full flex justify-between items-center">
                                                <div class="flex flex-col gap-1">
                                                    <a href="{{ route('film.show', $screening->film->id) }}"
                                                        class="text-3xl hover:text-purple-600 font-semibold">{{ $screening->film->title }}
                                                    </a>
                                                    <div class="flex items-center gap-1">
                                                        @foreach ($screening->film->genres as $genre)
                                                            <p
                                                                class="capitalize cursor-default text-sm p-1 rounded-xl border border-gray-500 text-gray-500">
                                                                {{ $genre->name }}</p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="flex gap-1">
                                                    {{-- @foreach ($screening->film->halls as $hall)
                                                        <p>{{ $hall->name }}</p>
                                                    @endforeach --}}
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-lg font-semibold">Overview:</p>
                                                <p class="rounded-md border shadow-md">
                                                    {{ $screening->film->overview }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-lg font-semibold">Displays at:</p>
                                                <div class="flex items-center gap-1">
                                                    @foreach ($screenings2->groupBy('date') as $date2 => $films)
                                                        <p
                                                            class="capitalize cursor-default text-sm p-1 rounded-xl border border-gray-500 text-gray-500">
                                                            {{ $date2 }}</p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    @vite('resources/js/carousel.js')
</x-app-layout>

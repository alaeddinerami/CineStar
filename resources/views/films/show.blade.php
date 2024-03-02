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
    <div class="w-11/12 mx-auto flex flex-col items-start justify-start mt-8 mb-20 gap-8 text-gray-900">
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
                </li>
            </ul>
        </div>
        <div class="w-full flex flex-col gap-6 border-t-2 rounded-md shadow-lg p-3">
            <div class="flex justify-center gap-4">
                @if ($film->image == null)
                    <img src="{{ asset('assets/images/poster.jpg') }}"
                        class="w-full md:w-[25%] h-[80%] inline-block shrink-0 rounded-2xl shadow-md" alt="">
                @else
                    <img src="{{ asset('storage/' . $film->image->path) }}"
                        class="w-full md:w-[25%] h-[80%] inline-block shrink-0 rounded-2xl shadow-md" alt="">
                @endif
                <div class="flex flex-col justify-between">
                    <div class="w-full flex justify-between items-center">
                        <div class="flex flex-col gap-1">
                            <p class="text-3xl hover:text-purple-600 font-semibold">{{ $film->title }}
                            </p>
                            <div class="flex items-center gap-1">
                                @foreach ($film->genres as $genre)
                                    <p
                                        class="capitalize cursor-default text-sm p-1 rounded-xl border border-gray-500 text-gray-500">
                                        {{ $genre->name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-lg font-semibold">Overview:</p>
                        <p class="rounded-md border text-lg font-medium shadow-md">
                            {{ $film->overview }}
                        </p>
                    </div>
                    <div>
                        <p class="text-lg font-semibold">Cast:</p>
                        <div
                            class="grid place-items-center grid-cols-2 sm:grid-cols-3 gap-[1px] bg-gray-100 rounded-md shadow-md p-2">
                            @foreach ($film->actors as $actor)
                                <div
                                    class="w-full flex items-center justify-between p-1 border-2 border-gray-500 rounded">
                                    @if ($actor->image == null)
                                        <img src="{{ asset('assets/images/profil.jpg') }}"
                                            class="w-full md:w-[20%] h-auto inline-block shrink-0 rounded-2xl"
                                            alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $actor->image->path) }}"
                                            class="w-full md:w-[20%] h-auto inline-block shrink-0 rounded-2xl"
                                            alt="">
                                    @endif
                                    <p class="text-sm">{{ $actor->name }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                @php
                    $halls_name = $film->halls->groupBy('name');
                    // dd($halls);
                @endphp
                <p class="text-2xl font-semibold my-4">Screenings:</p>
                @unless (count($halls_name) == 0)
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                            data-tabs-toggle="#default-styled-tab-content"
                            data-tabs-active-classes="text-purple-600 hover:text-purple-600 border-purple-600 dark:border-purple-500"
                            data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 border-gray-100 hover:border-gray-300 dark:border-gray-700"
                            role="tablist">
                            @foreach ($halls_name as $name => $halls)
                                <li class="me-2" role="presentation">
                                    <button class="inline-block p-4 border-b-2 rounded-t-lg"
                                        id="{{ 'day-' . $loop->index }}"
                                        data-tabs-target="{{ '#day-' . $loop->index . '-content' }}" type="button"
                                        role="tab" aria-controls="{{ 'day-' . $loop->index }}-content"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div id="default-styled-tab-content">
                        @foreach ($halls_name as $halls)
                            <div class="hidden p-4 rounded-lg shadow-md bg-gray-100"
                                id="{{ 'day-' . $loop->index . '-content' }}" role="tabpanel"
                                aria-labelledby="{{ 'day-' . $loop->index }}">
                                <ul class="flex flex-col gap-4 w-fit">
                                    @foreach ($halls as $hall)
                                        <li>
                                            <a href="{{ route('reservation.create', [$hall->pivot->date, $hall->id, $film->slug]) }}"
                                                class="capitalize cursor-default font-semibold p-2 rounded-xl border bg-purple-600 cursor-pointer border-gray-500 text-gray-200 hover:bg-purple-500">
                                                {{ $hall->pivot->date->format('l H:i:s') }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-4 border-t-2 rounded-lg bg-gray-50">
                        <p class="w-full text-center text-xl font-semibold">There are no screenings for this film.</p>
                    </div>
                @endunless
            </div>
        </div>
    </div>
    @stack('vite')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>

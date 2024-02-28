<x-dashboard-layout>
    @push('vite')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    @endpush
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
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Create New Screening
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="post" action="{{ route('screening.store') }}"
                    onsubmit="return validateForm()">
                    @csrf
                    <div class="grid gap-6 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="films" class="block mb-2 text-sm font-medium text-gray-900">Film</label>
                            <select name="film" id="films" style="width: full;"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option selected="" disabled hidden>Select film</option>
                                @unless (count($films) == 0)
                                    @foreach ($films as $film)
                                        <option value="{{ $film->id }}">{{ $film->title }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No films found</option>
                                @endunless
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="halls" class="block mb-2 text-sm font-medium text-gray-900">Hall</label>
                            <select name="hall" id="halls" style="width: full;"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option selected="" disabled hidden>Select film</option>
                                @unless (count($halls) == 0)
                                    @foreach ($halls as $hall)
                                        <option value="{{ $hall->id }}">{{ $hall->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No halls found</option>
                                @endunless
                            </select>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="date_input" class="block mb-2 text-sm font-medium text-gray-900">Date</label>
                            <input type="date" name="date" id="date_input"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Select a date" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="time_input" class="block mb-2 text-sm font-medium text-gray-900">Time</label>
                            <select name="time" id="time_input"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option selected="" disabled hidden>Screening time</option>
                                <option value="20:00:00">20:00</option>
                                <option value="23:00:00">23:00</option>>
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex justify-center items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <p>Reserve screening</p>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div id="edit-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Update Screening Date
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="edit-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="edit_form" class="p-4 md:p-5" method="post" onsubmit="return validateForm()">
                    @csrf
                    @method('patch')
                    <div class="grid gap-6 mb-4 grid-cols-2">
                        <div class="col-span-2 sm:col-span-1">
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date</label>
                            <input type="date" name="date" id="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Select a date" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="time" class="block mb-2 text-sm font-medium text-gray-900">Time</label>
                            <select id="time" name="time"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option selected="" disabled hidden>Screening time</option>
                                <option value="20:00:00">20:00</option>
                                <option value="23:00:00">23:00</option>>
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex justify-center items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <p>Save</p>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div id="delete-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Cancel Screening
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="delete-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="delete_form" class="p-4 md:p-5" method="post">
                    @csrf
                    @method('delete')
                    <div class="grid gap-6 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <p class="font-medium">Are you sure you want to cancel film screening for this hall
                                ?<br>Any tickets reserved
                                will be refunded and clients will be notified.</p>
                        </div>
                        <div class="col-span-1">
                            <button type="submit"
                                class="text-white inline-flex justify-center items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">

                                <p>Cancel Screening</p>
                            </button>
                        </div>
                        <div class="col-span-1">
                            <button data-modal-toggle="delete-modal"
                                class="text-white inline-flex justify-center items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">

                                <p>Back</p>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
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
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="button">
                Reserve a screening
            </button>
        </div>
        <div class="shadow-lg border-t-2 rounded-lg w-full p-2 mt-8">
            <table id="table" class="min-w-full divide-y divide-gray-200 stripe hover"
                style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1"
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID</th>
                        <th data-priority="2"
                            class="px-8 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Poster</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Film Title</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Hall</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date</th>
                        <th data-priority="3"
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($screenings as $screening)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $screening->id }}</div>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if ($screening->film->image == null)
                                    <img src="{{ asset('assets/images/poster.jpg') }}"
                                        class="w-[60px] h-auto inline-block shrink-0 rounded-2xl" alt="">
                                @else
                                    <img src="{{ asset('storage/') }}"
                                        class="w-[60px] h-auto inline-block shrink-0 rounded-2xl" alt="">
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $screening->film->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $screening->hall->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $screening->date }}</div>
                            </td>

                            <td class="px-8 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <button onclick="openEditModal({{ $screening->id }}, '{{ $screening->date }}')"
                                    class="text-teal-500 hover:text-teal-700">
                                    Change Date
                                </button>

                                <button onclick="openDeleteModal({{ $screening->id }})" type="submit"
                                    class="text-red-500 hover:text-red-700 ml-4">Cancel
                                    Screening</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @stack('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#table').DataTable({
                    responsive: true,
                    pageLength: 5,
                    lengthMenu: [
                        [5],
                        [5]
                    ]
                })
                .columns.adjust()
                .responsive.recalc();
        });
        $(document).ready(function() {
            $('#films').select2({
                width: '100%',
            });
        });

        $(document).ready(function() {
            $('#halls').select2({
                width: '100%',
            });
        });
    </script>
    @stack('vite')
    @vite(['resources/js/screening_edit_modal.js', 'resources/js/screening_delete_modal.js'])
</x-dashboard-layout>

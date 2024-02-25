<x-dashboard-layout>
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
    <div id="editModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-4">Edit Medicine</h2>
                    <form method="POST" id="editForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="editMedicineId" id="editMedicineId">
                        <div class="mb-4">
                            <label for="editNamemedicine" class="block text-sm font-medium text-gray-700">Name:</label>
                            <input type="text" name="editNamemedicine" id="editNamemedicine"
                                class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:outline-none focus:border-teal-500"
                                required autofocus />
                        </div>
                        <div class="mb-4">
                            <label for="editDescription"
                                class="block text-sm font-medium text-gray-700">Description:</label>
                            <textarea name="editDescription" id="editDescription"
                                class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:outline-none focus:border-teal-500" required></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-teal-600 focus:outline-none focus:bg-teal-600">Update
                                Medicine</button>
                            <button type="button" onclick="closeEditModal()"
                                class="bg-gray-300 text-gray-800 ml-4 px-4 py-2 rounded-md hover:bg-gray-400 focus:outline-none focus:bg-gray-400">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    Screenings
    @stack('scripts')
    <script></script>

</x-dashboard-layout>

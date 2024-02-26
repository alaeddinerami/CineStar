<x-dashboard-layout>
    <form action="{{ route('actor.store') }}" method="POST" enctype="multipart/form-data" class="m-5">
        @csrf
        <div class="mb-4">
            <label for="nameactor"
                class="block text-sm font-medium text-gray-700">Name:</label>
            <input type="text" name="nameactor" id="nameactor"
                class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                required autofocus />
        </div>
       
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">choose images:</label>
            <input type="file"
                class="border-2 border-gray-300 p-2 w-full  focus:outline-none focus:border-blue-500"
                name="image" :value="old('image')" multiple id="image">
        </div>
        <div class="flex items-center justify-end mt-4">
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Add
                Actor</button>
        </div>
    </form>

    <div class="bg-white border-b border-gray-200">
        <h2 class="font-semibold text-xl text-gray-800 p-6">Actors</h2>
        <div class="px-6 py-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="px-8 py-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Images</th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name</th>
                       
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($actors as $actor)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $actor->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                
                                @if($actor->image == null)
                                    <img src="{{ asset('assets/images/profil.jpg') }}"
                                    class="w-[60px] h-[60px] inline-block shrink-0 rounded-2xl"
                                    alt="">
                                @else
                                    <img src="{{ asset('storage/' . $actor->image->path) }}"
                                        class="w-[60px] h-[60px] inline-block shrink-0 rounded-2xl"
                                        alt="">
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $actor->name }}</div>
                            </td>
                           
                            
                            <td class="px-8 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <butto href="" class="text-teal-500 hover:text-teal-700"
                                    onclick="openEditModal({{ $actor->id }}, '{{ $actor->name }}')">
                                    Edit</butto>
                                <form action="{{ route('actor.delete', $actor->id) }}"
                                    method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 ml-4">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="editModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                <div
                    class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                        aria-hidden="true">&#8203;</span>
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold mb-4">Edit Medicine</h2>
                            <form action="{{ route('actor.update', '') }}" method="POST"
                                id="editForm">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="editMedicineId" id="editMedicineId">
                                <div class="mb-4">
                                    <label for="editNamemedicine"
                                        class="block text-sm font-medium text-gray-700">Name:</label>
                                    <input type="text" name="editNamemedicine"
                                        id="editNamemedicine"
                                        class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:outline-none focus:border-teal-500"
                                        required autofocus />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">choose images:</label>
                                    <input type="file"
                                        class="border-2 border-gray-300 p-2 w-full  focus:outline-none focus:border-blue-500"
                                        name="image" :value="old('image')" multiple id="image">
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
        </div>
    </div>
</div>
</x-dashboard-layout>

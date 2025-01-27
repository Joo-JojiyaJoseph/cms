<div x-data="{ open: false, action: '', wardId: null, wardName: 'demo', wardImage: null }">
    <h2 class="text-xl font-bold mb-4">Ward List</h2>

    <div class="mb-4">
        <button @click="open = true; action = 'add'; wardId = null; wardName = ''; wardImage = null"
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">
            Add Ward
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach ($wards as $ward)
            <div class="bg-white p-4 shadow rounded-lg">
                <img src="{{ $ward->image }}" alt="Ward Image" class="w-full h-32 object-cover rounded-md mb-4">
                <h3 class="text-lg font-bold">{{ $ward->name }}</h3>
                <div class="mt-4 flex justify-between">
                    <button
                        @click="open = true; action = 'edit'; wardId = {{ $ward->id }}; wardName = '{{ $ward->name }}'; wardImage = '{{ $ward->image }}'"
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</button>
                    <button @click="open = true; action = 'delete'; wardId = {{ $ward->id }};"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div x-show="open" x-cloak @click.away="open = false"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-96">
            <h2 class="text-xl font-bold mb-4">
                <template x-if="action === 'add'">
                    <span>Add Ward</span>
                </template>
                <template x-if="action === 'edit'">
                    <span>Edit Ward</span>
                </template>
                <template x-if="action === 'delete'">
                    <span>Delete Ward</span>
                </template>
            </h2>

            <form wire:submit.prevent="submitForm">
                <div x-show="action === 'add'">
                    <div class="mb-4">
                        <label for="wardName" class="block text-sm font-medium text-gray-700">Ward Name</label>
                        <input type="text" id="wardName" x-model="wardName"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="wardImage" class="block text-sm font-medium text-gray-700">Ward Image</label>
                        <input type="file" id="wardImage" x-model="wardImage"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="flex items-center justify-between">
                        <button @click="open = false" type="button"
                            class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
                        <button @click="Livewire.emit('submitForm', { wardId: null, wardName, wardImage })"
                            class="ml-2 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                            Add Ward
                        </button>
                    </div>
                </div>


                <div x-show="action === 'edit'">
                    <div class="mb-4">
                        <label for="wardName" class="block text-sm font-medium text-gray-700">Ward Name</label>
                        <input type="text" id="wardName" x-model="wardName"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="wardImage" class="block text-sm font-medium text-gray-700">Ward Image</label>
                        <input type="file" id="wardImage" x-model="wardImage"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="flex items-center justify-between">
                        <!-- Cancel Button -->
                        <button @click="open = false" type="button"
                            class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
                        <button @click="Livewire.emit('submitForm', { wardId, wardName, wardImage })"
                            class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Save Changes
                        </button>
                    </div>
                </div>
                <div x-show="action === 'delete'">
                    <div class="flex items-center justify-between">
                        <!-- Cancel Button -->
                        <button @click="open = false" type="button"
                            class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
                        <!-- Delete Button (appears when action is 'delete') -->
                        <template x-if="action === 'delete'">
                            <button @click="Livewire.emit('deleteWard', wardId)"
                                class="ml-2 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                Delete
                            </button>
                        </template>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

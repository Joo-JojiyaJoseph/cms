<div x-data="{ open: false, action: '', wardId: null, wardName: '' }">
    <h2 class="text-xl font-bold mb-4">Ward List</h2>
    <button wire:click="testMethod" class="bg-blue-500 text-white px-4 py-2 rounded-md">Test</button>

    <div class="mb-4">
        <button @click="open = true; action = 'add'; wardId = null; wardName = ''"
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">
            Add Ward
        </button>
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

            <form wire:submit="submitForm">
                <div x-show="action === 'add'">
                    <div class="mb-4">
                        <label for="wardName" class="block text-sm font-medium text-gray-700">Ward Name</label>
                        <input type="text" id="wardName" wire:model="wardName"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="wardImage" class="block text-sm font-medium text-gray-700">Ward Image</label>
                        <input type="file" id="wardImage" wire:model="wardImage"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="flex items-center justify-between">
                        <button @click="open = false" type="button"
                            class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
                        <button type="submit"
                            class="ml-2 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                            Add Ward
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

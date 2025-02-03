<div class="mt-6">
<div class="bg-gray-200 p-4 rounded shadow mt-4 flex gap-6">
    <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded">Add House</button>
    <button onclick="window.history.back()" class="bg-gray-500 text-white px-4 py-2 rounded"> Back</button>
</div>

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 my-2">{{ session('message') }}</div>
    @endif

    <div class="grid grid-cols-4 gap-4 mt-4">
        @foreach ($houses as $house)
            <div class="bg-gray-100 p-4 rounded shadow">
                 <h2 class="text-xl font-semibold cursor-pointer" wire:click="goToFamilyMemberDashboard({{ $house->id }})">{{ $house->house_name }}</h2>
                <p>Members: {{ $house->number_of_members }}</p>
                <button wire:click="editHouse({{ $house->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded mt-2">Edit</button>
                <button wire:click="deleteHouse({{ $house->id }})" class="bg-red-500 text-white px-2 py-1 rounded mt-2">Delete</button>
            </div>
        @endforeach
    </div>

    @if($isOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
            <div class="bg-white p-5 rounded shadow-lg w-1/3">
                <h2 class="text-lg mb-4">{{ $house_id ? 'Edit House' : 'Add House' }}</h2>

                <input type="text" wire:model="house_name" placeholder="House Name" class="border px-2 py-1 w-full mb-3">
                <input type="number" wire:model="number_of_members" placeholder="Number of Members" class="border px-2 py-1 w-full mb-3">

                <div class="flex justify-end">
                    <button wire:click="saveHouse" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Save</button>
                    <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                </div>
            </div>
        </div>
    @endif
</div>

<div class="container mx-auto p-4">
    <div class="bg-gray-200 p-4 rounded shadow mt-4 flex gap-6">
    <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded">Add Ward</button>
    <button wire:click="openModalWardLeader" class="bg-blue-500 text-white px-4 py-2 rounded">Add Ward Leader</button>
    <button onclick="window.history.back()" class="bg-gray-500 text-white px-4 py-2 rounded"> Back</button>
</div>
    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 my-2">{{ session('message') }}</div>
    @endif

    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr>
                <th class="border px-4 py-2">Ward Name</th>
                <th class="border px-4 py-2">Image</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wards as $ward)
            <tr class="cursor-pointer hover:bg-gray-200" wire:click="goToWardDashboard({{ $ward->id }})">
                    <td class="border px-4 py-2">{{ $ward->name }}</td>
                    <td class="border px-4 py-2">
                        @if ($ward->image)
                            <img src="{{ asset('storage/'.$ward->image) }}" width="50">
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <button wire:click="editWard({{ $ward->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button wire:click="deleteWard({{ $ward->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    @if($isOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
            <div class="bg-white p-5 rounded shadow-lg w-1/3">
                <h2 class="text-lg mb-4">{{ $ward_id ? 'Edit Ward' : 'Add Ward' }}</h2>

                <input type="text" wire:model="name" placeholder="Ward Name" class="border px-2 py-1 w-full mb-3">

                @if ($image)
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/'.$image) }}" width="50" class="mb-2">
                @endif

                <input type="file" wire:model="newImage" class="border px-2 py-1 w-full mb-3">

                <div class="flex justify-end">
                    <button wire:click="saveWard" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Save</button>
                    <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                </div>
            </div>
        </div>
    @endif

      <!-- Modal for ward leader -->
      @if($isOpenWardLeader)
      <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
          <div class="bg-white p-5 rounded shadow-lg w-1/3">
              <h2 class="text-lg mb-4">{{ $ward_id ? 'Edit Ward' : 'Add Ward' }}</h2>

              <input type="text" wire:model="name" placeholder="Ward Leader" class="border px-2 py-1 w-full mb-3">


              <div class="flex justify-end">
                  <button wire:click="saveWardLeader" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Save</button>
                  <button wire:click="closeModalLeader" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
              </div>
          </div>
      </div>
  @endif
</div>

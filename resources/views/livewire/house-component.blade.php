<div class="mt-6">
    <div class="container mx-auto p-4 mb-6">
        <h1 class="text-2xl font-bold">Dashboard for {{ $ward->name }}</h1>

        <div class="grid xl:grid-cols-3 grid-cols-1 gap-4 mt-4">
            <div class="bg-blue-200 p-4 rounded shadow">
                <h2 class="text-xl font-semibold">Total Houses</h2>
                <p class="text-2xl">{{ $ward->houses->count() }}</p>
            </div>

            <div class="bg-green-200 p-4 rounded shadow">
                <h2 class="text-xl font-semibold">Total Members</h2>
                <p class="text-2xl">{{ $ward->houses->sum('number_of_members') }}</p>
            </div>
            @if ($wardleader_name != null)
                <div class="bg-green-500 p-4 rounded shadow">
                    <h2 class="text-xl font-semibold">Ward Leader</h2>
                    <p class="text-2xl">{{ $wardleader_name->full_name }} </p>
                </div>
            @endif
        </div>
        <div class="bg-gray-200 p-4 rounded shadow mt-4 flex gap-6">
            <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded">Add Family</button>
            @if (Auth::check() && Auth::user()->role === 'admin')
                <button wire:click="openModalWardLeader" class="bg-blue-500 text-white px-4 py-2 rounded">Add Ward
                    Leader</button>
                <button onclick="window.history.back()" class="bg-gray-500 text-white px-4 py-2 rounded"> Back</button>
            @endif
        </div>

        @if (session()->has('message'))
            <div class="bg-green-200 text-green-800 p-2 my-2">{{ session('message') }}</div>
        @endif

        <div class="grid xl:grid-cols-3 grid-cols-1  gap-4 mt-4">
            @foreach ($houses as $house)
                <div class="bg-gray-100 p-4 rounded shadow" >
                    <h2 class="text-xl font-semibold cursor-pointer" 
                wire:click="goToFamilyMemberDashboard({{ $house->id }})">{{ $house->house_name }} - {{ $house->head }}</h2>
                    <p><strong>Members:</strong> {{ $house->number_of_members }}</p>
                    <p><strong>Address: </strong>{{ $house->address }}</p>
                    <p><strong>About:</strong> {{ $house->about }}</p>
                    <p><strong>Resident since:</strong>
                        {{$house->member_of_parish_since ? \Carbon\Carbon::parse($house->member_of_parish_since)->format('d/m/Y'):'' }}</p>
                    <button wire:click="editHouse({{ $house->id }})"
                        class="bg-yellow-500 text-white px-2 py-1 rounded mt-2">Edit</button>
                    <button wire:click="deleteHouse({{ $house->id }})"
                        class="bg-red-500 text-white px-2 py-1 rounded mt-2">Delete</button>
                </div>
            @endforeach
        </div>

        @if ($isOpen)
            <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
                <div class="bg-white p-5 rounded shadow-lg">
                    <h2 class="text-lg mb-4">{{ $house_id ? 'Edit Family' : 'Add Family' }}</h2>

                    <input type="text" wire:model="house_name" placeholder="House Name"
                        class="border px-2 py-1 w-full mb-3">
                        <input type="text" wire:model="head" placeholder="Head Of Family"
                        class="border px-2 py-1 w-full mb-3">
                    <input type="number" wire:model="number_of_members" placeholder="Number of Members"
                        class="border px-2 py-1 w-full mb-3">
                        <textarea wire:model="address" placeholder="Address"
                        class="border px-2 py-1 w-full mb-3"></textarea>
                         <textarea wire:model="about" placeholder="About"
                        class="border px-2 py-1 w-full mb-3"></textarea>

                        <label class="flex-1 min-w-[250px]">
                            Resident since
                            <input type="date" wire:model="member_of_parish_since" class="border px-2 py-1 w-full">
                        </label>

                    <div class="flex justify-end mt-2">
                        <button wire:click="saveHouse"
                            class="bg-blue-500 text-white px-4 py-2 rounded mr-2 ">Save</button>
                        <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    </div>
                </div>
            </div>
        @endif
        <!-- Modal for ward leader -->
        @if ($isOpenWardLeader)
            <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
                <div class="bg-white p-5 rounded shadow-lg">
                    <h2 class="text-lg mb-4">{{ $ward_id ? 'Edit Ward Leader' : 'Add Ward leader' }}</h2>
                    <div class="form-group flex flex-col mb-3">
                        <select wire:model.live="wardleader" class="form-control">
                            <option value="">All Families</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input wire:model.live="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input wire:model.live="password" id="password" class="block mt-1 w-full"
                            type="password" name="password" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <!-- <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input wire:model.live="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div> -->

                    {{-- </form> --}}
                    <div class="flex justify-end mt-2">
                        <button wire:click="saveWardLeader"
                            class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Save</button>
                        <button wire:click="closeModalLeader"
                            class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    </div>
                </div>
            </div>
        @endif
    </div>

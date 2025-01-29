<div class="container mx-auto p-4">
    <div class="bg-gray-200 p-4 rounded shadow mt-4">
        <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded">Add Family Member</button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 my-2">{{ session('message') }}</div>
    @endif

    <div class="grid grid-cols-2 gap-4 mt-4">
        @foreach ($family_members as $member)
            <div class="bg-gray-100 p-4 rounded shadow">
                <h2 class="text-xl font-semibold">{{ $member->full_name }}</h2>
                <p>Contact: {{ $member->primary_contact }} | {{ $member->secondary_contact }}</p>
                <p>Whatsapp: {{ $member->whatsapp_number }} | Email: {{ $member->email }}</p>
                <p>Birth: {{ $member->dob }} | Blood Group: {{ $member->blood_group }}</p>
                <p>Marital Status: {{ $member->marital_status }} | Spouse: {{ $member->marriage_date }}</p>
                <p>Job: {{ $member->job }} | Location: {{ $member->current_job_location }}</p>
                <p>Permanent Address: {{ $member->permanent_address }}</p>
                <p>Present Address: {{ $member->present_address }}</p>
                <p>Baptism Name: {{ $member->baptism_name }}</p>
                <button wire:click="editFamilyMember({{ $member->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded mt-2">Edit</button>
                <button wire:click="deleteFamilyMember({{ $member->id }})" class="bg-red-500 text-white px-2 py-1 rounded mt-2">Delete</button>
            </div>
        @endforeach
    </div>

    @if($isOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
            <div class="bg-white p-5 rounded shadow-lg w-1/3">
                <h2 class="text-lg mb-4">{{ $family_member_id ? 'Edit Family Member' : 'Add Family Member' }}</h2>

                <input type="text" wire:model="full_name" placeholder="Full Name*" class="border px-2 py-1 w-full mb-3">
                <input type="text" wire:model="primary_contact" placeholder="Primary Contact*" class="border px-2 py-1 w-full mb-3">
                <input type="text" wire:model="secondary_contact" placeholder="Secondary Contact" class="border px-2 py-1 w-full mb-3">
                <input type="text" wire:model="whatsapp_number" placeholder="Whatsapp Number" class="border px-2 py-1 w-full mb-3">
                <input type="email" wire:model="email" placeholder="Email" class="border px-2 py-1 w-full mb-3">
                <input type="date" wire:model="dob" placeholder="Date of Birth*" class="border px-2 py-1 w-full mb-3">
                <input type="text" wire:model="blood_group" placeholder="Blood Group*" class="border px-2 py-1 w-full mb-3">

                <label>
                    <select wire:model="marital_status" class="border px-2 py-1 w-full mb-3">
                        <option value="">Marital Status*</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                    </select>
                </label>
                @if($marital_status === 'Married')
                    <input type="date" wire:model="marriage_date" placeholder="Marriage Date" class="border px-2 py-1 w-full mb-3">
                @endif

                <input type="text" wire:model="job" placeholder="Job*" class="border px-2 py-1 w-full mb-3">
                <input type="text" wire:model="current_job_location" placeholder="Current Job Location*" class="border px-2 py-1 w-full mb-3">
                <input type="text" wire:model="permanent_address" placeholder="Permanent Address*" class="border px-2 py-1 w-full mb-3">

                <label>
                    <input type="checkbox" wire:model="same_as_permanent"> Same as Permanent Address
                </label>
                <input type="text" wire:model="present_address" placeholder="Present Address*" class="border px-2 py-1 w-full mb-3">

                <input type="text" wire:model="baptism_name" placeholder="Baptism Name" class="border px-2 py-1 w-full mb-3">

                <div class="flex justify-end">
                    <button wire:click="saveFamilyMember" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Save</button>
                    <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                </div>
            </div>
        </div>
    @endif
</div>

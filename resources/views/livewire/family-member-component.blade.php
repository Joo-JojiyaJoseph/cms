<div class="container mx-auto p-4">
    <div class="bg-gray-200 p-4 rounded shadow mt-4 flex gap-6">
        <button wire:click="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded">Add Family Member</button>
        <button onclick="window.history.back()" class="bg-gray-500 text-white px-4 py-2 rounded"> Back</button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 my-2">{{ session('message') }}</div>
    @endif
    <div class="grid xl:grid-cols-3 grid-cols-1 gap-4 mt-4">
        @foreach ($family_members as $member)
            <div class="bg-gray-100 p-4 rounded shadow ">
                <div class="text-center">
            @if ($member->image)
                            <img src="{{ asset('storage/' . $member->image) }}" width="50">
              @endif
</div>
                <h2 class="text-xl font-semibold">{{ $member->full_name }} |{{ $member->gender }} </h2>
                <p><strong>Relationship:</strong> {{ $member->relationship }}</p>
                <p><strong>Primary Contact:</strong> {{ $member->primary_contact }}</p>
                <!-- <p><strong>Whatsapp:</strong> {{ $member->whatsapp_number }}</p> -->
                <p><strong>Email:</strong> {{ $member->email }}</p>
                <p><strong>Birth:</strong> {{ $member->dob }} | <strong>Blood Group:</strong>
                    {{ $member->blood_group }}</p>
                <p><strong>Marital Status:</strong> {{ $member->marital_status }}
                    <!-- | <strong>Spouse:</strong> {{ $member->spouse ?? 'N/A' }} -->
                </p>
                <p><strong>Job:</strong> {{ $member->job }} | <strong>Location:</strong>
                    {{ $member->current_job_location }}</p>
                <p><strong>Permanent Address:</strong> {{ $member->permanent_address }}</p>
                <p><strong>Present Address:</strong> {{ $member->present_address }}</p>
                <p><strong>Baptism Name:</strong> {{ $member->baptism_name }} <br/> <strong>Baptism
                        Date:</strong>{{ $member->baptism_date }}</p>
                <p><strong>Confirmation Date:</strong> {{ $member->confirmation_date }} </p>
                <p><strong>Member of Parish Since:</strong> {{ $member->member_since }}</p>
                <button wire:click="editFamilyMember({{ $member->id }})"
                    class="bg-yellow-500 text-white px-2 py-1 rounded mt-2">Edit</button>
                <button wire:click="deleteFamilyMember({{ $member->id }})"
                    class="bg-red-500 text-white px-2 py-1 rounded mt-2">Delete</button>
            </div>
        @endforeach
    </div>
    {{ $marital_status }}

    @if ($isOpen)
    <div wire:key="modal-{{ $family_member_id ?? 'new' }}"
    class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 p-4">
    <div class="bg-white p-5 rounded shadow-lg w-full sm:w-3/4 h-full sm:h-auto overflow-y-auto">

                <h2 class="text-lg mb-4">{{ $family_member_id ? 'Edit Family Member' : 'Add Family Member' }}</h2>
                <div class="flex gap-6 justify-between">


    <div class="flex flex-wrap gap-4">
        <input type="file" wire:model="newImage" class="border px-2 py-1 mb-3 flex-1 min-w-[250px]">
        <input type="text" wire:model="full_name" placeholder="Full Name*" class="border px-2 py-1 mb-3 flex-1 min-w-[250px] required">

        <label class="flex-1 min-w-[250px]">
            <select wire:model.live="gender" class="border px-2 py-1 mb-3 w-full required">
                <option value="">Select Gender*</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </label>
        <label class="flex-1 min-w-[250px]">
            <select wire:model.live="relationship" class="border px-2 py-1 mb-3 w-full required">
                <option value="">Select Relationship*</option>
                <option value="Own">Own</option>
                <option value="Father">Father</option>
                <option value="Mother">Mother</option>
                <option value="Grand Father">Grand Father</option>
                <option value="Grand Mother">Grand Mother</option>
                <option value="Wife">Wife</option>
                <option value="Husband">Husband</option>
                <option value="Sister">Sister</option>
                <option value="Brother">Brother</option>
                <option value="Daughter">Daughter</option>
                <option value="Son">Son</option>
            </select>
        </label>
    </div>
</div>

<div class="flex flex-wrap gap-6  mb-3 ">
    <input type="text" wire:model="primary_contact" placeholder="Primary Contact*" class="border px-2 py-1 flex-1 min-w-[250px] required">
    <input type="text" wire:model="secondary_contact" placeholder="Secondary Contact" class="border px-2 py-1 flex-1 min-w-[250px]">
</div>

<div class="flex flex-wrap gap-6  mb-3 ">
    <input type="email" wire:model="email" placeholder="Email" class="border px-2 py-1 flex-1 min-w-[250px]">
    <label class="flex-1 min-w-[250px]">
        Date Of Birth
        <input type="date" wire:model="dob" class="border px-2 py-1 w-full required">
    </label>
    <select wire:model="blood_group" class="border px-2 py-1 flex-1 min-w-[250px]">
        <option value="">Select Blood Group*</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
    </select>
</div>

<div class="flex flex-wrap gap-6  mb-3 ">
    <label class="flex-1 min-w-[250px]">
        Marriage Status
        <select wire:model.live="marital_status" class="border px-2 py-1 w-full required">
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Widowed">Widowed</option>
            <option value="Divorced">Divorced</option>
        </select>
    </label>
    @if ($marital_status === 'Married')
        <label class="flex-1 min-w-[250px]">
            Marriage Date
            <input type="date" wire:model="marriage_date" class="border px-2 py-1 w-full">
        </label>

        <label class="flex-1 min-w-[250px]">
            Spouse
            <select wire:model="spouse" class="border px-2 py-1 w-full">
                <option value="">Select</option>
                @foreach ($family_members as $member)
                    <option value="{{ $member->full_name }}">{{ $member->full_name }}</option>
                @endforeach
            </select>
        </label>
    @endif

    <label class="flex-1 min-w-[250px]">
        Job
        <select wire:model.live="job" class="border px-2 py-1 w-full">
            <option value="">Select Job*</option>
            <option value="Farmer">Farmer</option>
            <option value="House Wife">House Wife</option>
            <option value="Business">Business</option>
            <option value="Shop">Shop</option>
            <option value="Priest">Priest</option>
            <option value="Nun">Nun</option>
            <option value="IT Professional">IT Professional</option>
            <option value="Accountant">Accountant</option>
            <option value="Doctor">Doctor</option>
            <option value="Electrician">Electrician</option>
            <option value="Mechanic">Mechanic</option>
            <option value="Fitter">Fitter</option>
            <option value="Plumber">Plumber</option>
            <option value="Driver">Driver</option>
            <option value="Gov. Job">Gov. Job</option>
        </select>
    </label>
</div>

<div class="flex flex-wrap gap-6  mb-3 ">
    <textarea wire:model="current_job_location" placeholder="Current Job Location*" class="border px-2 py-1 flex-1 min-w-[250px]"></textarea>
    <textarea wire:model="permanent_address" placeholder="Permanent Address*" class="border px-2 py-1 flex-1 min-w-[250px]"></textarea>
    <textarea wire:model="present_address" placeholder="Present Address*" class="border px-2 py-1 flex-1 min-w-[250px]"></textarea>
</div>

<div class="flex flex-wrap gap-6  mb-3 ">
    <label class="flex-1 min-w-[250px]">
        Baptism Name
        <input type="text" wire:model="baptism_name" placeholder="Baptism Name" class="border px-2 py-1 w-full required">
    </label>
    <label class="flex-1 min-w-[250px]">
        Baptism Date
        <input type="date" wire:model="baptism_date" class="border px-2 py-1 w-full">
    </label>
</div>

<div class="flex flex-wrap gap-6  mb-3 ">
    <label class="flex-1 min-w-[250px]">
        Confirmation Date
        <input type="date" wire:model="confirmation_date" class="border px-2 py-1 w-full">
    </label>
    <label class="flex-1 min-w-[250px]">
        Member of Parish Since
        <input type="date" wire:model="member_of_parish_since" class="border px-2 py-1 w-full">
    </label>
</div>
                <div class="flex justify-end">
                    <button wire:click="saveFamilyMember"
                        class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Save</button>
                    <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                </div>
            </div>
        </div>
    @endif
</div>

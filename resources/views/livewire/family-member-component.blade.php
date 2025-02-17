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
        
            <div class="bg-gray-100 p-4 rounded shadow border border-black">
                <div class="text-center mb-4">
                    <div class="flex">
                    @if ($member->image)
                        <img src="{{ asset('storage/' . $member->image) }}" width="80" class="rounded-full">
                    @endif
                    <div >
                    <p><strong>{{ $houses->address }}</strong></p>
                    <p><strong>About:</strong> {{ $houses->about }}</p>
                    <p><strong>Resident since:</strong>
                        {{$houses->member_of_parish_since ? \Carbon\Carbon::parse($houses->member_of_parish_since)->format('d/m/Y'):'' }}</p>
                        </div>
                        </div>
                </div>

                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2 text-left">Field</th>
                            <th class="p-2 text-left">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 font-semibold">Full Name</td>
                            <td class="p-2">{{ $member->full_name }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Sex</td>
                            <td class="p-2">{{ $member->gender }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Relationship</td>
                            <td class="p-2">{{ $member->relationship }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Primary Contact (Whatsapp)</td>
                            <td class="p-2">{{ $member->primary_contact }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Secondary Contact</td>
                            <td class="p-2">{{ $member->secondary_contact }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Father's Name</td>
                            <td class="p-2">{{ $member->father }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Mother's Name</td>
                            <td class="p-2">{{ $member->mother }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Email</td>
                            <td class="p-2">{{ $member->email }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Birth</td>
                            <td class="p-2">{{ \Carbon\Carbon::parse($member->dob)->format('d/m/Y') }} | (Age: {{ \Carbon\Carbon::parse($member->dob)->age }} years)</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Blood Group</td>
                            <td class="p-2">{{ $member->blood_group }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Marital Status</td>
                            <td class="p-2">{{ $member->marital_status }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Mariage Date</td>
                            <td class="p-2">{{ $member->marriage_date ? \Carbon\Carbon::parse($member->marriage_date)->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Spouse Name</td>
                            <td class="p-2">{{ $member->spouse ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Job</td>
                            <td class="p-2">{{ $member->job }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Job Location</td>
                            <td class="p-2">{{ $member->current_job_location }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Present Address</td>
                            <td class="p-2">{{ $member->present_address }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Baptism Name</td>
                            <td class="p-2">{{ $member->baptism_name }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Baptism Date</td>
                            <td class="p-2">{{ $member->baptism_date ? \Carbon\Carbon::parse($member->baptism_date)->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-semibold">Confirmation Date</td>
                            <td class="p-2">{{ $member->confirmation_date ? \Carbon\Carbon::parse($member->confirmation_date)->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-4">
                    <button wire:click="editFamilyMember({{ $member->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded mt-2">Edit</button>
                    <button wire:click="deleteFamilyMember({{ $member->id }})" class="bg-red-500 text-white px-2 py-1 rounded mt-2">Delete</button>
                </div>
            </div>

        @endforeach
    </div>


    @if ($isOpen)
        <div wire:key="modal-{{ $family_member_id ?? 'new' }}"
            class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 p-4">
            <div class="bg-white p-5 rounded shadow-lg w-full sm:w-3/4 h-full sm:h-auto overflow-y-auto">

                <h2 class="text-lg mb-4">{{ $family_member_id ? 'Edit Family Member' : 'Add Family Member' }}</h2>
                <div class="flex gap-6 justify-between">


                    <div class="flex flex-wrap gap-4">
                        <input type="file" wire:model="newImage" class="border px-2 py-1 mb-3 flex-1 min-w-[250px]" accept="image/*" capture="camera">
                        <div class="flex-col">
                            <input type="text" wire:model="full_name" placeholder="Full Name*"
                                class="border px-2 py-1 mb-3 flex-1 min-w-[250px] required">
                            @error('full_name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <label class="flex-1 min-w-[250px]">
                            <select wire:model="father" class="border px-2 py-1 w-full">
                                <option value="">Select Father Name</option>
                                @foreach ($family_members as $member)
                                    <option value="{{ $member->full_name }}">{{ $member->full_name }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="flex-1 min-w-[250px]">
                            <select wire:model="mother" class="border px-2 py-1 w-full">
                                <option value="">Select Mother Name</option>
                                @foreach ($family_members as $member)
                                    <option value="{{ $member->full_name }}">{{ $member->full_name }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label class="flex-1 min-w-[250px]">
                            <select wire:model.live="gender" class="border px-2 py-1 mb-3 w-full required">
                                <option value="">Select Gender*</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('gender')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </label>
                        <label class="flex-1 min-w-[250px]">
                            <select wire:model.live="relationship" class="border px-2 py-1 mb-3 w-full required">
                                <option value="">Select Relationship*</option>
                                <option value="Head of House">Head of House</option>
                                <option value="">Select Relationship*</option>
                <option value="Head of House">Head of the Family</option>
    <option value="Mother">Mother</option>
    <option value="Father">Father</option>
    <option value="Daughter">Daughter</option>
    <option value="Son">Son</option>
    <option value="Sibling">Sibling</option>
    <option value="Sister">Sister</option>
    <option value="Brother">Brother</option>
    <option value="Wife">Wife</option>
    <option value="Husband">Husband</option>
    <option value="Elder Brother/Sister">Elder Brother/Sister</option>
    <option value="Younger Brother/Sister">Younger Brother/Sister</option>
    <option value="Grandmother">Grandmother</option>
    <option value="Grandfather">Grandfather</option>
    <option value="Great Grandfather">Great Grandfather</option>
    <option value="Great Grandmother">Great Grandmother</option>
    <option value="Granddaughter">Granddaughter</option>
    <option value="Grandson">Grandson</option>
    <option value="Nephew">Nephew</option>
    <option value="Niece">Niece</option>
    <option value="Aunt">Aunt</option>
    <option value="Uncle">Uncle</option>
    <option value="Mother-in-law">Mother-in-law</option>
    <option value="Father-in-law">Father-in-law</option>
    <option value="Son-in-law">Son-in-law</option>
    <option value="Daughter-in-law">Daughter-in-law</option>
                            </select>
                            @error('relationship')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>

                <div class="flex flex-wrap gap-6  mb-3 ">
                    <input type="text" wire:model="primary_contact" placeholder="Primary Contact (WhatsApp)*"
                        class="border px-2 py-1 flex-1 min-w-[250px] required">
                    @error('primary_contact')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    <input type="text" wire:model="secondary_contact" placeholder="Secondary Contact"
                        class="border px-2 py-1 flex-1 min-w-[250px]">
                </div>

                <div class="flex flex-wrap gap-6  mb-3 ">
                    <input type="email" wire:model="email" placeholder="Email"
                        class="border px-2 py-1 flex-1 min-w-[250px]">
                    <label class="flex-1 min-w-[250px]">
                        Date Of Birth
                        <input type="date" wire:model="dob" class="border px-2 py-1 w-full required">
                        @error('dob')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
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
                        <option value="Don't know">Don't know</option>
                    </select>
                    @error('blood_group')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-wrap gap-6  mb-3 ">
                    <label class="flex-1 min-w-[250px]">
                        Marriage Status
                        <select wire:model.live="marital_status" class="border px-2 py-1 w-full required">
                            <option value="Select">Select</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>  
                                <option value="Widow">Widow</option>
            <option value="widower">widower</option>
            <option value="Divorced">Divorced</option>
                        </select>
                        @error('marital_status')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
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
            <option value="Accountant">Accountant</option>
<option value="Advocate">Advocate</option>
<option value="Airhostess">Airhostess</option>
<option value="Aluminium Fabrication">Aluminium Fabrication</option>
<option value="Architect">Architect</option>
<option value="Auditor">Auditor</option>
<option value="Business">Business</option>
<option value="Carpenter">Carpenter</option>
<option value="Chef">Chef</option>
<option value="Construction">Construction</option>
<option value="Doctor">Doctor</option>
<option value="Driver">Driver</option>
<option value="Electrician">Electrician</option>
<option value="Entrepreneur">Entrepreneur</option>
<option value="Engineer">Engineer</option>
<option value="Farmer">Farmer</option>
<option value="Fitter">Fitter</option>
<option value="Frontend Developer">Frontend Developer</option>
<option value="Graphic Designer">Graphic Designer</option>
<option value="Govt. Employee">Govt. Employee</option>
<option value="Hotel Management">Hotel Management</option>
<option value="Housewife">Housewife</option>
<option value="Human Resource (HR)">Human Resource (HR)</option>
<option value="IT Professional">IT Professional</option>
<option value="Lab Technician">Lab Technician</option>
<option value="Mechanic">Mechanic</option>
<option value="Mechanic">Medical Professional</option>
<option value="Marchant">Merchant</option>
<option value="Nurse">Nurse</option>
<option value="Nun">Nun</option>
<option value="Painter">Painter</option>
<option value="Pharmacist">Pharmacist</option>
<option value="Psychologist">Psychologist</option>
<option value="Plumber">Plumber</option>
<option value="Priest">Priest</option>
<option value="Real Estate">Real Estate</option>
<option value="Receptionist">Receptionist</option>
<option value="Retired">Retired</option>
<option value="Sales Executive">Sales Executive</option>
<option value="Security">Security</option>
<option value="Student">Student</option>
<option value="Software Developer">Software Developer</option>
<option value="Student Counsellor">Student Counsellor</option>
<option value="Stitching/Tailor">Stitching/Tailor</option>
<option value="Supervisor">Supervisor</option>
<option value="Tax Consultant">Tax Consultant</option>
<option value="Teacher/Professor">Teacher/Professor</option>
<option value="Telemarketing">Telemarketing</option>
<option value="UI/UX Designer">UI/UX Designer</option>
<option value="Other">Other</option>
                        </select>
                    </label>
                </div>

                <div class="flex flex-wrap gap-6  mb-3 ">
                    <textarea wire:model="current_job_location" placeholder="Current Job Location*"
                        class="border px-2 py-1 flex-1 min-w-[250px]"></textarea>
                    <textarea wire:model="present_address" placeholder="Present Address*" class="border px-2 py-1 flex-1 min-w-[250px]"></textarea>
                </div>

                <div class="flex flex-wrap gap-6  mb-3 ">
                    <label class="flex-1 min-w-[250px]">
                        Baptism Name
                        <input type="text" wire:model="baptism_name" placeholder="Baptism Name"
                            class="border px-2 py-1 w-full required">
                        @error('baptism_name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </label>
                    <label class="flex-1 min-w-[250px]">
                        Baptism Date
                        <input type="date" wire:model.live="baptism_date" class="border px-2 py-1 w-full">
                    </label>
                </div>

                <div class="flex flex-wrap gap-6  mb-3 ">
                    <label class="flex-1 min-w-[250px]">
                        Confirmation Date
                        <input type="date" wire:model="confirmation_date" class="border px-2 py-1 w-full">
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

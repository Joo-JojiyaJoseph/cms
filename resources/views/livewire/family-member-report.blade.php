<div>
    <div class="flex gap-5 justify-end">
        <div class="form-group flex flex-col">
            <label for="wardFilter">Filter by Ward</label>
            <select wire:model.live="wardFilter" class="form-control">
                <option value="">All Wards</option>
                @foreach($wards as $ward)
                    <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group flex flex-col">
            <label for="familyFilter">Filter by Family</label>
            <select wire:model.live="familyFilter" class="form-control">
                <option value="">All Families</option>
                @foreach($families as $family)
                    <option value="{{ $family->id }}">{{ $family->house_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group flex flex-col">
            <label for="memberFilter">Filter by Member Name</label>
            <input type="text" wire:model.live="memberFilter" class="form-control" placeholder="Search Member">
        </div>

        <button wire:click="export" class="btn btn-primary">Export to Excel</button>
    </div>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Member Name</th>
                <th>Relationship</th>
                <th>Primary Contact</th>
                <th>Secondary Contact</th>
                <th>WhatsApp Number</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Blood Group</th>
                <th>Marital Status</th>
                <th>Marriage Date</th>
                <th>Job</th>
                <th>Current Job Location</th>
                <th>Present Address</th>
                <th>Baptism Name</th>
                <th>Baptism Date</th>
                <th>Confirmation Date</th>
                <th>Gender</th>
                <th>Spouse</th>
                <th>Father</th>
                <th>Mother</th>
                <th>Family</th>
                <th>Ward</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    <td>{{ $member->full_name }}</td>
                    <td>{{ $member->relationship }}</td>
                    <td>{{ $member->primary_contact }}</td>
                    <td>{{ $member->secondary_contact }}</td>
                    <td>{{ $member->whatsapp_number }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->dob }}</td>
                    <td>{{ $member->blood_group }}</td>
                    <td>{{ $member->marital_status }}</td>
                    <td>{{ $member->marriage_date ?? 'N/A' }}</td>
                    <td>{{ $member->job }}</td>
                    <td>{{ $member->current_job_location }}</td>
                    <td>{{ $member->present_address }}</td>
                    <td>{{ $member->baptism_name }}</td>
                    <td>{{ $member->baptism_date }}</td>
                    <td>{{ $member->confirmation_date }}</td>
                    <td>{{ $member->gender }}</td>
                    <td>{{ $member->spouse }}</td>
                    <td>{{ $member->father }}</td>
                    <td>{{ $member->mother }}</td>
                    <td>{{ $member->family }}</td>
                    <td>{{ $member->ward }}</td>
                    <td>
                        @if($member->image)
                            <img src="{{ asset('storage/'.$member->image) }}" alt="Member Image" width="50">
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $members->links() }}
</div>

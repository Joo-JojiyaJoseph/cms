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
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            @dd($members);
            @foreach($members as $member)
                <tr>
                    <td>{{ $member->full_name }}</td>
                    <td>{{ $member->family->name ?? 'N/A' }}</td>
                    <td>{{ $member->family->ward->name ?? 'N/A' }}</td>
                    <td>{{ $member->contact }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $members->links() }}
</div>


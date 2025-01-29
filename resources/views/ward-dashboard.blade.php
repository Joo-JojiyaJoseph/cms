<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold">Dashboard for {{ $ward->name }}</h1>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div class="bg-blue-200 p-4 rounded shadow">
                <h2 class="text-xl font-semibold">Total Houses</h2>
                <p class="text-2xl">{{ $ward->houses->count() }}</p>
            </div>

            <div class="bg-green-200 p-4 rounded shadow">
                <h2 class="text-xl font-semibold">Total Members</h2>
                <p class="text-2xl">{{ $ward->houses->sum('number_of_members') }}</p>
            </div>
        </div>

        <livewire:house-component :ward_id="$ward->id" />

    </div>
</x-app-layout>

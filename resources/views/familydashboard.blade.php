<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold">Dashboard for -  {{ $house->house_name }}-{{ $house->head }} </h1>

        <div class="grid grid-cols-2 gap-4 mt-4">
           
        </div>

        <livewire:family-member-component :house_id="$house->id" />

    </div>
</x-app-layout>

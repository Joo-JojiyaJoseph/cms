@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold">Family Members for House: {{ $house->house_name }}</h1>

        <div class="bg-gray-200 p-4 rounded shadow mt-4">
            <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded">Add Family Member</button>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-200 text-green-800 p-2 my-2">{{ session('message') }}</div>
        @endif

        <div class="grid grid-cols-2 gap-4 mt-4">
            @foreach ($familyMembers as $member)
                <div class="bg-gray-100 p-4 rounded shadow">
                    <h2 class="text-xl font-semibold">{{ $member->name }} ({{ $member->relation }})</h2>
                    <p>Age: {{ $member->age }} | Blood Group: {{ $member->blood_group }}</p>
                    <p>Married: {{ $member->married ? 'Yes' : 'No' }} | Spouse: {{ $member->spouse }}</p>
                    <p>Job: {{ $member->job }} | Location: {{ $member->job_location }}</p>
                    <p>Contact: {{ $member->contact_no_1 }} | {{ $member->contact_no_2 }}</p>
                    <button wire:click="editFamilyMember({{ $member->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded mt-2">Edit</button>
                    <button wire:click="deleteFamilyMember({{ $member->id }})" class="bg-red-500 text-white px-2 py-1 rounded mt-2">Delete</button>
                </div>
            @endforeach
        </div>

        @if($isOpen)
            <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
                <div class="bg-white p-5 rounded shadow-lg w-1/3">
                    <h2 class="text-lg mb-4">{{ $family_member_id ? 'Edit Family Member' : 'Add Family Member' }}</h2>

                    <input type="text" wire:model="name" placeholder="Name" class="border px-2 py-1 w-full mb-3">
                    <input type="date" wire:model="dob" placeholder="Date of Birth" class="border px-2 py-1 w-full mb-3">
                    <input type="text" wire:model="blood_group" placeholder="Blood Group" class="border px-2 py-1 w-full mb-3">
                    <label>
                        <input type="checkbox" wire:model="married"> Married
                    </label>
                    @if($married)
                        <input type="date" wire:model="marriage_date" placeholder="Marriage Date" class="border px-2 py-1 w-full mb-3">
                        <input type="text" wire:model="spouse" placeholder="Spouse Name" class="border px-2 py-1 w-full mb-3">
                    @endif
                    <input type="text" wire:model="job" placeholder="Job" class="border px-2 py-1 w-full mb-3">
                    <input type="text" wire:model="place" placeholder="Place" class="border px-2 py-1 w-full mb-3">
                    <input type="text" wire:model="address" placeholder="Address" class="border px-2 py-1 w-full mb-3">
                    <input type="text" wire:model="job_location" placeholder="Job Location" class="border px-2 py-1 w-full mb-3">
                    <input type="text" wire:model="contact_no_1" placeholder="Contact No 1" class="border px-2 py-1 w-full mb-3">
                    <input type="text" wire:model="contact_no_2" placeholder="Contact No 2" class="border px-2 py-1 w-full mb-3">
                    <input type="email" wire:model="email" placeholder="Email" class="border px-2 py-1 w-full mb-3">
                    <input type="date" wire:model="baptism_date" placeholder="Baptism Date" class="border px-2 py-1 w-full mb-3">

                    <div class="flex justify-end">
                        <button wire:click="saveFamilyMember" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Save</button>
                        <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

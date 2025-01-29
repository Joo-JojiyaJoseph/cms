<div x-data="{ open: false, action: '', wardName: '' }">
    <button @click="open = true; action = 'add'">Add Ward</button>

    <div x-show="open">
        <form wire:submit.prevent="submitForm">
            <input type="text" x-model="wardName" wire:model.defer="wardName" placeholder="Ward Name">

            <button @click="open = false" type="button">Cancel</button>
            <button type="submit">Save</button>
        </form>
    </div>
</div>


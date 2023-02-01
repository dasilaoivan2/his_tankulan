<x-jet-confirmation-modal maxWidth="2xl" wire:model.defer="confirmUpdate">
    <x-slot name="title">
        Update Program
    </x-slot>

    <x-slot name="content">
        Are you sure you want to update this program? Once you update it, all data will be stored and displayed.
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmUpdate')" wire:loading.attr="disabled">
            Cancel
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="update()" wire:loading.attr="disabled">
            Confirm
        </x-jet-button>
    </x-slot>
</x-jet-confirmation-modal>
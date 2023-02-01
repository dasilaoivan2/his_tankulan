<x-jet-confirmation-modal maxWidth="2xl" wire:model.defer="confirmCancelEdit">
    <x-slot name="title">
        Cancel
    </x-slot>

    <x-slot name="content">
        Are you sure you want to cancel this update? Once you cancel it, all updated data in the fields will not be saved.
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmCancelEdit')" wire:loading.attr="disabled">
            Cancel
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="closeEdit()" wire:loading.attr="disabled">
            Confirm
        </x-jet-button>
    </x-slot>
</x-jet-confirmation-modal>
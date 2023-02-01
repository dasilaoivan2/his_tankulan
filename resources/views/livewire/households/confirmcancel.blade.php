<x-jet-confirmation-modal maxWidth="2xl" wire:model.defer="confirmCancel">
    <x-slot name="title">
        Cancel
    </x-slot>

    <x-slot name="content">
        Are you sure you want to cancel this household? Once you cancel it, all data in the fields will be reset.
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmCancel')" wire:loading.attr="disabled">
            Cancel
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="closeCreate()" wire:loading.attr="disabled">
            Confirm
        </x-jet-button>
    </x-slot>
</x-jet-confirmation-modal>
<x-jet-confirmation-modal maxWidth="2xl" wire:model.defer="confirmSave">
    <x-slot name="title">
        Add Case
    </x-slot>

    <x-slot name="content">
        Are you sure you want to add this case? Once you add it, all data will be stored and displayed.
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmSave')" wire:loading.attr="disabled">
            Cancel
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="store()" wire:loading.attr="disabled">
            Confirm
        </x-jet-button>
    </x-slot>
</x-jet-confirmation-modal>
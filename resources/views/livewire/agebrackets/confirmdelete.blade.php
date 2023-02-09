<x-jet-confirmation-modal maxWidth="2xl" wire:model.defer="confirmDelete">
    <x-slot name="title">
        Delete Age Bracket
    </x-slot>

    <x-slot name="content">
        Are you sure you want to delete this age? Once you delete it, all of its resources and data will be permanently deleted.
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmDelete')" wire:loading.attr="disabled">
            Nevermind
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
            Delete
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
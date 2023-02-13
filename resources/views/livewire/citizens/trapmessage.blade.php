<x-jet-confirmation-modal maxWidth="2xl" wire:model.defer="trapMessage">
    <x-slot name="title">
        WARNING
    </x-slot>

    <x-slot name="content">
        Duplicate Entry!. Please check the data.
        <br>
        <br>
        <b>Name:</b> {{$citizen_trapmessage->fullname()}}
        <br>
        <b>Household:</b> {{$citizen_trapmessage->household->residence_name}}
        <br>
         <b>Zone:</b> {{$citizen_trapmessage->household->zone->name}}
    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="$toggle('trapMessage')" wire:loading.attr="disabled">
            OK
        </x-jet-button>

    </x-slot>
</x-jet-confirmation-modal>
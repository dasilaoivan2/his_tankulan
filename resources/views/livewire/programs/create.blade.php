<x-jet-dialog-modal maxWidth="2xl" wire:model="isCreate">
    <x-slot name="title">Add Program</x-slot>

    <x-slot name="content">
        <form>
            <x-jet-label for="" value="{{ __('Program Details') }}" />

            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-2 py-2 bg-white sm:p-6">

                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                        <div class="mb-4">
                            <x-jet-label for="name" value="{{ __('Name') }}" />

                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name" />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>
                    </div>

                    
                </div>
            </div>




        </form>
    </x-slot>

    <x-slot name="footer">
        <div class="">

            <x-jet-button wire:click="confirmSave()">
                {{ __('Save') }}
            </x-jet-button>



            <x-jet-secondary-button wire:click="closeCreate()">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

        </div>
    </x-slot>

</x-jet-dialog-modal>
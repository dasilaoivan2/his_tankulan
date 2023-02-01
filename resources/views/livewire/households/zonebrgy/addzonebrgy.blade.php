<x-jet-dialog-modal maxWidth="2xl" wire:model="createZoneBrgy">
    <x-slot name="title">Add Zone/Barangay</x-slot>

    <x-slot name="content">
        <form>
            <x-jet-label for="" value="{{ __('Zone/Barangay Details') }}" />

            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-2 py-2 bg-white sm:p-6">

                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                        <div class="mb-2">
                            <x-jet-label for="barangay_id" value="{{ __('Barangay *') }}" />


                            <select id="barangay_id" wire:model="barangay_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" disabled>
                                <option value="">Select...</option>

                                @foreach($barangays as $barangay)

                                <option value="{{$barangay->id}}">{{$barangay->name}}</option>

                                @endforeach

                            </select>
                            <x-jet-input-error for="barangay_id" class="mt-2" />
                        </div>



                        <div class="mb-4">
                            <x-jet-label for="zone_id" value="{{ __('Zone *') }}" />


                            <select id="zone_id" wire:model="zone_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select...</option>

                                @foreach($zones as $zone)

                                <option value="{{$zone->id}}">{{$zone->name}}</option>

                                @endforeach

                            </select>
                            <x-jet-input-error for="zone_id" class="mt-2" />
                        </div>



                    </div>
                </div>
            </div>




        </form>
    </x-slot>

    <x-slot name="footer">
        <div class="">

            <x-jet-button wire:click="saveZoneBrgy()">
                {{ __('SUBMIT') }}
            </x-jet-button>



            <x-jet-secondary-button wire:click="closeZoneBrgy()">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

        </div>
    </x-slot>

</x-jet-dialog-modal>
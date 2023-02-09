    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Citizens') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <x-jet-button class="m-4" wire:click="create()">
                {{ __('Add Citizen') }}
            </x-jet-button>

            <input wire:model="searchToken" id="searchToken" class="border-2 rounded-lg border-yellow-900 text-black-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Search here...">


            @include('livewire.citizens.create')
            @include('livewire.citizens.edit')
            @include('livewire.citizens.confirmsave')
            @include('livewire.citizens.confirmupdate')
            @include('livewire.citizens.confirmdelete')
            @include('livewire.citizens.confirmcancel')
            @include('livewire.citizens.confirmcanceledit')

            <div style="overflow-y: hidden; max-width: 100%;">
                <table class="table-auto w-full text-center">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">No.</th>
                            <th class="px-4 py-2 w-20">DB ID</th>
                            <th class="px-4 py-2">Fullname</th>
                            <th class="px-4 py-2">Birthdate</th>
                            <th class="px-4 py-2">Age</th>
                            <th class="px-4 py-2">Household Name</th>
                            <th class="px-4 py-2">Zone</th>
                            <th width="230px" class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $temp = 0; ?>

                        @foreach($citizens as $citizen)
                        <tr>
                            <?php $temp++; ?>
                            <td class="border px-4 py-2">{{$temp}}</td>
                            <td class="border px-4 py-2">{{ $citizen->id}}</td>
                            <td class="border px-4 py-2">{{$citizen->firstname}} @if($citizen->middlename != NULL){{$citizen->middlename[0]}}. @else @endif {{$citizen->lastname}} {{$citizen->suffixname}}</td>
                            <td class="border px-4 py-2">{{\Carbon\Carbon::parse($citizen->birthdate)->format('M d, Y')}}</td>
                            <td class="border px-4 py-2">{{ $citizen->age()}}</td>
                            <td class="border px-4 py-2">{{ $citizen->household->residence_name}}</td>
                            <td class="border px-4 py-2">{{ $citizen->household->zone->name}}</td>
                            <td class="border">
                                <x-jet-button class="m-2" wire:click="edit({{$citizen->id}})">
                                    {{ __('Edit') }}
                                </x-jet-button>

                                <x-jet-secondary-button class="m-2" wire:click="confirmDelete({{$citizen->id}})">
                                    {{ __('Delete') }}
                                </x-jet-secondary-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$citizens->links()}}
        </div>
    </div>
</div>



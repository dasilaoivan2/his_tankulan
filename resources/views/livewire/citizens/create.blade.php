<x-jet-dialog-modal maxWidth="7xl" wire:model="isCreate">
    <x-slot name="title">Add Citizen</x-slot>

    <x-slot name="content">
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-jet-label for="" value="{{ __('Select Household') }}" />

                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-2 py-2 bg-white sm:p-6">
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                <div class="m-0">
                                    <input type="text" wire:model="searchHousehold" class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type here to search...">
                                </div>

                                <div style="overflow-y: hidden; max-width: 100%;">
                                    <table class="table-auto w-full text-center">
                                        <thead>
                                            <tr class="bg-gray-100">
                                                <th class="px-2 py-2 w-20">No.</th>
                                                <th class="px-2 py-2 w-20">DB ID</th>
                                                <th class="px-2 py-2">Household Name</th>
                                                <th class="px-2 py-2"># of Residents</th>
                                                <th class="px-2 py-2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $temp = 0; ?>

                                            @foreach($households as $household)
                                            <tr>
                                                <?php $temp++; ?>
                                                <td class="border px-4 py-2">{{$temp}}</td>
                                                <td class="border px-4 py-2">{{ $household->id}}</td>
                                                <td class="border px-4 py-2">{{ $household->residence_name }}</td>
                                                <td class="border px-4 py-2">{{ $household->citizens->count() }}</td>
                                                <td class="border">
                                                    <input id="{{$household->id}}" type="radio" wire:model="household_id" value="{{$household->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <x-jet-input-error for="household_id" class="mt-2" />
                        </div>
                    </div>


                </div>

                <div>
                    <x-jet-label for="" value="{{ __('Household Details') }}" />

                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-2 py-2 bg-white sm:p-6">
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                @if($household_id != NULL)
                                <div class="mb-2">
                                    <x-jet-label for="house" value="{{ __('Household Residence Name') }}" />
                                    <div class="mt-2" id="house">
                                        {{ $house->residence_name }}
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <x-jet-label for="house" value="{{ __('Address') }}" />
                                    <div class="mt-2" id="house">
                                        {{ $house->address_detail }}, {{ $house->zone->name }}, {{ $house->barangay->name }}, Manolo Fortich, Bukidnon
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>


                    <x-jet-label for="" value="{{ __('Resident Information') }}" />

                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-2 py-2 bg-white sm:p-6">

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="mb-2">
                                    <x-jet-label for="firstname" value="{{ __('Firstname') }}" />

                                    <x-jet-input id="firstname" type="text" class="mt-1 block w-full" wire:model="firstname" />
                                    <x-jet-input-error for="firstname" class="mt-2" />
                                </div>


                                <div class="mb-2">
                                    <x-jet-label for="middlename" value="{{ __('Middlename') }}" />

                                    <x-jet-input id="middlename" type="text" class="mt-1 block w-full" wire:model="middlename" />
                                    <x-jet-input-error for="middlename" class="mt-2" />
                                </div>


                                <div class="mb-2">
                                    <x-jet-label for="lastname" value="{{ __('Lastname') }}" />

                                    <x-jet-input id="lastname" type="text" class="mt-1 block w-full" wire:model="lastname" />
                                    <x-jet-input-error for="lastname" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="mb-2">
                                    <x-jet-label for="suffixname" value="{{ __('Suffixname') }}" />

                                    <select id="suffixname" wire:model="suffixname" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Select...</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="VI">VI</option>
                                    </select>
                                    <x-jet-input-error for="suffixname" class="mt-2" />
                                </div>


                                <div class="mb-2">
                                    <x-jet-label for="birthdate" value="{{ __('Birthdate') }}" />

                                    <x-jet-input id="birthdate" type="date" class="mt-1 block w-full" wire:model="birthdate" />
                                    <x-jet-input-error for="birthdate" class="mt-2" />
                                </div>


                                <div class="mb-2">
                                    <x-jet-label for="gender_id" value="{{ __('Gender') }}" />

                                    <select id="gender_id" wire:model="gender_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Select...</option>
                                        @foreach($genders as $gender)
                                        <option value="{{$gender->id}}">{{$gender->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="gender_id" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="mb-2">
                                    <x-jet-label for="contact_no" value="{{ __('Contact Number') }}" />

                                    <x-jet-input id="contact_no" type="text" class="mt-1 block w-full" wire:model="contact_no" />
                                    <x-jet-input-error for="contact_no" class="mt-2" />
                                </div>


                                <div class="mb-2">
                                    <x-jet-label for="email" value="{{ __('Email Address') }}" />

                                    <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model="email" />
                                    <x-jet-input-error for="email" class="mt-2" />
                                </div>


                                <div class="mb-2">
                                    <x-jet-label for="familyrole_id" value="{{ __('Family Role') }}" />

                                    <select id="familyrole_id" wire:model="familyrole_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Select...</option>
                                        @foreach($familyroles as $familyrole)
                                        <option value="{{$familyrole->id}}">{{$familyrole->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="familyrole_id" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="mb-2">
                                    <x-jet-label for="category" value="{{ __('Category:') }}" />

                                    @foreach($categories as $key => $category)
                                    <label for="category" class="block text-gray-700 text-sm mb-2 px-2 md:px-2">
                                        <input type="checkbox" class="font-bolder rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="category" wire:model="cat.{{$category->id}}" wire:click.debounce="updateCatArray({{$category->id}}, {{$key}})">
                                        {{$category->name}}

                                    </label>
                                    @endforeach

                                    <!-- {{print_r($category_id)}}
                                <br>
                                {{print_r($cat)}} -->
                                    <x-jet-input-error for="category" class="mt-2" />
                                </div>
                                <div class="mb-2">
                                    <x-jet-label for="program" value="{{ __('Program:') }}" />

                                    @foreach($programs as $key => $program)
                                    <label for="program" class="block text-gray-700 text-sm mb-2 px-2 md:px-2">
                                        <input type="checkbox" class="font-bolder rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="program" wire:model="prog.{{$program->id}}" wire:click.debounce="updateProgArray({{$program->id}}, {{$key}})">
                                        {{$program->name}}

                                    </label>
                                    @endforeach

                                    <!-- {{print_r($category_id)}}
                                <br>
                                {{print_r($cat)}} -->
                                    <x-jet-input-error for="program" class="mt-2" />
                                </div>
                                <div class="mb-2">
                                    <label for="viewcaseform" class="block font-bold text-sm text-red-700">
                                        Add Complaint
                                        <input type="checkbox" class="font-bolder rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="viewcaseform" wire:model="viewCaseForm">

                                    </label>

                                    @if($viewCaseForm)
                                    <x-jet-label for="pendingcase" value="{{ __('Complaints:') }}" />

                                    @foreach($pendingcases as $key => $pendingcase)
                                    <label for="pendingcase" class="block text-gray-700 text-sm mb-2 px-2 md:px-2">
                                        <input type="checkbox" class="font-bolder rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="pendingcase" wire:model="pend.{{$pendingcase->id}}" wire:click.debounce="updateCaseArray({{$pendingcase->id}}, {{$key}})">
                                        {{$pendingcase->name}}

                                    </label>
                                    @endforeach

                                    <!-- {{print_r($category_id)}}
                                <br>
                                {{print_r($cat)}} -->
                                    <x-jet-input-error for="pendingcase" class="mt-2" />
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-2">
                                    <x-jet-label for="work_id" value="{{ __('Nature of Work') }}" />

                                    <select id="work_id" wire:model="work_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Select...</option>
                                        @foreach($works as $work)
                                        <option value="{{$work->id}}">{{$work->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="work_id" class="mt-2" />
                                </div>



                                <div class="mb-2">
                                    <x-jet-label for="citizentype_id" value="{{ __('Type of Resident') }}" />

                                    <select id="citizentype_id" wire:model="citizentype_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Select...</option>
                                        @foreach($citizentypes as $citizentype)
                                        <option value="{{$citizentype->id}}">{{$citizentype->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="citizentype_id" class="mt-2" />
                                </div>
                            </div>

                            @if($citizentype_id == 1)
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                <div class="mb-2">
                                    <x-jet-label for="permanent_address" value="{{ __('Permanent Address') }}" />

                                    <x-jet-input id="permanent_address" type="text" class="mt-1 block w-full" wire:model="permanent_address" />
                                    <x-jet-input-error for="permanent_address" class="mt-2" />
                                </div>
                            </div>
                            @endif
                            <br>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="mb-2">
                                    <x-jet-label for="photo" value="{{ __('Photo') }}" />

                                    <x-jet-input id="photo" type="file" class="mt-1 block w-full" wire:model="photo" />
                                    <x-jet-input-error for="photo" class="mt-2" />
                                </div>

                                <div class="mb-2 col-span-2">
                                    @if($photo)
                                    <x-jet-label for="photo" value="{{ __('Photo Preview') }}" />

                                    <img width="1245px" src="{{$photo->temporaryUrl()}}">
                                    @endif
                                </div>
                            </div>
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



            <x-jet-secondary-button wire:click="confirmCancel()">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

        </div>
    </x-slot>

</x-jet-dialog-modal>
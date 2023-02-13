<x-jet-dialog-modal maxWidth="7xl" wire:model="isEdit">
    <x-slot name="title">Edit Category</x-slot>

    <x-slot name="content">
        <form>
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-2 py-2 bg-white sm:p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <x-jet-label for="type_id" value="{{ __('Household Type *') }}" />


                            <select id="type_id" wire:model="type_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select...</option>

                                @foreach($types as $type)

                                <option value="{{$type->id}}">{{$type->name}}</option>

                                @endforeach

                            </select>
                            <x-jet-input-error for="type_id" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-jet-label for="classification_id" value="{{ __('Classification *') }}" />


                            <select id="classification_id" wire:model="classification_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select...</option>

                                @foreach($classifications as $classification)

                                <option value="{{$classification->id}}">{{$classification->name}}</option>

                                @endforeach

                            </select>
                            <x-jet-input-error for="classification_id" class="mt-2" />
                        </div>


                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
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

                        <div class="mb-2 col-span-2">
                            <div class="mb-4">
                                <x-jet-label for="residence_name" value="{{ __('Residence_name *') }}" />

                                <x-jet-input id="residence_name" type="text" class="mt-1 block w-full" wire:model="residence_name" />
                                <x-jet-input-error for="residence_name" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="mb-4 col-span-3">
                            <x-jet-label for="address_detail" value="{{ __('Address Details (House #, Block, Street, etc. ) *') }}" />

                            <x-jet-input id="address_detail" type="text" class="mt-1 block w-full" wire:model="address_detail" />
                            <x-jet-input-error for="address_detail" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-jet-label for="income" value="{{ __('Income *') }}" />

                            <x-jet-input id="income" type="number" class="mt-1 block w-full" wire:model="income" />
                            <x-jet-input-error for="income" class="mt-2" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 border py-4 px-4">
                        <div class="flex items-center">
                        <x-jet-label for="cr" value="{{ __('Household with Comfort Room (CR)? *') }}" />

                        </div>
                        <div class="flex items-center">
                            <input id="link-radio" type="radio" wire:model.debounce="cr" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label style="margin-right: 1.5rem;" for="link-radio" class="ml-2 mr-6 text-sm font-medium text-gray-900 dark:text-gray-300">Yes</label>

                            <input id="link-radio2" type="radio" wire:model.debounce="cr" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="link-radio2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                        </div>
                    </div>
                    <x-jet-input-error for="cr" class="mt-2" />
                </div>
            </div>
            <br>


            <x-jet-label for="" value="{{ __('Resident') }}" />

            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-2 py-2 bg-white sm:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1">
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
                                                <input type="checkbox" class="font-bolder rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="category" wire:model="cat.{{$category->id}}" wire:click.debounce="updateCatArrayEdit({{$category->id}}, {{$key}})">
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
                                                <input type="checkbox" class="font-bolder rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="program" wire:model="prog.{{$program->id}}" wire:click.debounce="updateProgArrayEdit({{$program->id}}, {{$key}})">
                                                {{$program->name}}

                                            </label>
                                            @endforeach
                                            
                                            <!-- {{print_r($program_id)}}
                                            <br>
                                            {{print_r($prog)}} -->
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
                                                <input type="checkbox" class="font-bolder rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="pendingcase" wire:model="pend.{{$pendingcase->id}}" wire:click.debounce="updateCaseArrayEdit({{$pendingcase->id}}, {{$key}})">
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

                                            @else
                                            <x-jet-label for="photo" value="{{ __('Photo Preview') }}" />

                                            <img width="1245px" src="{{asset('storage/photo/'.$filename)}}">

                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">


                                        @if($updateCitizenInEditFormBtn)
                                        <x-jet-button wire:click.prevent="updateCitizenInEditForm" style="margin-right: 10px">
                                            {{ __('Update') }}
                                        </x-jet-button>
                                        @else
                                        <x-jet-button wire:click.prevent="addCitizenInEditForm" style="margin-right: 10px">
                                            {{ __('Submit') }}
                                        </x-jet-button>
                                        @endif





                                        <x-jet-secondary-button wire:click.prevent="clearCitizenField()">
                                            {{ __('Clear') }}
                                        </x-jet-secondary-button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-1">
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                                <x-jet-label for="" value="{{ __('Residents') }}" />
                                <div>
                                    <div style="overflow-y: hidden; max-width: 100%;">
                                        <table class="table-auto w-full text-center">
                                            <thead>
                                                <tr class="bg-gray-100">
                                                    <th class="px-4 py-2 w-20">No.</th>
                                                    <th class="px-4 py-2">Name</th>
                                                    <th class="px-4 py-2">Family Role</th>
                                                    <th class="px-4 py-2">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $temp = 0; ?>
                                                @if($citizens)
                                                @foreach($citizens as $citizen)
                                                <tr>
                                                    <?php $temp++; ?>
                                                    <td class="border px-4 py-2">{{$temp}}</td>
                                                    <td class="border px-4 py-2">{{$citizen->firstname}} @if($citizen->middlename != NULL){{$citizen->middlename[0]}}. @else @endif {{$citizen->lastname}} {{$citizen->suffixname}}</td>
                                                    <td class="border px-4 py-2">{{$citizen->familyrole->name}}</td>
                                                    <td class="border">
                                                        <x-jet-button class="px-1 py-1" wire:click.prevent="editCitizenInEditForm({{$citizen->id}})">
                                                            {{ __('Edit') }}
                                                        </x-jet-button>

                                                        <x-jet-secondary-button class="px-1 py-1" wire:click.prevent="removeCitizenInEditForm({{$citizen->id}})">
                                                            {{ __('Delete') }}
                                                        </x-jet-secondary-button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
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

            <x-jet-button wire:click="confirmUpdate()">
                {{ __('Save') }}
            </x-jet-button>



            <x-jet-secondary-button wire:click="confirmCancelEdit()">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

        </div>
    </x-slot>

</x-jet-dialog-modal>
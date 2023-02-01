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

            <div class="mb-4">
            <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Zone</h3>

                <select id="zone_id" wire:model="zone_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select...</option>
                    @foreach($zones as $zone)
                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="zone_id" class="mt-2" />
            </div>

            <hr>
            <br>

        @if($zone_id)
            <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Please select for Citizen Report</h3>
            <ul class="grid gap-6 w-full grid-cols-1 md:grid-cols-3">
                <li>
                    <input type="radio" id="categories" wire:model="radio_select" value="1" class="hidden peer" required>
                    <label for="categories" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Categories</div>
                            <div class="w-full">{{$category_count}}</div>
                        </div>
                        <svg aria-hidden="true" class="ml-3 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </label>
                </li>
                <li>
                    <input type="radio" id="programs" wire:model="radio_select" value="2" class="hidden peer">
                    <label for="programs" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Programs</div>
                            <div class="w-full">{{$program_count}}</div>
                        </div>
                        <svg aria-hidden="true" class="ml-3 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </label>
                </li>
                <li>
                    <input type="radio" id="cases" wire:model="radio_select" value="3" class="hidden peer">
                    <label for="cases" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Cases</div>
                            <div class="w-full">{{$pendingcase_count}}</div>
                        </div>
                        <svg aria-hidden="true" class="ml-3 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </label>
                </li>
            </ul>

            @if($radio_select == 1)
            <div class="mb-4 mt-4">
                <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Please select categories</h3>
                <ul class="grid gap-6 grid-cols-3 md:grid-cols-6 items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach($categories as $category)
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input id="horizontal-list-radio-license" type="radio" value="{{$category->id}}" wire:model="category_id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="horizontal-list-radio-license" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">{{$category->name}} </label>
                        </div>
                    </li>

                    @endforeach
                </ul>
            </div>

            @elseif($radio_select == 2)

            <div class="mb-4 mt-4">
                <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Please select programs</h3>
                <ul class="grid gap-6 grid-cols-3 md:grid-cols-6 items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach($programs as $program)
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input id="horizontal-list-radio-license" type="radio" value="{{$program->id}}" wire:model="program_id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="horizontal-list-radio-license" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">{{$program->name}} </label>
                        </div>
                    </li>

                    @endforeach
                </ul>
            </div>

            @elseif($radio_select == 3)
            <div class="mb-4 mt-4">
                <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Please select cases</h3>
                <ul class="grid gap-6 grid-cols-3 md:grid-cols-6 items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach($pendingcases as $pendingcase)
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input id="horizontal-list-radio-license" type="radio" value="{{$pendingcase->id}}" wire:model="pendingcase_id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="horizontal-list-radio-license" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">{{$pendingcase->name}} </label>
                        </div>
                    </li>

                    @endforeach
                </ul>
            </div>

            @elseif($radio_select == '')



            @endif
        @endif





            <div style="display: flex; justify-content:flex-end" class="mt-4">



                @if($radio_select == '')
                <input wire:model="searchToken" id="searchToken" class="mb-4 mr-4 inline-flex border-2 rounded-lg border-yellow-900 text-black-700 mr-3 leading-tight focus:outline-none" type="text" placeholder="Search here...">
                @endif


                <button wire:click.debounce="clearRadioButton()" class="mb-4 mr-4 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                    <i class="fa fa-trash fa-lg" style="margin-right: 10px"></i>
                    Clear All
                </button>

                @if($zone_id != NULL)
                <a href="{{route('citizens.zone.reports', ['zone_id' => $zone_id])}}" class="mb-4 mr-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                    <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                    Print By Zone
                </a>
                @endif


                @if($radio_select == 1)
                @if($category_id != NULL)

                <a href="{{route('citizens.zonesubgroup.reports', ['zone_id' => $zone_id, 'radio_select' => $radio_select, 'subgroup_id' => $category_id])}}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                    <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                    Print
                </a>


                @else
                <a href="{{route('citizens.zonegroup.reports', ['zone_id' => $zone_id, 'radio_select' => $radio_select])}}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                    <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                    Print
                </a>
                @endif

                @elseif($radio_select == 2)
                @if($program_id != NULL)

                <a href="{{route('citizens.zonesubgroup.reports', ['zone_id' => $zone_id, 'radio_select' => $radio_select, 'subgroup_id' => $program_id])}}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                    <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                    Print
                </a>

                @else
                <a href="{{route('citizens.zonegroup.reports', ['zone_id' => $zone_id, 'radio_select' => $radio_select])}}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                    <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                    Print
                </a>
                @endif

                @elseif($radio_select == 3)
                @if($pendingcase_id != NULL)

                <a href="{{route('citizens.zonesubgroup.reports', ['zone_id' => $zone_id, 'radio_select' => $radio_select, 'subgroup_id' => $pendingcase_id])}}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                    <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                    Print
                </a>

                @else
                <a href="{{route('citizens.zonegroup.reports', ['zone_id' => $zone_id, 'radio_select' => $radio_select])}}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                    <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                    Print
                </a>
                @endif

                @elseif($radio_select == '')



                @endif


            </div>

            <div style="overflow-y: hidden; max-width: 100%;">
                <table class="table-auto w-full text-center">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">No.</th>
                            <th class="px-4 py-2 w-20">DB ID</th>
                            <th class="px-4 py-2">Fullname</th>
                            <th class="px-4 py-2">Household Name</th>
                            <th width="230px" class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $temp = 0; ?>
                        @if($radio_select == '')
                        @if($citizens)
                        @foreach($citizens as $citizen)
                        <tr>
                            <?php $temp++; ?>
                            <td class="border px-4 py-2">{{$temp}}</td>
                            <td class="border px-4 py-2">{{ $citizen->id}}</td>
                            <td class="border px-4 py-2">{{$citizen->firstname}} @if($citizen->middlename != NULL){{$citizen->middlename[0]}}. @else @endif {{$citizen->lastname}} {{$citizen->suffixname}}</td>
                            <td class="border px-4 py-2">{{ $citizen->household->residence_name}}</td>
                            <td class="border">
                                <a href="{{route('citizens.individual.reports', ['id' => $citizen->id])}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                                    <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                                    Print
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        @else

                        @foreach($citizens as $citizen)
                        <tr>
                            <?php $temp++; ?>
                            <td class="border px-4 py-2">{{$temp}}</td>
                            <td class="border px-4 py-2">{{ $citizen->id}}</td>
                            <td class="border px-4 py-2">{{$citizen->firstname}} @if($citizen->middlename != NULL){{$citizen->middlename[0]}}. @else @endif {{$citizen->lastname}} {{$citizen->suffixname}}</td>
                            <td class="border px-4 py-2">{{ $citizen->residence_name}}</td>
                            <td class="border">
                                <a href="{{route('citizens.individual.reports', ['id' => $citizen->id])}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                                    <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                                    Print
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @if($radio_select == '')
                {{$citizens->links()}}
                @else
                {{$citizens->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
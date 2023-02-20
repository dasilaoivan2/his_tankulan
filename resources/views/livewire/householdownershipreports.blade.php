<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Households') }}
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




            <ul class="grid gap-6 w-full grid-cols-1 md:grid-cols-3">
                @foreach($ownerships as $ownership)
                <li>
                    <input type="radio" id="{{$ownership->id}}" wire:model="ownership_id" value="{{$ownership->id}}" class="hidden peer" required>
                    <label for="{{$ownership->id}}" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">{{$ownership->name}}</div>
                            <div class="w-full">Household Total: {{$ownership->households->count()}}</div>
                        </div>
                        <svg aria-hidden="true" class="ml-3 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </label>
                </li>
                @endforeach
            </ul>
            <br>

            @if($ownership_id != NULL)
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6 border py-4 px-4">
                <div class="flex">
                    <div class="flex items-center mr-4">
                        <input id="viewzone" type="checkbox" wire:model="viewZone" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="viewzone" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">By zone</label>
                    </div>    
                    @if($viewZone)
                        <div class="flex items-center mr-4">

                            <select wire:model="zone_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select...</option>
                                @foreach($zones as $zone)
                                <option value="{{$zone->id}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="zone_id" class="mt-2" />
                        </div>
                    @endif
                </div>
            </div>
            @endif




            <div style="display: flex; justify-content:flex-end" class="mt-4">

                <input wire:model="searchToken" id="searchToken" class="mb-4 mr-4 inline-flex border-2 rounded-lg border-yellow-900 text-black-700 mr-3 leading-tight focus:outline-none" type="text" placeholder="Search here...">


                <button wire:click.debounce="clearRadioButton()" class="mb-4 mr-4 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                    <i class="fa fa-trash fa-lg" style="margin-right: 10px"></i>
                    Clear All
                </button>




                


                @if($ownership_id != NULL)
                    @if($viewZone)
                        @if($zone_id != NULL)
                        <a href="{{route('households.reports.zoneownership', ['zone_id' => $zone_id, 'ownership_id' => $ownership_id])}}" class="mb-4 mr-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                            <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                            Print By Zone
                        </a>

                        @else
                        <a href="{{route('households.reports.ownership', ['ownership_id' => $ownership_id])}}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                            <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                            Print
                        </a>
                    @endif

                @else
                <a href="{{route('households.reports.ownership', ['ownership_id' => $ownership_id])}}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                    <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                    Print
                </a>

                @endif
                @endif
            </div>




            <div style="overflow-y: hidden; max-width: 100%;">
                <table class="table-auto w-full text-center">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">No.</th>
                            <th class="px-4 py-2">Household Name</th>
                            <th class="px-4 py-2">Type</th>
                            <th class="px-4 py-2">Classification</th>
                            <th class="px-4 py-2">Zone</th>
                            <th class="px-4 py-2"># of Residents</th>
                            <th width="230px" class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $temp = 0; ?>

                        @foreach($households as $household)
                        <tr>
                            <?php $temp++; ?>
                            <td class="border px-4 py-2">{{$temp}}</td>
                            <td class="border px-4 py-2">{{$household->residence_name}}</td>
                            <td class="border px-4 py-2">{{$household->type->name}}</td>
                            <td class="border px-4 py-2">{{$household->classification->name}}</td>
                            <td class="border px-4 py-2">{{$household->zone->name}}</td>
                            <td class="border px-4 py-2">{{$household->citizens->count()}}</td>
                            <td class="border">
                                <a href="{{route('households.reports', ['id' => $household->id])}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                                    <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                                    Print
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$households->links()}}

            </div>
        </div>
    </div>
</div>

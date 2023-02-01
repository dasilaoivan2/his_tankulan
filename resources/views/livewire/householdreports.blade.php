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

            

            <input wire:model="searchToken" id="searchToken" class="mb-4 mr-4 inline-flex border-2 rounded-lg border-yellow-900 text-black-700 mr-3 leading-tight focus:outline-none" type="text" placeholder="Search here...">

            <a href="{{route('households.all.reports')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" target="_blank">
                                    <i class="fa fa-print fa-lg" style="margin-right: 10px"></i>
                                    Print All
                                </a>
            


        

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
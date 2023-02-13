    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <!-- {{-- <x-jet-welcome />--}} -->
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <i class="fa fa-house fa-2xl"></i>
                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="">Households ({{$households->count()}})</a></div>
                        </div>

                        <div class="ml-4">
                            <div style="overflow-y: hidden; max-width: 100%;" class="mb-4">
                                <table class="table-auto w-full">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="px-4 py-2">Household Classification</th>
                                            <th class="px-4 py-2">No. of Households</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $temp = 0; ?>

                                        @foreach($classifications as $classification)
                                        <tr>
                                            <?php $temp++; ?>
                                            <td class="border px-4 py-2">{{ $classification->name }}</td>

                                            <td class="border px-4 py-2"><a target="_blank" href="">{{ $classification->households->count() }}</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" href="{{route('households')}}">

                                <div>View Household</div>

                                <div class="ml-1 text-light-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>

                            </a>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                        <div class="flex items-center mb-4">
                            <i class="fa fa-people-line fa-2xl"></i>
                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="">Citizens ({{$citizens->count()}}) </a></div>
                        </div>

                        <div class="ml-4">
                            <div style="overflow-y: hidden; max-width: 100%;" class="mb-4">
                                <table class="table-auto w-full">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="px-4 py-2">Nature of Work</th>
                                            <th class="px-4 py-2">No. of Citizens</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $temp = 0; ?>

                                        @foreach($works as $work)
                                        <tr>
                                            <?php $temp++; ?>
                                            <td class="border px-4 py-2">{{ $work->name }}</td>
                                            <td class="border px-4 py-2">{{ $work->citizens->count() }}</td>

                                        

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                           

                            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" href="{{route('citizens')}}">

                                <div>View Citizen</div>

                                <div class="ml-1 text-light-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>

                            </a>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200">
                        <div class="flex items-center mb-4">
                            <i class="fa fa-house fa-2xl"></i>
                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="">Households ({{$households->count()}})</a></div>
                        </div>

                        <div class="ml-4">
                            <div style="overflow-y: hidden; max-width: 100%;" class="mb-4">
                                <table class="table-auto w-full">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="px-4 py-2">Household Classification</th>
                                            <th class="px-4 py-2">No. of Households</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $temp = 0; ?>

                                        @foreach($types as $type)
                                        <tr>
                                            <?php $temp++; ?>
                                            <td class="border px-4 py-2">{{ $type->name }}</td>

                                            <td class="border px-4 py-2"><a target="_blank" href="">{{ $type->households->count() }}</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" href="{{route('households')}}">

                                <div>View Household</div>

                                <div class="ml-1 text-light-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>

                            </a>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 md:border-l">
                        <div class="flex items-center mb-4">
                            <i class="fa fa-people-line fa-2xl"></i>
                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="">Citizens ({{$citizens->count()}}) </a></div>
                        </div>

                        <div class="ml-4">
                            <div style="overflow-y: hidden; max-width: 100%;" class="mb-4">
                                <table class="table-auto w-full">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="px-4 py-2">Age Bracket</th>
                                            <th class="px-4 py-2">No. of Citizens</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $temp = 0; ?>

                                        @foreach($agebrackets as $agebracket)
                                        <tr>
                                            <?php $temp++; ?>
                                            <td class="border px-4 py-2">{{ $agebracket->name }}</td>

                                        @php
                                        $minAge = $agebracket->from;
                                        $maxAge = $agebracket->to;
                            
                                        $minDate = Carbon\Carbon::today()->subYears($maxAge + 1);
                                        $maxDate = Carbon\Carbon::today()->subYears($minAge)->endOfDay();

                                        $citizens = \App\Models\Citizen::whereBetween('birthdate', [$minDate,$maxDate])

                                        @endphp


                                            <td class="border px-4 py-2">{{$citizens->count()}}</td>

                                        

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                           

                            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" href="{{route('citizens')}}">

                                <div>View Citizen</div>

                                <div class="ml-1 text-light-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


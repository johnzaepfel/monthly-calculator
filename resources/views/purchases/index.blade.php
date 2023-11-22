<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monthly Calculator') }}
        </h2>
    </x-slot>
     
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-3xl m-auto">

                    <div class="mb-8 md:text-right md:text-lg">
                        <a class="px-4 py-2 text-sm text-white bg-purple-700 font-semibold rounded border border-purple-800 hover:text-purple-600 hover:bg-zinc-300 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2" href="{{ route('purchases.create') }}"> Create Purchase</a>
                    </div>
                    

                        <form action="{{ route('purchases.index') }}" method="GET" class="w-full max-w-lg">
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-1/3 px-3 mb-4 inline-block">
                                    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="selected_month">Month</label> 
                                    <select name="selected_month" id="selected_month" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    @for($month = 1; $month <= 12; $month++ )
                                        <option value="{{ $month }}" @selected($selected_month == $month)>{{ $month }}</option>
                                    @endfor
                                    </select>
                                </div>
                                <div class="w-1/3 px-3 mb-4 inline-block">
                                    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="selected_month" for="selected_year">Year</label> 
                                    <select name="selected_year" id="selected_year" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    @foreach($menu_years as $menu_year )
                                        <option value="{{ $menu_year->year }}" @selected($selected_year == $menu_year->year)>{{ $menu_year->year }}</option>
                                    @endforeach
                                    </select> 
                                </div>
                                <div class="w-1/3 px-3 mb-4 mt-6 inline-block align-baseline">
                                    <button type="submit" class="px-4 py-2 text-sm text-white bg-gray-700 font-semibold rounded border border-gray-800 hover:text-gray-600 hover:bg-zinc-300 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2">Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
        
                    @if ($message = Session::get('success'))
                        <div class="text-green-600">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    
                    @foreach ($categories as $key => $category)

                    @php
                        $sub_total = 0;    
                    @endphp

                    @if(count($purchases[$key])>0)


                    <table class="table w-full md:text-lg rounded mt-5 border-b">
                        <thead>
                            <tr>
                                <th colspan="7" class="border-b text-slate-600 uppercase"><span class="">{{ $category->name }}</span></th>
                            </tr>
                            <tr>
                                <th class="table-cell w-1/4 sm:w-1/6 font-bold border-b dark:border-slate-600">Date</th>
                                <th class="table-cell w-1/4 sm:w-1/6 font-bold border-b dark:border-slate-600">Amount</th>
                                <th class="table-cell w-1/3 sm:w-1/4 font-bold border-b dark:border-slate-600">Name</th>
                                <th class="hidden sm:table-cell sm:w-1/4 font-bold border-b dark:border-slate-600">Description</th>
                                <th class="table-cell w-1/6 font-bold border-b dark:border-slate-600">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases[$key] as $purchase)
                            <tr>
                                <td class="table-cell py-2 sm:py-1 border-b border-slate-100 dark:border-slate-700">{{ date("M j", strtotime($purchase->purchase_date)) }}</td>
                                <td class="table-cell py-2 sm:py-1 border-b border-slate-100 dark:border-slate-700 text-right pr-5">${{ $purchase->amount }}</td>
                                <td class="table-cell py-2 sm:py-1 border-b border-slate-100 dark:border-slate-700">{{ $purchase->store_name }}</td>
                                <td class="hidden sm:table-cell py-2 sm:py-1 border-b border-slate-100 dark:border-slate-700">{{ $purchase->description }}</td>
                                <td class="table-cell py-2 sm:py-1 border-b border-slate-100 dark:border-slate-700 text-center whitespace-nowrap">
                                    <form action="{{ route('purchases.destroy',$purchase->id) }}" method="Post">
                        
                                        <a class="px-3 py-2 text-sm text-white bg-green-700 font-semibold rounded border border-green-800 hover:text-green-600 hover:bg-zinc-300 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2" href="{{ route('purchases.edit',$purchase->id) }}">Edit</a>
                        
                                        @csrf
                                        @method('DELETE')
                        
                                        <button type="submit" class="hidden sm:inline px-3 py-2 h-9 text-sm text-white bg-red-700 font-semibold rounded border border-red-800 hover:text-red-600 hover:bg-zinc-300 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $sub_total += $purchase->amount;    

                                $remaining_color = '';
                                if( $category->budget_total-$sub_total > 0 ) {
                                    $remaining_color = ' text-green-600';
                                }
                                elseif ($category->budget_total-$sub_total < 0 ) {
                                    $remaining_color = ' text-red-600';
                                }

                            @endphp

                            @endforeach
                            <tr>
                                <td colspan="1"></td>
                                <td class="text-right pr-5 font-bold">${{ $sub_total }}</td>
                                <td colspan="4">Month Total</td>
                            </tr>
                            <tr>
                                <td colspan="1"></td>
                                <td class="text-right pr-5 text-blue-600">${{ $category->budget_total }}</td>
                                <td colspan="4">Budget</td>
                            </tr>
                            <tr>
                                <td colspan="1"></td>
                                <td class="text-right pr-5{{ $remaining_color }}">${{ $category->budget_total-$sub_total }}</td>
                                <td colspan="4">Remaining</td>
                            </tr>
                        </tbody>
                    </table>

                    @endif

                    @endforeach

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
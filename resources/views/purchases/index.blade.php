<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monthly Calculator') }}
        </h2>
    </x-slot>
     
    <div class="container mt-2">
    
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('purchases.create') }}"> Create Purchase</a>
                </div>
                <div class="pull-right mb-2">
                    <form action="{{ route('purchases.index') }}" method="GET">
                        <label for="selected_month">Month</label> <select name="selected_month" id="selected_month" class="form-control">
                        @for($month = 1; $month <= 12; $month++ )
                            <option value="{{ $month }}" @selected($selected_month == $month)>{{ $month }}</option>
                        @endfor
                        </select>
                        <label for="selected_year">Year</label> <select name="selected_year" id="selected_year" class="form-control">
                        @foreach($menu_years as $menu_year )
                            <option value="{{ $menu_year->year }}" @selected($selected_year == $menu_year->year)>{{ $menu_year->year }}</option>
                        @endforeach
                        </select>
                        <button type="submit" class="btn btn-secondary bg-gray-500">Change</button>
                    </form>
                </div>
            </div>
        </div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        
        @foreach ($categories as $key => $category)

        @php
            $sub_total = 0;    
        @endphp

        @if(count($purchases[$key])>0)


        <table class="table table-bordered">
            <tr>
                <th colspan="7">{{ $category->name }}</th>
            </tr>
            <tr>
                <th>Purchase Date</th>
                <th>Amount</th>
                <th>Store Name</th>
                <th>Description</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($purchases[$key] as $purchase)
            <tr>
                <td>{{ $purchase->purchase_date }}</td>
                <td class="text-right">${{ $purchase->amount }}</td>
                <td>{{ $purchase->store_name }}</td>
                <td>{{ $purchase->description }}</td>
                <td>
                    <form action="{{ route('purchases.destroy',$purchase->id) }}" method="Post">
        
                        <a class="btn btn-primary" href="{{ route('purchases.edit',$purchase->id) }}">Edit</a>
        
                        @csrf
                        @method('DELETE')
        
                        <button type="submit" class="btn btn-danger bg-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @php
                $sub_total += $purchase->amount;    
            @endphp

            @endforeach
            <tr>
                <td colspan="1"></td>
                <td class="text-right">${{ $sub_total }}</td>
                <td colspan="4">Month Total</td>
            </tr>
            <tr>
                <td colspan="1"></td>
                <td class="text-right">${{ $category->budget_total }}</td>
                <td colspan="4">Budget</td>
            </tr>
            <tr>
                <td colspan="1"></td>
                <td class="text-right">${{ $category->budget_total-$sub_total }}</td>
                <td colspan="4">Remaining</td>
            </tr>
        </table>

        @endif

        @endforeach
    

    </div>

</x-app-layout>
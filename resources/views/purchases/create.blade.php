<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Purchase') }}
        </h2>
    </x-slot>
       
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <div class="mb-4 md:text-right md:text-lg">
                        <a class="px-4 py-2 text-sm text-white bg-green-700 font-semibold rounded border border-green-800 hover:text-green-600 hover:bg-zinc-300 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2" href="{{ route('purchases.index') }}" enctype="multipart/form-data"> Back</a>
                    </div>

    
                    @if(session('status'))
                    <div class="alert alert-success mb-1 mt-1">
                        {{ session('status') }}
                    </div>
                    @endif
    
                    <form action="{{ route('purchases.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                    
                        <div>
                            <label for="purchase_date" class="block font-medium text-sm text-gray-700">Purchase Date:</label>
                            <input type="date" name="purchase_date" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Purchase Date">
                            @error('purchase_date')
                            <div class="text-rose-600 dark:text-rose-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div>
                            <label for="store_name" class="block font-medium text-sm text-gray-700">Store Name:</label>
                            <input type="text" name="store_name" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Store Name">
                            @error('store_name')
                            <div class="text-rose-600 dark:text-rose-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block font-medium text-sm text-gray-700">Category:</label>
                            <select name="category_id" id="category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                @foreach($categories as $category )
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="text-rose-600 dark:text-rose-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div>
                            <label for="amount" class="block font-medium text-sm text-gray-700">Amount:</label>
                            $<input type="number" name="amount" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Amount">
                            @error('amount')
                            <div class="text-rose-600 dark:text-rose-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div>
                            <label for="description" class="block font-medium text-sm text-gray-700">Description:</label>
                            <input type="text" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Description">
                            @error('description')
                            <div class="text-rose-600 dark:text-rose-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="user_id" class="block font-medium text-sm text-gray-700">User:</label>
                            {{ Auth::user()->name }} <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        </div>

                        <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-700 font-semibold rounded border border-blue-800 hover:text-blue-600 hover:bg-zinc-300 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">Submit</button>
                        
                    </form>
 
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

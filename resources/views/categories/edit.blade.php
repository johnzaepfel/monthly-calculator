<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Categories') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <div class="mb-4 md:text-right md:text-lg">
                        <a class="px-4 py-2 text-sm text-white bg-green-700 font-semibold rounded border border-green-800 hover:text-green-600 hover:bg-zinc-300 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2" href="{{ route('categories.index') }}" enctype="multipart/form-data"> Back</a>
                    </div>
        
                    @if(session('status'))
                        <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                    
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Name:</strong>
                            <input type="text" name="name" value="{{ $category->name }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Category name">
                            @error('name')
                            <div class="text-rose-600 dark:text-rose-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Order:</strong>
                            <input type="number" name="order" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Category Order" value="{{ $category->order }}">
                            @error('order')
                            <div class="text-rose-600 dark:text-rose-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Budget Total:</strong>
                            $<input type="number" name="budget_total" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="Budget Total" value="{{ $category->budget_total }}">
                            @error('budget_total')
                            <div class="text-rose-600 dark:text-rose-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 md:text-lg">
                            <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-700 font-semibold rounded border border-blue-800 hover:text-blue-600 hover:bg-zinc-300 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">Save</button>
                        </div>

                    </form>

                    <form action="{{ route('categories.destroy',$category->id) }}" method="Post" class="text-right ">
                        
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="px-4 py-2 text-sm text-white bg-red-700 font-semibold rounded border border-red-800 hover:text-red-600 hover:bg-zinc-300 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

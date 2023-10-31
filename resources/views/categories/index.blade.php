<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
      

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-3xl m-auto">

                    <div class="mb-4 md:text-right md:text-lg">
                        <a class="px-4 py-2 text-sm text-white bg-purple-700 font-semibold rounded border border-purple-800 hover:text-purple-600 hover:bg-zinc-300 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2" href="{{ route('categories.create') }}"> Create Category</a>
                    </div>
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    
                    <div class="table w-full md:text-lg rounded">
                        <div class="table-header-group">
                            <div class="table-row">
                                <div class="table-cell font-bold border-b dark:border-slate-600 text-left px-2 py-2">Name</div>
                                <div class="table-cell font-bold border-b dark:border-slate-600 text-center pl-2 pr-0 py-2">Order</div>
                                <div class="table-cell font-bold border-b dark:border-slate-600 text-right pl-0 pr-4 py-2 ">Budget Total</div>
                                <div class="table-cell font-bold border-b dark:border-slate-600 text-left px-2 py-2">Action</div>
                            </div>
                        </div>
                        <div class="table-row-group">
                            @foreach ($categories as $category)
                            <div class="table-row odd:bg-slate-100">
                                <div class="table-cell border-b border-slate-100 dark:border-slate-700 py-2 px-2">{{ $category->name }}</div>
                                <div class="table-cell border-b border-slate-100 dark:border-slate-700 pl-2 pr-0 text-center">{{ $category->order }}</div>
                                <div class="table-cell border-b border-slate-100 dark:border-slate-700 pl-0 pr-4 text-right">${{ $category->budget_total }}</div>
                                <div class="table-cell border-b border-slate-100 dark:border-slate-700 py-2 px-2">
                                    <a class="px-3 py-1 text-sm text-white bg-green-700 font-semibold rounded border border-green-800 hover:text-green-600 hover:bg-zinc-300 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2" href="{{ route('categories.edit',$category->id) }}">Edit</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

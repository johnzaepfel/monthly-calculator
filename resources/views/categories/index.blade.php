<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
      
<div class="container mt-2">
 
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('categories.create') }}"> Create Category</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Order</th>
            <th>Budget Total</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->order }}</td>
            <td>${{ $category->budget_total }}</td>

            <td>
                <form action="{{ route('categories.destroy',$category->id) }}" method="Post">
     
                    <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Edit</a>
    
                    @csrf
                    @method('DELETE')
       
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
   
    <a class="btn btn-info" href="{{ route('purchases.index') }}">Purchases</a>
 
</div>

</x-app-layout>

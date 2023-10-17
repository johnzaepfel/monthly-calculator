<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Purchase') }}
        </h2>
    </x-slot>
      
<div class="container mt-2">
 
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('purchases.index') }}" enctype="multipart/form-data"> Back</a>
            </div>
        </div>
    </div>
    
  @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
  @endif
   
    <form action="{{ route('purchases.update',$purchase->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Purchase Date:</strong>
                    <input type="date" name="purchase_date" value="{{ $purchase->purchase_date }}" class="form-control" placeholder="Purchase Date">
                    @error('purchase_date')
                     <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Store Name:</strong>
                     <input type="text" name="store_name" class="form-control" placeholder="Store Name" value="{{ $purchase->store_name }}">
                    @error('store_name')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                   @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Category:</strong>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $category )
                          <option value="{{ $category->id }}" @selected($purchase->category_id == $category->id)>{{ $category->name }}</option>
                        @endforeach
                      </select>
                        @error('category_id')
                     <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Amount:</strong>
                    $<input type="number" name="amount" value="{{ $purchase->amount }}" class="form-control" placeholder="Amount">
                    @error('amount')
                     <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <input type="text" name="description" value="{{ $purchase->description }}" class="form-control" placeholder="Description">
                    @error('description')
                     <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>User:</strong>
                    {{ $purchase->user->name }}
                </div>
            </div>
            
              <button type="submit" class="btn btn-primary ml-3">Submit</button>
           
        </div>
    
    </form>
</div>
 
</div>

</x-app-layout>

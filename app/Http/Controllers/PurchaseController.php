<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request);
        //dd($request->selected_year);
        //dd($request->selected_month);
        //dd(date('n'));

        $request->validate([
            'selected_year' => 'integer',//|size:4',
            'selected_month' => 'integer',//|between:1,2',
        ]);

        $selected_year = $request->query('selected_year', date('Y'));

        $selected_month = $request->query('selected_month', date('n'));

        $categories = Category::orderBy('order','asc')->get();
        //dd($categories);

        foreach( $categories as $key => $category ) {

            //dd($category);

            $each_purchase = Purchase::where('category_id','=',$category->id)
                                            ->whereMonth('purchase_date', $selected_month)
                                            ->whereYear('purchase_date', $selected_year)
                                            ->orderBy('purchase_date','desc')
                                            ->get();
            
            $purchases[$key] = $each_purchase;
            //var_dump($each_purchase);
            //dd($each_purchase);

            
        }
                                            
        $menu_years = Purchase::select(Purchase::raw("YEAR(purchase_date) as year"))
                                    ->distinct()
                                    ->orderBy('year','asc')
                                    ->get();

        return view('purchases.index')
                ->with(compact('purchases'))
                ->with(compact('categories'))
                ->with(compact('menu_years'))
                ->with(compact('selected_year'))
                ->with(compact('selected_month'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('order','asc')->get();

        //dd($categories);

        return view('purchases.create', compact('categories'));
    }
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'purchase_date' => 'required',
            'store_name' => 'required',
            'category_id' => 'required',
            'amount' => 'required',
            'user_id' => 'required',
        ]);
 
        $purchase = new Purchase;
 
        $purchase->purchase_date = $request->purchase_date;
        $purchase->store_name = $request->store_name;
        $purchase->category_id = $request->category_id;
        $purchase->amount = $request->amount;
        $purchase->description = $request->description;
        $purchase->user_id = $request->user_id;

        //https://laravel.com/docs/10.x/authentication#retrieving-the-authenticated-user
 
        $purchase->save();
 
      
        return redirect()->route('purchases.index')
                        ->with('success','Purchase has been created successfully.');
    }
      
    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('purchases.show',compact('purchase'));
    } 
      
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $categories = Category::orderBy('order','asc')->get();

        return view('purchases.edit')
            ->with(compact('categories'))
            ->with(compact('purchase'));
    }
     
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'purchase_date' => 'required',
            'store_name' => 'required',
            'category_id' => 'required',
            'amount' => 'required',
        ]);
         
        $purchase = Purchase::find($id);
 
        $purchase->purchase_date = $request->purchase_date;
        $purchase->store_name = $request->store_name;
        $purchase->category_id = $request->category_id;
        $purchase->amount = $request->amount;
        $purchase->description = $request->description;
 
        $purchase->save();
     
        return redirect()->route('purchases.index')
                        ->with('success','Purchase Has Been updated successfully');
    }
     
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
     
        return redirect()->route('purchases.index')
                        ->with('success','Purchase has been deleted successfully');
    }
}
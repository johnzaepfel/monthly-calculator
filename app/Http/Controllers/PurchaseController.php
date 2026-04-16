<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'selected_year' => ['integer'],
            'selected_month' => ['integer', 'between:1,12'],
        ]);

        $selected_year = $request->query('selected_year', date('Y'));
        $selected_month = $request->query('selected_month', date('n'));

        $categories = Category::orderBy('order', 'asc')->get();
        $purchases = [];

        foreach ($categories as $category) {
            $purchases[$category->id] = $category->purchases()
                ->whereYear('purchase_date', $selected_year)
                ->whereMonth('purchase_date', $selected_month)
                ->orderByDesc('purchase_date')
                ->get();
        }

        $menu_years = Purchase::selectRaw('YEAR(purchase_date) AS year')
            ->distinct()
            ->orderBy('year', 'asc')
            ->pluck('year');

        if ($menu_years->isEmpty()) {
            $menu_years = collect([date('Y')]);
        }

        return view('purchases.index', compact('purchases', 'categories', 'menu_years', 'selected_year', 'selected_month'));    }
    
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
    public function store(PurchaseRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        Purchase::create($validated);

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase has been created successfully.');
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
    public function update(PurchaseRequest $request, Purchase $purchase)
    {
        $purchase->update($request->validated());

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase has been updated successfully');
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
<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::orderBy('order','asc')->paginate(10);
     
        return view('categories.index', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $new_max_order = Category::max('order') + 1;

        return view('categories.create',compact('new_max_order'));
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
            'name' => 'required|string',
            'order' => 'required|numeric',
            'budget_total' => 'required|numeric',
        ]);
 
        $category = new Category;
 
        $category->name = $request->name;
        $category->order = $request->order;
        $category->budget_total = $request->budget_total;
 
 
        $category->save();
 
      
        return redirect()->route('categories.index')
                        ->with('success','Category has been created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show',compact('category'));
    } 
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'order' => 'required|numeric',
            'budget_total' => 'required|numeric',
        ]);
         
        $category = Category::find($id);
 
        $category->name = $request->name;
        $category->order = $request->order;
        $category->budget_total = $request->budget_total;
 
        $category->save();
     
        return redirect()->route('categories.index')
                        ->with('success','Category Has Been updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
     
        return redirect()->route('categories.index')
                        ->with('success','Category has been deleted successfully');
    }
}
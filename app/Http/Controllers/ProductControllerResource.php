<?php

namespace App\Http\Controllers;

use App\Events\SaveProductEvent;
use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductControllerResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $items = Product::query()->first();
//        $items->delete();
//        $products = Product::query()->get();
//        return $products;
        ////////////////////////////////////
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create';
        $routeName = ['products.store'];
        return view('products.save', ['title'=>$title, 'routeName'=>$routeName,'edit'=>false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request)
    {
        DB::beginTransaction();
        event(new SaveProductEvent(request()->except('images'), request()->file('images')));
        DB::commit();
        return redirect()->back()->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        // Debugging the product object
//         dd($product);

        $title = 'Edit';
        $edit = true;
        $routeName = ['products.update', $product->id];

        // Pass variables using compact
        return view('products.save', compact('title', 'routeName', 'edit', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

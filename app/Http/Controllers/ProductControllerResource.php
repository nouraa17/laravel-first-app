<?php

namespace App\Http\Controllers;

use App\Events\SaveProductEvent;
use App\Http\Requests\ProductFormRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\Orders\SaveOrderService;

class ProductControllerResource extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth')->except('index');

    }


    public function index()
    {
//        $items = Product::query()->first();
//        $items->delete();
//        $products = Product::query()->get();
//        return $products;
        ////////////////////////////////////
        $products = Product::query()->with('images')->get();
        foreach ($products as $product){
            if($product->images->count() <= 0){
                $product = null;
            }
        }
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
        $product = Product::query()->with('images')->find($id);
        // Debugging the product object
//         dd($product);


        $title = 'Edit';
        $edit = true;
        $routeName = ['products.update', $product->id];
        if($product==null || $product->user_id != auth()->id() || auth()->user()->type != 'admin'){
            return redirect()->to('/products');
        }

        // Pass variables using compact
        return view('products.save', compact('title', 'routeName', 'edit', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, string $id)
    {
        DB::beginTransaction();

        $product = Product::query()->with('images')->find($id);
        if((sizeof($product->images)==0) && (request()->hasFile('images')==false)){
            return redirect()->back()->withErrors(['error' => 'You should upload at least one image']);
        }
        $basic_data = request()->except('images');
        $basic_data['id'] = $id;
        $basic_data['user_id'] = $product->user_id;

        event(new SaveProductEvent($basic_data, request()->file('images') ?? [], false));
        DB::commit();

        return redirect()->back()->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    public function showBuyPage($id)
    {
        $product = Product::findOrFail($id);
        return view('products.buy', compact('product'));
    }

    public function checkout(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $quantity = $request->input('quantity');
        SaveOrderService::createOrder(auth()->id(), $product, $quantity);


        return redirect()->back()->with('success', 'Order placed successfully!');


    }
}

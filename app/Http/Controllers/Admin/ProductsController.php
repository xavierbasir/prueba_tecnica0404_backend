<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Carbon\Carbon;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $products = Product::whereNull('softDelete')->get();
        return response()->json(['product' => $products], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:10',
            'value' => 'required',
            'description' => 'required|min:10|max:500'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'value' => $request->value,
            'description' => $request->description
        ]);

        return response()->json(['product' => "Product Created Successfully"], 200);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json(['product' => $product], 200);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json(['product' => $product], 200);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return response()->json(['product' => $product,'message' => 'Product Updated Successfully'], 200);
    }

    public function destroy($id)
    {
        Product::where('id', $id)
        ->update(['softDelete' => Carbon::now()]);
        return response()->json(['product' => "",'message' => 'Product Deleted Successfully'], 200);
    }
}

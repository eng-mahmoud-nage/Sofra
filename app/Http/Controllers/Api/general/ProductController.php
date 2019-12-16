<?php

namespace App\Http\Controllers\Api\general;

use App\General\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create_product(Request $request){
        $validator = validator()->make($request->all(), [
            'name' => 'required|unique:products',
            'image' => 'required',
            'price' => 'required',
            'restaurant_id' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }
        $record = Product::create($request->all());
        return ResponseJson(1, 'Your product inserted successfully', ['record' => $record]);
    }

    public function products(){
        $record = Product::all()->load('restaurant');
        return ResponseJson(1, 'Products', ['record' => $record]);
    }

    public function product(Request $request){
        if ($request->has('product_id'))
        {
            $record = Product::where('id', $request->product_id)->get()->load('restaurant');
        }
        return ResponseJson(1, 'Product', ['record' => $record]);
    }

    public function add_discount(Request $request){
        $record = Product::where('id', $request->product_id)->first();
        if ($request->discount >= $record->price){
            return ResponseJson(0, 'Check your discount with price',
                ['price' => $record->price, 'discount' => $request->discount]);
        }
        if ($request->has('product_id'))
        {
            $record->update(['discount' => $request->discount]);
        }
        return ResponseJson(1, 'Your discount updated successfully', ['record' => $record]);
    }
}

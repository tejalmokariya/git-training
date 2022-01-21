<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class ProductService
{

    public static function create($collection = [])
    {
        $product = new Product;
        $product->prod_name = $collection['prod_name'];
        $product->prod_price = $collection['prod_price'];
        $product->user_id = auth()->user()->id;
        $product->save();

        return $product;
    }
    public static function updateProduct(Request $request)
    {
        $id = $request->id;
        $user = Product::find($request->id);

        $user->prod_name = $request['prod_name'];
        $user->prod_price = $request['prod_price'];

        if (auth()->user()->id == $user->user_id) {
            $user->user_id = auth()->user()->id;
            $user->save();
            return $user;
        }
    }
    public static function productById($id)
    {
        return Product::find($id);
    }
    public static function getAll($id)
    {
        return Product::all();
        $product = Product::where(auth()->user()->id == 'user_id')->get();
    }

    public static function destroy(Request $request)
    {
        $deletes =  Product::find($request->id)->delete();
        return $deletes;
    }
    public static function rating(Request $request)
    {
        $rating = new Rating();
        $rating->review = $request->review;
        $rating->rating = $request->rating;
        $rating->product_id = $request->product_id;
        $rating->user_id = auth()->user()->id;
        $rating->save();
        return $rating;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;

use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ProductService;
use Exception;

class ProductController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prod_name' => 'required',
            'prod_' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }
        $collection = $request->except(['_token', '_method']);
        $product = ProductService::create($collection);
        return response()->json(['Status' => 'success', 'product' => $product, 'message' => 'Add Product Successfully']);
    }

    public  function updateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prod_name' => 'required',
            'prod_' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }
        $requests = $request->except(['_token', '_method']);
        $product = ProductService::updateProduct($request);
        return response()->json(['Status' => 'success', 'product' => $product, 'message' => 'Product update']);
    }

    public function getProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }
        $requests = $request->except(['_token', '_method']);
        $product = ProductService::productById($request); 
        if ($product !== null) {
            return response()->json(['Status' => 'success', 'product' => $product, 'message' => 'Product details']);
        }
        return response()->json(['Status' => 'fail', 'message' => 'Product Not details'], 404);
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }
        $deletes = ProductService::destroy($request);
        return response()->json(['Status' => 'success', 'product deleted' => $deletes, 'message' => 'Product deleted']);
    }
}

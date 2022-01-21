<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'review' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
        ]);
        if($validator->fails())
        {
            return $this->sendError('Error validation', $validator->errors());       
        }
        $collection = $request->except(['_token','_method']);
        $entries = ProductService::rating($request);
        return response()->json(['Status' => 'success','Rating' => $collection,'message' => 'Rating Added', ]);
       
    }
    
}


<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ProductService;


class ProductController extends BaseController
{
    public $product;
    public function __construct(ProductService $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prod_name' => 'required',
            'prod_price' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
           $add =  Product::create([
                'prod_name'=>$request->prod_name,
                'prod_price'=>$request->prod_price,
            ]);
            // dd($add);

            return $this->sendResponse($add,'Add Product Successfully');
            
        }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         $validator = Validator::make($request->all(), [
          'id' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
        $details =  Product::find($request->id);

        return $this->sendResponse($details,'Product Details Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prod_name' => 'required',
            'prod_price' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
       
        $update =  Product::find($request->id);
        $update->prod_name = $request->prod_name;
        $update->prod_price = $request->prod_price;
        $update->update();
      
        return $this->sendResponse($update,'Update Product Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
       
        $delete =  Product::find($request->id);
        $delete->delete();
        return $this->sendResponse($delete,'Delete Product Successfully');
    }

    public function saveUser(Request $request, $id = null)
    {   
         $collection = $request->except(['_token','_method']);
      
        if( ! is_null( $id ) ) 
        {
            $this->product->createOrUpdate($id, $collection);
        }
        else
        {
            $this->product->createOrUpdate($id = null, $collection);
            
        }
        return $this->sendResponse($collection,'Add Product Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {

        $validator = $request->validate([
            'name' => ['required', 'unique:posts', 'max:255'],
            'detail' => ['required', 'min:3', 'max:1000'],
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$'],
            'stock' => 'required',
            'discount' => 'required',
        ]);

        if($validator->fails()){
            return response()->json('Validation Error.', $validator->errors());
        }

        $product = new Product;
        $product->name = $request->name;
        $product->detail = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount = $request->discount;

        $product->save();

        return response([

            'data' => new ProductResource($product)

        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        $validator = $request->validate([
            'name' => ['required', 'unique:posts', 'max:255'],
            'detail' => ['required', 'min:3', 'max:1000'],
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$'],
            'stock' => 'required',
            'discount' => 'required',
        ]);

        if($validator->fails()){
            return response()->json('Validation Error.', $validator->errors());
        }

        $this->userAuthorize($product);

        $request['detail'] = $request->description;

        unset($request['description']);

        $product->update($request->all());

        return response([

            'data' => new ProductResource($product)

        ],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response(null,Response::HTTP_NO_CONTENT);
    }


    public function userAuthorize($product)
    {
        if(Auth::user()->id != $product->user_id){
            return "exception";
        }
    }
}

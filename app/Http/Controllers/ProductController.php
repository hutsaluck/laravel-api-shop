<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\ProductResource;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth:api')->except('index','show');
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ProductResource::collection(Product::with('category')->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductRequest  $request
     * @return ProductResource
     */
    public function store(ProductRequest $request): ProductResource
    {
        $product = Product::create($request->validated());

        return ProductResource::make($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductUpdateRequest  $request
     * @param  Product  $product
     * @return ProductResource
     */
    public function update(ProductUpdateRequest $request, Product $product): ProductResource
    {
        $product->update($request->validated());

        if(auth('admin')->user()->cannot('update', $product)){
            abort(403);
        }

        return ProductResource::make($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product): \Illuminate\Http\Response
    {
        $product->delete();

        return response("Product deleted",Response::HTTP_OK);
    }
}

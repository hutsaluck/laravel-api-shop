<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryProductRequest;
use App\Http\Requests\UpdateCategoryProductRequest;
use App\Http\Resources\CategoryResource;
use App\Models\CategoryProduct;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CategoryResource::collection(CategoryProduct::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryProductRequest  $request
     * @return CategoryResource
     */
    public function store(StoreCategoryProductRequest $request): CategoryResource
    {
        $category = CategoryProduct::create($request->validated());

        return CategoryResource::make($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryProduct  $categoryProduct
     * @return CategoryResource
     */
    public function show(CategoryProduct $categoryProduct): CategoryResource
    {
        return new CategoryResource($categoryProduct);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryProductRequest  $request
     * @param  \App\Models\CategoryProduct  $categoryProduct
     * @return CategoryResource
     */
    public function update(UpdateCategoryProductRequest $request, CategoryProduct $categoryProduct): CategoryResource
    {
        $categoryProduct->update($request->validated());

        return CategoryResource::make($categoryProduct);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryProduct  $categoryProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryProduct $categoryProduct)
    {
        $categoryProduct->delete();

        return response("Category Product deleted",Response::HTTP_OK);
    }
}

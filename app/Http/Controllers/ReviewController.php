<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Http\Requests\ReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Product $product): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ReviewResource::collection($product->reviews);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ReviewResource
     */
    public function store(ReviewRequest $request, Product $product): ReviewResource
    {
        $review = Review::create($request->validated());
        $product->reviews()->save($review);

        return ReviewResource::make($review);
    }

    /**
     * Display the specified resource.
     *
     * @param  Review  $review
     * @return ReviewResource
     */
    public function show(Review $review): ReviewResource
    {
        return new ReviewResource($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return ReviewResource
     */
    public function update(ReviewRequest $request, Review $review): ReviewResource
    {
        $review->update($request->validated());

        return ReviewResource::make($review);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review): \Illuminate\Http\Response
    {
        $review->delete();

        return response("Review deleted",Response::HTTP_OK);
    }
}

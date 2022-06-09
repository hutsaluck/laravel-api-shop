<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return ReviewResource::collection($product->reviews);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ReviewRequest $request , Product $product)
    {
        $validator = Validator::make($request->all(), [
            'customer' => ['required', 'min:3', 'max:255'],
            'review' => ['required', 'min:3', 'max:1000'],
            'star' => ['required', 'regex:/^\d+(\.\d{1,2})?$'],
        ])->validate();

        if($validator->fails()){
            return response()->json('Validation Error.', $validator->errors());
        }

        $review = new Review($request->all());

        $product->reviews()->save($review);

        return response([
            'data' => new ReviewResource($review)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Review $review)
    {
        $validator = Validator::make($request->all(), [
            'customer' => ['required', 'min:3', 'max:255'],
            'review' => ['required', 'min:3', 'max:1000'],
            'star' => ['required', 'regex:/^\d+(\.\d{1,2})?$'],
        ])->validate();

        if($validator->fails()){
            return response()->json('Validation Error.', $validator->errors());
        }

        $review->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Review $review)
    {
        $review->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}

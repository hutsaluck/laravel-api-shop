<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReviewResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.

     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(User $user): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return OrderResource::collection($user->orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @paramv StoreOrderRequest  $request
     * @return OrderResource
     */
    public function store(StoreOrderRequest $request, User $user):OrderResource
    {
        $order = Order::create($request->validated());
        $user->orders()->save($order);

        return OrderResource::make($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response|OrderResource
     */
    public function show(Order $order): \Illuminate\Http\Response|OrderResource
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return OrderResource
     */
    public function update(UpdateOrderRequest $request, Order $order): OrderResource
    {
        $order->update($request->validated());

        return OrderResource::make($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order): \Illuminate\Http\Response
    {
        $order->delete();

        return response("Order deleted",Response::HTTP_OK);
    }
}

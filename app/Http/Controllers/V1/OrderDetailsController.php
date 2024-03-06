<?php

namespace App\Http\Controllers\V1;

use App\Filters\V1\OrderDetailsFilter;
use App\Http\Controllers\Controller;

use App\Models\Order_Details;
use App\Http\Requests\StoreOrder_DetailsRequest;
use App\Http\Requests\UpdateOrder_DetailsRequest;
use App\Http\Resources\V1\Order_DetailsCollection;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new OrderDetailsFilter();
        $queryItems = $filter->transform($request);

        if(count($queryItems) == 0) {
            return new Order_DetailsCollection(Order_Details::paginate());
        } else {
            return new Order_DetailsCollection(Order_Details::where($queryItems)->paginate()->withQueryString());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrder_DetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order_Details $order_Details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order_Details $order_Details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrder_DetailsRequest $request, Order_Details $order_Details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order_Details $order_Details)
    {
        //
    }
}
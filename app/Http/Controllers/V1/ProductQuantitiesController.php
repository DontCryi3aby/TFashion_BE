<?php

namespace App\Http\Controllers\V1;

use App\Filters\V1\ProductQuantitiesFilter;
use App\Http\Controllers\Controller;

use App\Models\ProductQuantities;
use App\Http\Requests\StoreProductQuantitiesRequest;
use App\Http\Requests\UpdateProductQuantitiesRequest;
use App\Http\Resources\V1\ProductQuantityCollection;
use Illuminate\Http\Request;

class ProductQuantitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ProductQuantitiesFilter();
        $queryItems = $filter->transform($request);

        if(count($queryItems) == 0) {
            return new ProductQuantityCollection(ProductQuantities::paginate());
        } else {
            return new ProductQuantityCollection(ProductQuantities::where($queryItems)->paginate()->withQueryString());
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
    public function store(StoreProductQuantitiesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductQuantities $productQuantities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductQuantities $productQuantities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductQuantitiesRequest $request, ProductQuantities $productQuantities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductQuantities $productQuantities)
    {
        //
    }
}
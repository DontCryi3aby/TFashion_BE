<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;

use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Symfony\Component\HttpFoundation\Request;
use App\Filters\V1\ProductsFilter;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ProductsFilter();
        
        // Filter
        [$sort, $queryItems] = $filter->transform($request);
        $products = Product::where($queryItems)->with('galleries');

        // Sort
        if($sort['field']) {
            $products = $products->orderBy($sort['field'], $sort['type']);
        }

        return new ProductCollection($products->paginate()->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return new ProductResource(Product::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $product = $product->loadMissing('galleries');
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            'status'=> 200,
            'message' => "Product deleted successfully!"
        ]);
    }
}
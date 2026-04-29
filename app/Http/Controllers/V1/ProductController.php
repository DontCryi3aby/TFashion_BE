<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Filters\V1\ProductsFilter;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filter = new ProductsFilter();

        [$sort, $queryItems] = $filter->transform($request);
        $products = Product::with('vendor')->where($queryItems);

        if ($sort['field']) {
            $products = $products->orderBy($sort['field'], $sort['type']);
        }

        $paginate = $request->query('per_page') ?? 15;

        return new ProductCollection($products->paginate($paginate)->withQueryString());
    }

    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::create($request->validated())->load('vendor');
            DB::commit();

            return new ProductResource($product);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function show($id)
    {
        $product = Product::with('vendor')->findOrFail($id);

        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->update($request->validated());
            DB::commit();

            return new ProductResource($product->fresh('vendor'));
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Product deleted successfully!',
        ]);
    }
}

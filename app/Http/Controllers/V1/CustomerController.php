<?php

namespace App\Http\Controllers\V1;

use App\Filters\V1\CustomersFilter;
use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CustomersFilter();
        $queryItems = $filter->transform($request);

        $customers = Customer::where($queryItems);
        return new CustomerCollection($customers->paginate()->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json([
            'status'=> 200,
            'message' => "Customer deleted successfully!"
        ]);
    }
}
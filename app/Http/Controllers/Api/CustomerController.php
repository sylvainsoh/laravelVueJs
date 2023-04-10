<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Collection\Collection;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CustomerResource::collection(Customer::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return CustomerResource
     */
    public function store(Request $request)
    {
        $request->validate(
                [
                    'name'=>'required',
                    'tel'=>'required',
                    'is_favourite'=>'nullable|boolean'
                ]
        );

        $customer=Customer::create([
            'name'=>$request->name,
            'tel'=>$request->tel,
            'is_favourite'=>$request->is_favourite ?? 0
        ]);

        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return CustomerResource
     */
    public function show(Customer $customer) : CustomerResource
    {
        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @return CustomerResource
     */
    public function update(Request $request, Customer $customer) : CustomerResource
    {
        $request->validate(
            [
                'name'=>'required',
                'tel'=>'required',
                'is_favourite'=>'required|boolean'
            ]
        );

        $customer->update($request->only(['name','tel','is_favourite']));

        return new CustomerResource($customer);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->noContent();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BusinessMaster;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BusinessMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businesses = BusinessMaster::with('customer')->get();
        $customers = Customer::all();
        return view('business.index', compact('businesses', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_no' => 'nullable|string|max:15',
            'location' => 'nullable|string|max:255',
            'policy_note' => 'nullable|string',
            'business_status' => 'required|string',
        ]);

        BusinessMaster::create($request->all());

        return redirect()->route('business.index')->with('success', 'Business created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusinessMaster $business)
    {
        $customers = Customer::all();
        return view('business.edit', compact('business', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BusinessMaster $business)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_no' => 'nullable|string|max:15',
            'location' => 'nullable|string|max:255',
            'policy_note' => 'nullable|string',
            'business_status' => 'required|string',
        ]);

        $business->update($request->all());

        return redirect()->route('business.index')->with('success', 'Business updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusinessMaster $business)
    {
        $business->delete();
        return redirect()->route('business.index')->with('success', 'Business deleted successfully.');
    }
}

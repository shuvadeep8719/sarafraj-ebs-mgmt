<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $banks = Bank::paginate(10);
        return view('banks.index', compact('banks'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('banks.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
                    'code' => 'required|string|max:20|unique:banks',
                    'name' => 'required|string|max:150',
                    'description' => 'nullable|string|max:255',
                    'status' => 'boolean',
                ]);

        Bank::create($data);

        return redirect()->route('banks.index')->with('success', 'Bank created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Bank $bank)
    {
        return view('banks.edit', compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        return view('banks.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {

        $data = $request->validate([
                    'code' => 'required|string|max:20|unique:banks,code,' . $bank->id,
                    'name' => 'required|string|max:150',
                    'description' => 'nullable|string|max:255',
                    'status' => 'boolean',
                ]);

        $bank->update($data);

        return redirect()->route('banks.index')->with('success', 'Bank updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {

        $bank->delete();
        return redirect()->route('banks.index')->with('success', 'Bank deleted successfully.');

    }
}

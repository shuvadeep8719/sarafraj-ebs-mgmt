<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;
use App\Models\CustomerBankAccount;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //$customers = Customer::with('bankAccounts', 'documents')->paginate(10);

        $customers = Customer::with([
            'bankAccounts.bank',
            'bankAccounts.socialSchemes'])
                    //->paginate(10);
                    ->get();
        //dd($customers);

        $user = $this->user;
        return view('customers.index', compact('customers', 'user'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $banks = Bank::all()->where('status', '=', 1);


        return view('customers.create', compact('banks'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {


            $data = $request->validate([
                'bank_name'           => 'required|string|max:150',
                'account_no'          => 'required|digits_between:9,18',
                'account_create_date' => 'required|date',
                'customer_nm'         => 'required|string|max:150',
                'mobile_no'           => 'required|digits:10|unique:customers,mobile_no',
                'alternate_no'        => 'nullable|digits:10|different:mobile_no',
                'addr_details'        => 'nullable|string|max:255',
                'location'            => 'nullable|string|max:100',
                'aadhaar_no'          => 'nullable|string|max:20|unique:customers,aadhaar_no',
                'supporting_document' => 'nullable|string|max:150',
                'pan_no'              => 'nullable|string|max:20',
                'apy_status'          => 'nullable|in:active,not_active,closed',
                'apy_active_date'     => 'nullable|date',
                'pmjjby_status'       => 'nullable|in:active,not_active,closed',
                'pmjjby_active_date'  => 'nullable|date',
                'pmsby_status'        => 'nullable|in:active,not_active',
                'gender'              => 'nullable|string|max:10',
                'age'                 => 'nullable|in:Major,Minor',
                'atm_status'          => 'nullable|in:no,yes',
                'passbk_status'       => 'nullable|in:no,yes',
                'image_attachment'    => ['nullable','image','mimes:jpeg,jpg','max:2048'],
                'pdf_attachment'      => ['nullable','mimes:pdf','max:4096'],
            ], [
                'alternate_no.different' => 'Alternate mobile number must be different from mobile number.',
            ]);


            //$customer = Customer::create($data);

            //return redirect()->route('customers.index')->with('success', 'Customer created successfully.');

            // 🧱 2. Create Customer
            $customer = Customer::create([
                'name'                   => $data['customer_nm'],
                'mobile_no'              => $data['mobile_no'],
                'alternate_no'           => $data['alternate_no'] ?? null,
                'addr_details'           => $data['addr_details'] ?? null,
                'location'               => $data['location'] ?? null,
                'aadhaar_no'             => $data['aadhaar_no'] ?? null,
                'user_identification_mark' => $data['customer_identification'] ?? null,
                'gender'                 => $data['gender'] ?? null,
                'age_classification'     => $data['age'],
                'supporting_doc'        => $data['supporting_document'] ?? null,
                'pan_no'                => $data['pan_no'] ?? null,
            ]);

            // 🏦 3. Create Bank Account
            $bankAccount = $customer->bankAccounts()->create([
                'bank_id'              => $data['bank_name'],
                'account_number'       => $data['account_no'],
                'account_type'         => $data['account_type'] ?? null,
                'ifsc_code'            => $data['ifsc_code'] ?? null,
                'branch_name'          => $data['branch_name'] ?? null,
                'account_creation_date' => $data['account_create_date'],
                'passbook_received'    => $data['passbk_status'] ?? 'no',
                'atm_received'         => $data['atm_status'] ?? 'no',
                'is_primary'           => 1,
            ]);

            // 💸 4. Create Social Schemes
            $schemes = [];

            if (!empty($data['apy_status'])) {
                $schemes[] = [
                    'social_scheme_id' => 1, // ID for Atal Pension Yojana
                    'is_active'        => $data['apy_status'],
                    'activation_date'  => $data['apy_active_date'] ?? null,
                ];
            }

            if (!empty($data['pmjjby_status'])) {
                $schemes[] = [
                    'social_scheme_id' => 2, // ID for PMJJBY
                    'is_active'        => $data['pmjjby_status'],
                    'activation_date'  => $data['pmjjby_active_date'] ?? null,
                ];
            }

            if (!empty($data['pmsby_status'])) {
                $schemes[] = [
                    'social_scheme_id' => 3, // ID for PMSBY
                    'is_active'        => $data['pmsby_status'],
                    'activation_date'  => $data['pmsby_activation_date'] ?? null,
                ];
            }

            foreach ($schemes as $scheme) {
                //$bankAccount->socialSchemes()->create($scheme);

                $bankAccount->socialSchemes()->attach($scheme['social_scheme_id'], [
                    'is_active' => $scheme['is_active'],
                    'activation_date' => $scheme['activation_date']
                ]);
            }

            // 📎 5. Upload Documents
            $uploads = [];

            if ($request->hasFile('image_attachment')) {
                $imagePath = $request->file('image_attachment')->store('customers/images', 'public');
                $uploads[] = [
                    'doc_type' => 'image',
                    'file_path' => $imagePath,
                    'file_type' => 'jpeg',
                ];
            }

            if ($request->hasFile('pdf_attachment')) {
                $pdfPath = $request->file('pdf_attachment')->store('customers/docs', 'public');
                $uploads[] = [
                    'doc_type' => 'pdf',
                    'file_path' => $pdfPath,
                    'file_type' => 'pdf',
                ];
            }

            foreach ($uploads as $upload) {
                $customer->documents()->create($upload);
            }

            DB::commit();

            return redirect()->route('customers.index')
                ->with('success', "Customer {$customer->name} registered successfully!");


        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Customer registration failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Something went wrong while saving customer data. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {

        $customer->load('documents', 'bankAccounts.schemes');
        return view('customers.show', compact('customer'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {

        // Eager load related bank account + bank + social schemes
        $customer->load([
            'bankAccounts.bank',
            'bankAccounts.socialSchemes',
            'documents'
        ]);
        $banks = Bank::pluck('name', 'id');



        // Get the primary bank account for prefill
        $bankAccount = $customer->bankAccounts->firstWhere('is_primary', 1);

        // Load all available scheme masters (APY, PMJJBY, PMSBY)
        $socialSchemes = \App\Models\SocialScheme::all(['id', 'code', 'name']);

        // Map existing pivot data for that bank account
        $existingSchemes = $bankAccount
            ? $bankAccount->socialSchemes->keyBy('code') // keyed by APY, PMJJBY, PMSBY
            : collect();

        return view('customers.edit', compact('customer', 'banks', 'socialSchemes', 'existingSchemes'));


        //return view('customers.edit', compact('customer'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {

        DB::beginTransaction();


        try {

            $data = $request->validate([
                            'bank_name'           => 'required|string|max:150',
                            'account_no'          => 'required|digits_between:9,18',
                            'account_create_date' => 'required|date',
                            'customer_nm'         => 'required|string|max:150',
                            'mobile_no'           => 'required|digits:10|unique:customers,mobile_no,' . $customer->id,
                            'alternate_no'        => 'nullable|digits:10|different:mobile_no',
                            'addr_details'        => 'nullable|string|max:255',
                            'location'            => 'nullable|string|max:100',
                            'aadhaar_no'          => 'nullable|string|max:20|unique:customers,aadhaar_no,'. $customer->id,
                            'supporting_document' => 'nullable|string|max:150',
                            'pan_no'              => 'nullable|string|max:20',
                            'apy_status'          => 'nullable|in:active,not_active,closed',
                            'apy_active_date'     => 'nullable|date',
                            'pmjjby_status'       => 'nullable|in:active,not_active,closed',
                            'pmjjby_active_date'  => 'nullable|date',
                            'pmsby_status'        => 'nullable|in:active,not_active,closed',
                            'gender'              => 'nullable|string|max:10',
                            'age'                 => 'nullable|in:Major,Minor',
                            'atm_status'          => 'nullable|in:no,yes',
                            'passbk_status'       => 'nullable|in:no,yes',
                            'image_attachment'    => ['nullable','image','mimes:jpeg,jpg','max:2048'],
                            'pdf_attachment'      => ['nullable','mimes:pdf','max:4096'],
                        ], [
                            'alternate_no.different' => 'Alternate mobile number must be different from mobile number.',
                        ]);

            //DB::transaction(function () use ($data, $customer) {
            // update customer basic info
            $customer->update([
                            'name'                   => $data['customer_nm'],
                            'mobile_no'              => $data['mobile_no'],
                            'alternate_no'           => $data['alternate_no'] ?? null,
                            'addr_details'           => $data['addr_details'] ?? null,
                            'location'               => $data['location'] ?? null,
                            'aadhaar_no'             => $data['aadhaar_no'] ?? null,
                            'user_identification_mark' => $data['customer_identification'] ?? null,
                            'gender'                 => $data['gender'] ?? null,
                            'age_classification'     => $data['age'],
                            'supporting_doc'        => $data['supporting_document'] ?? null,
                            'pan_no'                => $data['pan_no'] ?? null,
            ]);


            // update or create the customer’s primary bank account
            $customer->bankAccounts()->update(
                [
                            'bank_id'              => $data['bank_name'],
                            'account_number'       => $data['account_no'],
                            'account_type'         => $data['account_type'] ?? null,
                            'ifsc_code'            => $data['ifsc_code'] ?? null,
                            'branch_name'          => $data['branch_name'] ?? null,
                            'account_creation_date' => $data['account_create_date'],
                            'passbook_received'    => $data['passbk_status'] ?? 'no',
                            'atm_received'         => $data['atm_status'] ?? 'no',
                            'is_primary'           => 1,

                ]
            );


            $bankAccount = $customer->bankAccounts()->where('is_primary', 1)->first();


            if ($bankAccount) {
                // Collect schemes from the request
                $syncData = [];

                $schemesInput = [
                    'APY' => [
                        'status' => $data['apy_status'],
                        'date' => $data['apy_active_date'],
                    ],
                    'PMJJBY' => [
                        'status' => $data['pmjjby_status'],
                        'date' => $data['pmjjby_active_date'],
                    ],
                    'PMSBY' => [
                        'status' => $data['pmsby_status'],
                        'date' => null,
                    ],
                ];

                foreach ($schemesInput as $code => $data) {
                    if (!empty($data['status']) && $data['status'] !== 'not_active') {
                        $schemeMaster = \App\Models\SocialScheme::where('code', $code)->first();
                        if ($schemeMaster) {
                            $syncData[$schemeMaster->id] = [
                                'is_active' => $data['status'],
                                'activation_date' => $data['date'],
                                'updated_at' => now(),
                            ];
                        }
                    }
                }

                // Sync pivot table (add/update/remove automatically)
                $bankAccount->socialSchemes()->sync($syncData);
            }


            // --- Handle uploads ---

            $imagePath = null;

            if (isset($data['image_attachment'])) {
                $file = $data['image_attachment'];
                $imagePath = $file->store('customers/photos', 'public');


                $customer->documents()->updateOrCreate(
                    ['file_type' => $file->getClientOriginalExtension()], // Will be 'jpg' or 'jpeg'
                    [
                        'file_path' => $imagePath,
                        'original_name' => $file->getClientOriginalName(),
                    ]
                );

            }

            if (isset($data['pdf_attachment'])) {
                $file = $data['pdf_attachment'];
                $pdfPath = $file->store('customers/pdfs', 'public');

                $customer->documents()->updateOrCreate(
                    ['file_type' => 'pdf'],
                    [
                        'file_path' => $pdfPath,
                        'original_name' => $file->getClientOriginalName(),
                    ]
                );
            }



            DB::commit();
            //});

        } catch (ValidationException $e) {

            return back()->withErrors($e->validator)->withInput();

        } catch (Exception $ex) {
            DB::rollBack();
            echo $ex->getMessage();
            die;
        }


        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {

        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');

    }

    public function validateBankAccount(Request $request)
    {

        $validator = Validator::make($request->all(), [
                    'account_no' => ['required', 'digits_between:9,18', 'regex:/^[0-9]+$/']
                ]);


        if ($validator->fails()) {
            return response()->json(['valid' => false, 'errors' => $validator->errors()->first('account_no')]);
        }



        // Check existence in related model (customer_bank_accounts)
        //$exists = CustomerBankAccount::where('account_number', $request->account_no)->exists();
        $query = CustomerBankAccount::where('account_number', $request->account_no);

        // If editing, exclude current customer’s own record
        if ($request->filled('customer_id')) {
            $query->where('customer_id', '!=', $request->customer_id);
        }

        $exists = $query->exists();


        if ($exists) {
            return response()->json([
                'valid' => false,
                'errors' => 'Account number already exists in another customer’s record.',
            ]);
        }


        return response()->json(['valid' => true]);

    }
}

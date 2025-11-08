@extends('layouts.after-login')

@section('title', 'View Customer')

@section('content')
<div id="customerForm" class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-eye me-2"></i>View Customer</h5>
    </div>
    <div class="card-body">
        @php
            $primaryBankAccount = $customer->bankAccounts->firstWhere('is_primary', 1);
        @endphp
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Select Bank *</label>
                <input type="text" class="form-control" value="{{ optional(optional($primaryBankAccount)->bank)->name }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Account No *</label>
                <input type="text" class="form-control" value="{{ optional($primaryBankAccount)->account_number }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Account Creation Date *</label>
                <input type="date" class="form-control" value="{{ optional($primaryBankAccount)->account_creation_date }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Customer Name (As per Aadhar) *</label>
                <input type="text" class="form-control" value="{{ $customer->name }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Mobile No *</label>
                <input type="tel" class="form-control" value="{{ $customer->mobile_no }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Alternate No</label>
                <input type="tel" class="form-control" value="{{ $customer->alternate_no }}" readonly>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Address Details</label>
                <textarea class="form-control" rows="3" readonly>{{ $customer->addr_details }}</textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Location *</label>
                <input type="text" class="form-control" value="{{ $customer->location }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Aadhar No *</label>
                <input type="text" class="form-control" value="{{ $customer->aadhaar_no }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Supporting Document</label>
                <input type="text" class="form-control" value="{{ $customer->supporting_doc == 1 ? 'PAN' : ($customer->supporting_doc == 2 ? 'Form 60' : '') }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">PAN No</label>
                <input type="text" class="form-control" value="{{ $customer->pan_no }}" readonly>
            </div>
        </div>

        <hr>
        <h6 class="text-primary mb-3">Social Security Schemes</h6>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Atal Pension Yojana</label>
                <input type="text" class="form-control" value="{{ optional($existingSchemes->get('APY'))->pivot->is_active ?? 'Not Active' }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">APY Activation Date</label>
                <input type="date" class="form-control" value="{{ optional($existingSchemes->get('APY'))->pivot->activation_date ?? '' }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">PMJJBY</label>
                <input type="text" class="form-control" value="{{ optional($existingSchemes->get('PMJJBY'))->pivot->is_active ?? 'Not Active' }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">PMJJBY Activation Date</label>
                <input type="date" class="form-control" value="{{ optional($existingSchemes->get('PMJJBY'))->pivot->activation_date ?? '' }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">PMSBY</label>
                <input type="text" class="form-control" value="{{ optional($existingSchemes->get('PMSBY'))->pivot->is_active ?? 'Not Active' }}" readonly>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Gender *</label>
                <input type="text" class="form-control" value="{{ ucfirst($customer->gender) }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Age Classification *</label>
                <input type="text" class="form-control" value="{{ $customer->age_classification }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">ATM Received</label>
                <input type="text" class="form-control" value="{{ ucfirst(optional($primaryBankAccount)->atm_received) }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Passbook Received</label>
                <input type="text" class="form-control" value="{{ ucfirst(optional($primaryBankAccount)->passbook_received) }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">User Mark OR Referral</label>
                <input type="text" class="form-control" value="{{ $customer->user_identification_mark }}" readonly>
            </div>
        </div>
        <div class="row">
            @foreach($customer->documents as $document)
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ ucfirst($document->doc_type) }}</label>
                    @if($document->doc_type == 'image')
                        <img src="{{ asset('storage/' . $document->file_path) }}" alt="Customer Image" class="img-fluid">
                    @else
                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">View PDF</a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
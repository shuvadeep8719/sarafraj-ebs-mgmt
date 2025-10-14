@extends('layouts.after-login')

@section('title', 'Customer Management')

@section('content')
<div id="customerForm" class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Create Customer</h5>
                            </div>
                            <div class="card-body">
                                <form method="post" name="customer_frm" action="{{ route('customers.update', $customer->id) }}" enctype="multipart/form-data">
                                    @csrf
                                   @method('PUT')
                                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Select Bank *</label>
                                            <select class="form-select" name="bank_name" required>
                                                <option value="">Choose Bank</option>
                                                <!-- <option value="1">Bank of Maharashtra</option>
                                                <option value="2">IndusInd Bank</option>
                                                <option value="3">Airtel Payments Bank</option>
                                                <option value="5">Others / Referral</option> -->
                                                @foreach($banks AS $id => $name)
                                                <option value="{{ $id }}" {{ optional($customer->bankAccounts->first())->bank_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Account No *</label>
                                            <input type="text" name="account_no" id="account_no" value="{{ old('account_no', optional($customer->bankAccounts->first())->account_number) }}" class="form-control" required>
                                            <small id="acc-error" class="text-danger"></small>
                                            @error('account_no') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Account Creation Date *</label>
                                            <input type="date" name="account_create_date" value="{{ old('account_create_date', optional($customer->bankAccounts->first())->account_creation_date) }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Customer Name (As per Aadhar) *</label>
                                            <input type="text" name="customer_nm" value="{{ old('customer_nm', $customer->name) }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Mobile No *</label>
                                            <input type="tel" name="mobile_no" id="mobile_no" class="form-control" value="{{ old('mobile_no', $customer->mobile_no) }}" required>
                                            @error('mobile_no') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Alternate No</label>
                                            <input type="tel" name="alternate_no" id="alternate_no" value="{{ old('alternate_no', $customer->alternate_no) }}" class="form-control">
                                            <small id="alt-error" class="text-danger"></small>
                                            @error('alternate_no') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Address Details</label>
                                            <textarea class="form-control" name="addr_details" rows="3">{{ old('addr_details', $customer->addr_details) }}</textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Location *</label>
                                            <input type="text" name="location" value="{{ old('location', $customer->location) }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Aadhar No *</label>
                                            <input type="text" name="aadhaar_no" value="{{ old('aadhaar_no', $customer->aadhaar_no) }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Supporting Document</label>
                                            <select class="form-select" name="supporting_document">
                                                <option value="">Select Document</option>
                                                <option value="pan" {{ optional($customer->supporting_doc) == 'pan' ? 'selected' : '' }}>PAN</option>
                                                <option value="form_60" {{ optional($customer->supporting_doc) == 'form_60' ? 'selected' : '' }}>Form 60</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">PAN No</label>
                                            <input type="text" name="pan_no" value="{{ old('pan_no', $customer->pan_no) }}" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <h6 class="text-primary mb-3">Social Security Schemes</h6>
                                    
                                    <div class="row">
                                        {{-- 🟦 APY --}}
                                        @php
                                            $apy = $existingSchemes->get('APY');
                                        @endphp
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Atal Pension Yojana (APY)</label>
                                            <select class="form-select" name="apy_status" onchange="toggleDate(this, 'apyDate')">
                                                <option value="">Select Status</option>
                                                <option value="active" {{ $apy && $apy->pivot->is_active == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="not_active" {{ $apy && $apy->pivot->is_active == 'not_active' ? 'selected' : '' }}>Not Active</option>
                                                <option value="closed" {{ $apy && $apy->pivot->is_active == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3" id="apyDate"
                                            style="display: {{ $apy && in_array($apy->pivot->is_active, ['active', 'closed']) ? 'block' : 'none' }};">
                                            <label class="form-label">APY Activation Date</label>
                                            <input type="date" name="apy_active_date" value="{{ $apy ? $apy->pivot->activation_date : '' }}" class="form-control">
                                        </div>
                                        {{-- 🟩 PMJJBY --}}
                                        @php
                                            $pmjjby = $existingSchemes->get('PMJJBY');
                                        @endphp
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">PMJJBY</label>
                                            <select class="form-select" name="pmjjby_status" onchange="toggleDate(this, 'pmjjbyDate')">
                                                <option value="">Select Status</option>
                                                <option value="active" {{ $pmjjby && $pmjjby->pivot->is_active == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="not_active" {{ $pmjjby && $pmjjby->pivot->is_active == 'not_active' ? 'selected' : '' }}>Not Active</option>
                                                <option value="closed" {{ $pmjjby && $pmjjby->pivot->is_active == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3" id="pmjjbyDate"
                                            style="display: {{ $pmjjby && in_array($pmjjby->pivot->is_active, ['active', 'closed']) ? 'block' : 'none' }};">
                                            <label class="form-label">PMJJBY Activation Date</label>
                                            <input type="date" name="pmjjby_active_date" value="{{ $pmjjby ? $pmjjby->pivot->activation_date : '' }}" class="form-control">
                                        </div>
                                        {{-- 🟨 PMSBY --}}
                                        @php
                                            $pmsby = $existingSchemes->get('PMSBY');
                                        @endphp
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">PMSBY</label>
                                            <select class="form-select" name="pmsby_status">
                                                <option value="">Select Status</option>
                                                <option value="active" {{ $pmsby && $pmsby->pivot->is_active == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="not_active" {{ $pmsby && $pmsby->pivot->is_active == 'not_active' ? 'selected' : '' }}>Not Active</option>
                                                <option value="closed" {{ $pmsby && $pmsby->pivot->is_active == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Gender *</label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" value="male" {{ old('gender', $customer->gender) == 'male' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" value="female" {{ old('gender', $customer->gender) == 'female' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Age Classification *</label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="age" value="Minor" {{ old('age', $customer->age_classification) == 'Minor' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Minor</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="age" value="Major" {{ old('age', $customer->age_classification) == 'Major' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Major</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">ATM Received</label>
                                            <select class="form-select" name="atm_status">
                                                <option value="no" {{ old('atm_status', $customer->bankAccounts()->first()?->atm_received) == 'no' ? 'selected' : '' }}>No</option>
                                                <option value="yes" {{ old('atm_status', $customer->bankAccounts()->first()?->atm_received) == 'yes' ? 'selected' : '' }}>Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Passbook Received</label>
                                            <select class="form-select" name="passbk_status">
                                                <option value="no" {{ old('passbk_status', $customer->bankAccounts()->first()?->passbook_received) == 'no' ? 'selected' : '' }}>No</option>
                                                <option value="yes" {{ old('passbk_status', $customer->bankAccounts()->first()?->passbook_received) == 'yes' ? 'selected' : '' }}>Yes</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Upload Photo (Optional) (JPEG/JPG)</label>
                                            <input type="file" name="image_attachment" id="image_attachment" class="form-control" accept="image/*">

                                            {{-- ✅ Show existing photo --}}
                                            @php
                                                $photo = $customer->documents->first(function($document){
                                                    return in_array(strtolower($document->file_type), ['jpg', 'jpeg']);
                                                })
                                                
                                            @endphp
                                            @if($photo)
                                                <div class="mt-2">
                                                    <small class="text-muted">Existing Photo:</small><br>
                                                    <a href="{{ asset('storage/' . $photo->file_path) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $photo->file_path) }}" alt="Customer Photo"
                                                            style="max-width: 120px; border-radius: 8px; border: 1px solid #ccc;">
                                                    </a>
                                                    <div>
                                                        <a href="{{ asset('storage/' . $photo->file_path) }}" target="_blank" class="text-primary small">
                                                            View Full Image
                                                        </a>
                                                    </div>
                                                    <!-- delete button -->
                                                </div>
                                            @endif

                                            @error('image_attachment')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Upload PDF (Optional)</label>
                                            <input type="file" name="pdf_attachment" id="pdf_attachment" class="form-control" accept=".pdf">

                                            {{-- ✅ Show existing PDF --}}
                                            @php
                                                $pdf = $customer->documents->firstWhere('file_type', 'pdf');
                                            @endphp
                                            @if($pdf)
                                                <div class="mt-2">
                                                    <small class="text-muted">Existing PDF:</small><br>
                                                    <a href="{{ asset('storage/' . $pdf->file_path) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                                        <i class="bi bi-file-earmark-pdf"></i> View PDF
                                                    </a>
                                                    <div class="small text-muted mt-1">
                                                        {{ $pdf->original_name ?? basename($pdf->file_path) }}
                                                    </div>
                                                    <!-- delete button -->
                                                </div>
                                            @endif

                                            @error('pdf_attachment')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">User Mark OR Referral</label>
                                            <input type="text" name="customer_identification" id="customer_identification" value="{{ old('customer_identification', $customer->user_identification_mark) }}" class="form-control">
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Save Customer
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="hideCustomerForm()">
                                            <i class="fas fa-times me-2"></i>Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
@endsection                        

@push('scripts')
<script type="module" src="{{ asset('js/formValidationManager.js') }}"></script>
@endpush
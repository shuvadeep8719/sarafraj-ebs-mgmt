@extends('layouts.after-login')

@section('title', 'Customer Management')

@section('content')
<div id="customerForm" class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Create Customer</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" name="customer_frm" action="{{ route('customers.store') }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Select Bank *</label>
                                            <select class="form-select" name="bank_name" required>
                                                <option value="">Choose Bank</option>
                                                <!-- <option value="1">Bank of Maharashtra</option>
                                                <option value="2">IndusInd Bank</option>
                                                <option value="3">Airtel Payments Bank</option>
                                                <option value="5">Others / Referral</option> -->
                                                @foreach($banks AS $bank)
                                                <option value="{{ $bank->id }}" {{ old('bank_name') == $bank->id ? 'selected' : '' }}>{{ $bank->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Account No *</label>
                                            <input type="text" name="account_no" id="account_no" value="{{ old('account_no') }}" class="form-control" required>
                                            <small id="acc-error" class="text-danger"></small>
                                            @error('account_no') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Account Creation Date *</label>
                                            <input type="date" name="account_create_date" value="{{ old('account_create_date') }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Customer Name (As per Aadhar) *</label>
                                            <input type="text" name="customer_nm" value="{{ old('customer_nm') }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Mobile No *</label>
                                            <input type="tel" name="mobile_no" id="mobile_no" class="form-control" value="{{ old('mobile_no') }}" required>
                                            @error('mobile_no') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Alternate No</label>
                                            <input type="tel" name="alternate_no" id="alternate_no" value="{{ old('alternate_no') }}" class="form-control">
                                            <small id="alt-error" class="text-danger"></small>
                                            @error('alternate_no') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Address Details</label>
                                            <textarea class="form-control" name="addr_details" rows="3">{{ old('addr_details') }}</textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Location *</label>
                                            <input type="text" name="location" value="{{ old('location') }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Aadhar No *</label>
                                            <input type="text" name="aadhaar_no" value="{{ old('aadhaar_no') }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Supporting Document</label>
                                            <select class="form-select" name="supporting_document">
                                                <option value="">Select Document</option>
                                                <option value="1" {{ old('supporting_document') == 1 ? 'selected' : '' }}>PAN</option>
                                                <option value="2" {{ old('supporting_document') == 2 ? 'selected' : '' }}>Form 60</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">PAN No</label>
                                            <input type="text" name="pan_no" value="{{ old('pan_no') }}" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <h6 class="text-primary mb-3">Social Security Schemes</h6>
                                    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Atal Pension Yojana</label>
                                            <select class="form-select" name="apy_status" onchange="toggleDate(this, 'apyDate')">
                                                <option value="">Select Status</option>
                                                <option value="active" {{ old('apy_status') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="not_active" {{ old('apy_status') == 'not_active' ? 'selected' : '' }}>Not Active</option>
                                                <option value="closed" {{ old('apy_status') == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3" id="apyDate" style="display: {{ old('apy_status') == 'active' || old('apy_status') == 'closed' ? 'block' : 'none'}};">
                                            <label class="form-label">APY Activation Date</label>
                                            <input type="date" name="apy_active_date" value="{{ old('apy_active_date') }}" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">PMJJBY</label>
                                            <select class="form-select" name="pmjjby_status" onchange="toggleDate(this, 'pmjjbyDate')">
                                                <option value="">Select Status</option>
                                                <option value="active" {{ old('pmjjby_status') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="not_active" {{ old('pmjjby_status') == 'not_active' ? 'selected' : '' }}>Not Active</option>
                                                <option value="closed" {{ old('pmjjby_status') == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3" id="pmjjbyDate" style="display: {{ old('pmjjby_status') == 'active' || old('pmjjby_status') == 'closed' ? 'block' : 'none' }};">
                                            <label class="form-label">PMJJBY Activation Date</label>
                                            <input type="date" name="pmjjby_active_date" value="{{ old('pmjjby_active_date') }}" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">PMSBY</label>
                                            <select class="form-select" name="pmsby_status">
                                                <option value="">Select Status</option>
                                                <option value="active" {{ old('pmsby_status') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="not_active" {{ old('pmsby_status') == 'not_active' ? 'selected' : '' }}>Not Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Gender *</label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Age Classification *</label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="age" value="Minor" {{ old('age') == 'Minor' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Minor</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="age" value="Major" {{ old('age') == 'Major' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Major</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">ATM Received</label>
                                            <select class="form-select" name="atm_status">
                                                <option value="no" {{ old('atm_status') == 'no' ? 'selected' : '' }}>No</option>
                                                <option value="yes" {{ old('atm_status') == 'yes' ? 'selected' : '' }}>Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Passbook Received</label>
                                            <select class="form-select" name="passbk_status">
                                                <option value="no" {{ old('passbk_status') == 'no' ? 'selected' : '' }}>No</option>
                                                <option value="yes" {{ old('passbk_status') == 'yes' ? 'selected' : '' }}>Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Upload Photo (Optional) (JPEG/JPG)</label>
                                            <input type="file" name="image_attachment" id="image_attachment" class="form-control" accept="image/*">
                                            @if(old('image_attachment'))
                                                <small>Previously selected: {{ old('image_attachment') }}</small>
                                            @endif
                                            @error('image_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Upload PDF (Optional)</label>
                                            <input type="file" name="pdf_attachment" id="pdf_attachment" class="form-control" accept=".pdf">
                                            @if(old('pdf_attachment'))
                                                <small>Previously selected: {{ old('pdf_attachment') }}</small>
                                            @endif
                                            @error('pdf_attachment') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">User Mark OR Referral</label>
                                            <input type="text" name="customer_identification" id="customer_identification" value="{{ old('customer_identification') }}" class="form-control">
                                            
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
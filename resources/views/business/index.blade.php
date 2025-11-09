@extends('layouts.after-login')

@section('content')
<div id="business" class="page-section animate-fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-briefcase me-2"></i>Target Business</h2>
        <button class="btn btn-primary" onclick="showBusinessForm()">
            <i class="fas fa-plus me-2"></i>Create Business
        </button>
    </div>

    <!-- Business Form -->
    <div id="businessForm" class="card mb-4" style="display: none;">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Create Business</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('business.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Select Investor Type *</label>
                        <select class="form-select" name="investor_type" onchange="toggleInvestorType(this)" required>
                            <option value="">Choose Type</option>
                            <option value="existing">Existing Customer</option>
                            <option value="new">New Customer</option>
                        </select>
                    </div>

                    <div id="existingCustomer" class="col-md-6 mb-3" style="display: none;">
                        <label class="form-label">Existing Customer *</label>
                        <select class="form-select" name="customer_id" id="customer_id">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" data-mobile="{{ $customer->mobile_no }}" data-location="{{ $customer->location }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone No</label>
                        <input type="tel" name="phone_no" id="phone_no" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Policy Details/Note</label>
                        <textarea class="form-control" name="policy_note" rows="3" placeholder="Enter policy details and notes"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Business Status</label>
                        <div class="d-flex">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="business_status" id="follow-up" value="Follow-up" checked>
                                <label class="form-check-label" for="follow-up">Follow-up</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="business_status" id="failed" value="Failed">
                                <label class="form-check-label" for="failed">Failed</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="business_status" id="achieved" value="Achieved">
                                <label class="form-check-label" for="achieved">Achieved</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Save Business
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="hideBusinessForm()">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Business List -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Business List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="businessTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Policy Details/Note</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($businesses as $business)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $business->name }}</td>
                            <td>{{ $business->phone_no }}</td>
                            <td>{{ $business->location }}</td>
                            <td>
                                @php
                                    $badgeClass = 'bg-secondary';
                                    if ($business->business_status == 'Achieved') {
                                        $badgeClass = 'bg-success';
                                    } elseif ($business->business_status == 'Failed') {
                                        $badgeClass = 'bg-danger';
                                    } elseif ($business->business_status == 'Follow-up') {
                                        $badgeClass = 'bg-warning';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $business->business_status }}</span>
                            </td>
                            <td>{{ $business->policy_note }}</td>
                            <td>
                                <a href="{{ route('business.edit', $business->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('business.destroy', $business->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this item?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function showBusinessForm() {
        document.getElementById('businessForm').style.display = 'block';
    }

    function hideBusinessForm() {
        document.getElementById('businessForm').style.display = 'none';
    }

    function toggleInvestorType(select) {
        const existingCustomerDiv = document.getElementById('existingCustomer');
        const nameInput = document.getElementById('name');
        const phoneInput = document.getElementById('phone_no');
        const locationInput = document.getElementById('location');

        if (select.value === 'existing') {
            existingCustomerDiv.style.display = 'block';
        } else {
            existingCustomerDiv.style.display = 'none';
            nameInput.value = '';
            phoneInput.value = '';
            locationInput.value = '';
        }
    }

    $(document).ready(function() {
        $('#customer_id').select2();
    });

    document.getElementById('customer_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const nameInput = document.getElementById('name');
        const phoneInput = document.getElementById('phone_no');
        const locationInput = document.getElementById('location');

        if (this.value) {
            nameInput.value = selectedOption.text;
            phoneInput.value = selectedOption.dataset.mobile;
            locationInput.value = selectedOption.dataset.location;
        } else {
            nameInput.value = '';
            phoneInput.value = '';
            locationInput.value = '';
        }
    });
</script>
@endsection
@endsection

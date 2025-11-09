@extends('layouts.after-login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Business</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business.update', $business->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name *</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $business->name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone No</label>
                                <input type="tel" name="phone_no" id="phone_no" class="form-control" value="{{ $business->phone_no }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" id="location" class="form-control" value="{{ $business->location }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Policy Details/Note</label>
                                <textarea class="form-control" name="policy_note" rows="3" placeholder="Enter policy details and notes">{{ $business->policy_note }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Business Status</label>
                                <div class="d-flex">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="business_status" id="follow-up" value="Follow-up" {{ $business->business_status == 'Follow-up' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="follow-up">Follow-up</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="business_status" id="failed" value="Failed" {{ $business->business_status == 'Failed' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="failed">Failed</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="business_status" id="achieved" value="Achieved" {{ $business->business_status == 'Achieved' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="achieved">Achieved</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Business
                            </button>
                            <a href="{{ route('business.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
            <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Select Investor Type *</label>
                        <select class="form-select" onchange="toggleInvestorType(this)" required>
                            <option value="">Choose Type</option>
                            <option value="existing">Existing Customer</option>
                            <option value="new">New Customer</option>
                        </select>
                    </div>
                    
                    <div id="existingCustomer" class="col-md-6 mb-3" style="display: none;">
                        <label class="form-label">Existing Customer *</label>
                        <select class="form-select">
                            <option value="">Select Customer</option>
                            <option value="1">Rajesh Kumar - 9876543210</option>
                            <option value="2">Priya Sharma - 9876543211</option>
                            <option value="3">Amit Patel - 9876543212</option>
                        </select>
                    </div>
                    
                    <div id="newCustomerFields" style="display: none;">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name *</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone No *</label>
                            <input type="tel" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location *</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Policy Details/Note</label>
                        <textarea class="form-control" rows="3" placeholder="Enter policy details and notes"></textarea>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Business Status</label>
                        <select class="form-select">
                            <option value="">Select Status</option>
                            <option value="targeted">Targeted/Followup</option>
                            <option value="failed">Failed</option>
                            <option value="achieved">Achieved</option>
                        </select>
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
                        <tr>
                            <td>1</td>
                            <td>Rajesh Kumar</td>
                            <td>9876543210</td>
                            <td>Mumbai</td>
                            <td><span class="badge bg-success">Achieved</span></td>
                            <td>Life Insurance Policy - ₹5 Lakh</td>
                            <td>
                                <button class="btn btn-sm btn-outline-warning me-1">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

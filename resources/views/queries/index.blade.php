@extends('layouts.after-login')

@section('content')
<div id="queries" class="page-section animate-fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-question-circle me-2"></i>Banking Queries</h2>
        <button class="btn btn-primary" onclick="showQueryForm()">
            <i class="fas fa-plus me-2"></i>Create Query
        </button>
    </div>

    <!-- Query Form -->
    <div id="queryForm" class="card mb-4" style="display: none;">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-question-circle me-2"></i>Create Query</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Select Customer *</label>
                        <select class="form-select" onchange="fillCustomerDetails(this)" required>
                            <option value="">Choose Customer</option>
                            <option value="1" data-account="20234567890" data-phone="9876543210">Rajesh Kumar</option>
                            <option value="2" data-account="30345678901" data-phone="9876543211">Priya Sharma</option>
                            <option value="3" data-account="40456789012" data-phone="9876543212">Amit Patel</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Account No</label>
                        <input type="text" class="form-control" id="queryAccountNo" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone No</label>
                        <input type="tel" class="form-control" id="queryPhoneNo" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Query Date *</label>
                        <input type="date" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Query Details *</label>
                        <textarea class="form-control" rows="4" placeholder="Describe the query in detail" required></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Query Status</label>
                        <select class="form-select">
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Save Query
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="hideQueryForm()">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Query List -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Query List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="queryTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Account No</th>
                            <th>Phone No</th>
                            <th>Date of Query</th>
                            <th>Query Details</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Rajesh Kumar</td>
                            <td>20234567890</td>
                            <td>9876543210</td>
                            <td>2024-01-15</td>
                            <td>ATM Card not received</td>
                            <td><span class="badge bg-warning">Open</span></td>
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

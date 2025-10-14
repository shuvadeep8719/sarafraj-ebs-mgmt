<div id="dashboard" class="page-section active animate-fade-in">
                        <h2 class="mb-4"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h2>
                        
                        <div class="row dashboard-stats mb-4">
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-users fa-2x text-primary mb-3"></i>
                                        <h4 class="fw-bold">{{ $customersCount }}</h4>
                                        <p class="text-muted mb-0">Total Customers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-briefcase fa-2x text-success mb-3"></i>
                                        <h4 class="fw-bold">{{ $activeBusinessCount }}</h4>
                                        <p class="text-muted mb-0">Active Business</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-question-circle fa-2x text-warning mb-3"></i>
                                        <h4 class="fw-bold">{{ $openQueriesCount }}</h4>
                                        <p class="text-muted mb-0">Open Queries</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-university fa-2x text-danger mb-3"></i>
                                        <h4 class="fw-bold">{{ $partnerBanksCount }}</h4>
                                        <p class="text-muted mb-0">Partner Banks</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Recent Activities</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                            <div class="list-group-item d-flex align-items-center">
                                                <i class="fas fa-user-plus text-success me-3"></i>
                                                <div>
                                                    <h6 class="mb-1">New customer added</h6>
                                                    <small class="text-muted">Rajesh Kumar - Bank of Maharashtra</small>
                                                </div>
                                                <small class="text-muted ms-auto">2 min ago</small>
                                            </div>
                                            <div class="list-group-item d-flex align-items-center">
                                                <i class="fas fa-briefcase text-primary me-3"></i>
                                                <div>
                                                    <h6 class="mb-1">Business target achieved</h6>
                                                    <small class="text-muted">Life Insurance Policy - Priya Sharma</small>
                                                </div>
                                                <small class="text-muted ms-auto">15 min ago</small>
                                            </div>
                                            <div class="list-group-item d-flex align-items-center">
                                                <i class="fas fa-question-circle text-warning me-3"></i>
                                                <div>
                                                    <h6 class="mb-1">New query received</h6>
                                                    <small class="text-muted">ATM Card Issue - Amit Patel</small>
                                                </div>
                                                <small class="text-muted ms-auto">1 hour ago</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Quick Actions</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-grid gap-2">
                                            <a class="btn btn-primary" href=" {{ route('customers.index') }}">
                                                <i class="fas fa-user-plus me-2"></i>Add Customer
                                            </a>
                                            <a class="btn btn-success" href="{{ route('business') }}">
                                                <i class="fas fa-briefcase me-2"></i>Create Business
                                            </a>
                                            <button class="btn btn-warning" onclick="showPage('queries')">
                                                <i class="fas fa-question-circle me-2"></i>Handle Query
                                            </button>
                                            <button class="btn btn-info" onclick="showPage('invoice')">
                                                <i class="fas fa-file-invoice me-2"></i>Generate Invoice
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
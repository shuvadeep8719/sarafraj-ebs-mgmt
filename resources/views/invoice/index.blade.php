@extends('layouts.after-login')

@section('content')
<div id="invoice" class="page-section animate-fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h2><i class="fas fa-file-invoice me-2"></i>Invoice Management</h2>
        <div>
            <button class="btn btn-primary me-2" onclick="generateInvoice()">
                <i class="fas fa-plus me-2"></i>Generate Invoice
            </button>
            <button class="btn btn-success" onclick="window.print()">
                <i class="fas fa-print me-2"></i>Print Invoice
            </button>
        </div>
    </div>

    <div class="card invoice-container">
        <div class="invoice-header">
            <div class="row">
                <div class="col-md-6">
                    <h2><i class="fas fa-university me-2"></i>EXPERTZ BANKING</h2>
                    <p class="mb-0">Banking Management System</p>
                    <p class="mb-0">Mumbai, Maharashtra - 400001</p>
                    <p class="mb-0">Phone: +91 9876543210</p>
                </div>
                <div class="col-md-6 text-end">
                    <h3>INVOICE</h3>
                    <p class="mb-0"><strong>Invoice #:</strong> INV-2024-001</p>
                    <p class="mb-0"><strong>Date:</strong> January 15, 2024</p>
                    <p class="mb-0"><strong>Due Date:</strong> February 15, 2024</p>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Bill To:</h5>
                    <p class="mb-0"><strong>Rajesh Kumar</strong></p>
                    <p class="mb-0">Account: 20234567890</p>
                    <p class="mb-0">Phone: 9876543210</p>
                    <p class="mb-0">Mumbai, Maharashtra</p>
                </div>
                <div class="col-md-6 text-end">
                    <h5>Service Details:</h5>
                    <p class="mb-0">Banking Services & Insurance</p>
                    <p class="mb-0">Period: January 2024</p>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Description</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Rate</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Life Insurance Policy Processing</td>
                            <td class="text-center">1</td>
                            <td class="text-end">₹2,500.00</td>
                            <td class="text-end">₹2,500.00</td>
                        </tr>
                        <tr>
                            <td>Account Maintenance Charges</td>
                            <td class="text-center">1</td>
                            <td class="text-end">₹500.00</td>
                            <td class="text-end">₹500.00</td>
                        </tr>
                        <tr>
                            <td>APY Enrollment Service</td>
                            <td class="text-center">1</td>
                            <td class="text-end">₹300.00</td>
                            <td class="text-end">₹300.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Subtotal:</th>
                            <th class="text-end">₹3,300.00</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">GST (18%):</th>
                            <th class="text-end">₹594.00</th>
                        </tr>
                        <tr class="table-primary">
                            <th colspan="3" class="text-end">Total Amount:</th>
                            <th class="text-end">₹3,894.00</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <h6>Payment Terms:</h6>
                    <p class="small mb-0">Payment is due within 30 days of invoice date.</p>
                    <p class="small mb-0">Late payments may incur additional charges.</p>
                </div>
                <div class="col-md-6 text-end">
                    <h6>Bank Details:</h6>
                    <p class="small mb-0">Account Name: Expertz Banking Pvt Ltd</p>
                    <p class="small mb-0">Account No: 1234567890</p>
                    <p class="small mb-0">IFSC: SBIN0001234</p>
                </div>
            </div>
            
            <hr>
            <div class="text-center">
                <p class="small text-muted mb-0">Thank you for choosing Expertz Banking Services</p>
                <p class="small text-muted mb-0">For any queries, please contact us at support@expertzbanking.com</p>
            </div>
        </div>
    </div>
</div>
@endsection

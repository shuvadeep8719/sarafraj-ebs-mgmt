@extends('layouts.after-login')

@section('title', 'Customer Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users me-2"></i>Customer Management</h2>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Customer
    </a>
</div>

@include('customers.list')
@endsection

@push('scripts')
<script type="text/javascript">
// Initialize DataTables
    $('#customerTable').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[0, 'asc']]
    });
</script>
@endpush

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
        lengthMenu: [5, 10, 25, 50],
        order: [[0, 'asc']],
        pagingType: 'simple_numbers',
        // 👇 Polished Bootstrap 5 Layout
    dom:
        "<'row mb-3'<'col-sm-6'l><'col-sm-6'f>>" +
        "<'table-responsive'tr>" +
        "<'row mt-3'<'col-sm-5'i><'col-sm-7'p>>",

    language: {
        search: "_INPUT_",
        searchPlaceholder: "Search...",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ entries",
        paginate: {
            previous: '&laquo;',
            next: '&raquo;'
        }
    }
    });
</script>
@endpush

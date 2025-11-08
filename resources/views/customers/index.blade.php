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
@push('styles')
<link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
/* Hover & focus state for pagination */
.pagination .page-link:hover,
.pagination .page-link:focus {
    background-color: #0d6efd;
    color: #fff !important;
    border-color: #0d6efd;
    box-shadow: 0 0 0.25rem rgba(13,110,253,0.3);
}

/* Round corners and spacing */
.pagination .page-item:first-child .page-link {
    border-top-left-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}
.pagination .page-item:last-child .page-link {
    border-top-right-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
}

/* Active state consistency */
.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

</style>
@endpush

@push('scripts')
<script type="text/javascript">
// Initialize DataTables
    $('#customerTable').DataTable({
    responsive: true,
    pageLength: 10,
    lengthMenu: [5, 10, 25, 50],
    order: [[0, 'asc']],

    // Bootstrap layout
    dom:
        "<'row align-items-center mb-3'<'col-md-6'l><'col-md-6'f>>" +
        "<'table-responsive'tr>" +
        "<'row align-items-center mt-3'<'col-md-5'i><'col-md-7 d-flex justify-content-end'p>>",

    language: {
        search: "",
        searchPlaceholder: "🔍 Search...",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ entries",
        paginate: {
            previous: "&laquo;",
            next: "&raquo;"
        }
    },

    // Use Bootstrap pagination renderer
    renderer: 'bootstrap',

    initComplete: function () {
        // Style search and length selectors
        $('.dataTables_filter input')
            .addClass('form-control form-control-sm rounded-pill shadow-sm px-3')
            .css('width', 'auto');
        $('.dataTables_length select')
            .addClass('form-select form-select-sm shadow-sm');
    },

    drawCallback: function () {
        // Add Bootstrap classes to pagination
        $('.dataTables_paginate').addClass('d-flex justify-content-end');
        $('.dataTables_paginate ul.pagination').addClass('pagination-sm mb-0');
        $('.dataTables_paginate .page-item.active .page-link').addClass('bg-primary border-primary text-white');
    }
});


</script>
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if (session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        @if (session('error'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: "{{ $errors->first() }}",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });
        @endif
    });
</script>
@endpush
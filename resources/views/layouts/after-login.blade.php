<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Expertz Banking')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    @include('partials.header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 p-0">
                @include('partials.sidebar')
            </div>
            <div class="col-md-10 main-content p-4">
                @yield('content')
            </div>
        </div>
    </div>

    @include('partials.footer')
    <x-toast />
    {{-- Global route registry --}}
    <script>
        window.appRoutes = {
            validateBank: "{{ route('customers.validateBank') }}",
            // add more routes here as needed
        };
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap5.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    {{-- Dynamic scripts pushed from individual views --}}
    @stack('scripts')
</body>
</html>

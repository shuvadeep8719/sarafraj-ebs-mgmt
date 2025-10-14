@extends('layouts.before-login')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <div class="login-card card animate-fade-in">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <i class="fas fa-university fa-3x text-primary mb-3"></i>
                <h3 class="fw-bold text-primary">EXPERTZ BANKING</h3>
                <p class="text-muted">Banking Management System</p>
            </div>



            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required value="{{ old('username') }}">
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

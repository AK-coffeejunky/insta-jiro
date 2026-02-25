@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="auth-register-wrapper">

    <div class="auth-register-container">
        <!-- 戻るボタン -->
        <a href="{{ route('login') }}" class="auth-register-back">
            <i class="fas fa-chevron-left"></i>
        </a>

        <div class="auth-register-logo">
            <i class="auth-register-logo-icon fab fa-instagram"></i>
            insta
        </div>

        <h2 class="auth-register-title">Create new account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="Full Name"
                class="auth-register-input"
                required autofocus>

            <input type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email"
                class="auth-register-input"
                required>

            <input type="password"
                name="password"
                placeholder="Password"
                class="auth-register-input"
                required>

            <input type="password"
                name="password_confirmation"
                placeholder="Confirm Password"
                class="auth-register-input"
                required>

            <!-- Create -->
            <button type="submit" class="auth-register-button primary">
                Create Account
            </button>

            <!-- Cancel -->
            <a href="{{ route('login') }}" class="auth-register-button secondary">
                Cancel
            </a>

        </form>
    </div>

</div>

@endsection
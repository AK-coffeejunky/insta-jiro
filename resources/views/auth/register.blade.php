@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="auth-register-wrapper">

    <div class="auth-register-container">
        <!-- 戻るボタン -->
        <a href="{{ route('login') }}" class="auth-register-back">
            <i class="fas fa-chevron-left"></i>
        </a>

        <h2 class="auth-register-title">Create new account</h2>
        <div>Sign up to see photos and videos from your friends.</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="auth-register-subtitle">Full Name</div>
            <input type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="Full Name"
                class="auth-register-input"
                required autofocus>


            <div class="auth-register-subtitle">Email</div>
            <input type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email"
                class="auth-register-input"
                required>

            <div class="auth-register-subtitle">Password</div>
            <input type="password"
                name="password"
                placeholder="Password"
                class="auth-register-input"
                required>

            <div class="auth-register-subtitle">Confirm Password</div>
            <input type="password"
                name="password_confirmation"
                placeholder="Confirm Password"
                class="auth-register-input"
                required>

            <!-- Create -->
            <button type="submit" class="auth-register-button primary">
                {{ __('Create Account') }}
            </button>

            <!-- Cancel -->
            <a href="{{ route('login') }}" class="auth-register-button secondary">
                Cancel
            </a>

        </form>
    </div>

</div>

@endsection
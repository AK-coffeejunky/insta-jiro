@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="auth-register-wrapper">
    <div class="auth-register-card fade-in">
        <h2 class="auth-register-title">Create Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <input id="name" type="text"
                    class="auth-register-input @error('name') is-invalid @enderror"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Name"
                    required autofocus>

                @error('name')
                    <div class="auth-register-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <input id="email" type="email"
                    class="auth-register-input @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Email"
                    required>

                @error('email')
                    <div class="auth-register-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <input id="password" type="password"
                    class="auth-register-input @error('password') is-invalid @enderror"
                    name="password"
                    placeholder="Password"
                    required>

                @error('password')
                    <div class="auth-register-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <input id="password-confirm" type="password"
                    class="auth-register-input"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    required>
            </div>

            <button type="submit" class="auth-register-button">
                Create Account
            </button>
        </form>
    </div>
</div>

@endsection

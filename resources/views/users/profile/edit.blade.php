@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="apple-container py-5">
   

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="apple-bento-grid">
        @csrf
        @method('PATCH')

        <div class="bento-item hero-card">
            <div class="bento-content text-center">
                <div class="avatar-wrapper mb-4">
                    @if ($user->avatar)
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="profile-image">
                    @else
                        <div class="avatar-placeholder">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    @endif
                </div>
                <label for="avatar" class="apple-button-secondary">
                    Photo Change
                </label>
                <input type="file" name="avatar" id="avatar" class="d-none">
                <p class="text-muted x-small mt-3">JPG, PNG, GIF · Maximum 1048kb</p>
            </div>
        </div>

        <div class="bento-item">
            <div class="bento-content">
                <label class="apple-label">Name</label>
                <input type="text" name="name" class="apple-input" value="{{ old('name', $user->name) }}">
            </div>
        </div>

        <div class="bento-item">
            <div class="bento-content">
                <label class="apple-label">Mail Address</label>
                <input type="email" name="email" class="apple-input" value="{{ old('email', $user->email) }}">
            </div>
        </div>

        <div class="bento-item wide">
            <div class="bento-content">
                <label class="apple-label">Bio</label>
                <textarea name="introduction" rows="3" class="apple-textarea" placeholder="あなたについて教えてください...">{{ old('introduction', $user->introduction) }}</textarea>
            </div>
        </div>

        <div class="action-bar mt-4">
            <a href="{{ url()->previous() }}" class="apple-link">Cancel</a>
            <button type="submit" class="apple-button-primary">Save</button>
        </div>
    </form>
</div>

<style>
    :root {
        --apple-radius: 30px;
        --apple-bg: #f5f5f7;
        --apple-card: #ffffff;
    }

    body {
        background-color: var(--apple-bg);
        font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "Helvetica Neue", sans-serif;
        color: #1d1d1f;
        -webkit-font-smoothing: antialiased;
    }

    .apple-container {
        max-width: 980px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Bento Grid Layout */
    .apple-bento-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-auto-rows: minmax(200px, auto);
        gap: 20px;
    }

    .bento-item {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        padding: 40px;
        display: flex;
        align-items: center;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .bento-item:hover {
        transform: scale(1.02);
    }

    .hero-card {
        grid-column: span 1;
        grid-row: span 2;
        justify-content: center;
    }

    .wide {
        grid-column: span 2;
    }

    /* Typography & Inputs */
    .apple-label {
        display: block;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
        color: #86868b;
    }

    .apple-input, .apple-textarea {
        width: 100%;
        border: none;
        font-size: 1.5rem;
        font-weight: 600;
        outline: none;
        padding: 0;
    }

    .apple-textarea {
        font-size: 1.1rem;
        font-weight: 400;
        resize: none;
    }

    /* Avatar Animation */
    .profile-image, .avatar-placeholder {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        object-fit: cover;
        background: var(--apple-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 64px;
        color: #d2d2d7;
    }

    /* Buttons */
    .apple-button-primary {
        background: #0071e3;
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 980px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .apple-button-primary:hover {
        background: #0077ed;
        opacity: 0.9;
    }

    .apple-button-secondary {
        background: var(--apple-bg);
        color: #1d1d1f;
        padding: 8px 20px;
        border-radius: 980px;
        cursor: pointer;
        font-weight: 500;
    }

    .action-bar {
        grid-column: span 2;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 30px;
    }

    .apple-link {
        text-decoration: none;
        color: #0066cc;
    }

    .tracking-tight {
        letter-spacing: -0.022em;
    }

    @media (max-width: 768px) {
        .apple-bento-grid {
            grid-template-columns: 1fr;
        }
        .hero-card, .wide {
            grid-column: span 1;
        }
    }
</style>
@endsection
@extends('layouts.app')

@section('title', 'Login')
@section('hideNavbar', true)

@section('content')
<div class="auth-login-wrapper">
    <!-- 左 -->
    <div class="auth-login-left">
        <div class="auth-login-form fade-in-left">

            <!-- Instagram ロゴ＋テキスト -->
            <div class="auth-login-brand">
                <i class="fab fa-instagram auth-login-brand-logo"></i>
                <span class="auth-login-brand-text">Instagram</span>
            </div>

            <h2 class="auth-login-title">Login account</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="auth-login-field">
                    <span class="auth-login-label">Email</span>
                    <input id="email" type="email" name="email"
                        class="auth-login-input @error('email') is-invalid @enderror"
                        placeholder="Enter your email address" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="auth-login-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="auth-login-field">
                    <span class="auth-login-label">Password</span>
                    <input id="password" type="password" name="password"
                        class="auth-login-input @error('password') is-invalid @enderror"
                        placeholder="Input your password" required>
                    @error('password')
                        <div class="auth-login-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="auth-login-button">Login Account</button>

                <div class="auth-login-footer">
                    <span>Don't have an account?</span>
                    <a href="{{ route('register') }}" class="auth-login-link">Sign up</a>
                </div>
            </form>
        </div>
    </div>

    <!-- 右 -->
    @php
        // 使用する画像リスト
        $images = [
            '/images/bard.jpg',
            '/images/dog.jpg',
            '/images/lizard.jpg',
        ];

        // ランダムで1枚選択
        $bgImage = $images[array_rand($images)];
    @endphp

    <div class="auth-login-right" style="background-image: url('{{ $bgImage }}')">
        <div class="auth-login-overlay">
            <h1 class="auth-login-text fade-in-right">
                Follow your vibes.<br>
                Snap. Share. Inspire.
            </h1>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
const images = [
    '/images/apple-style-1.jpg',
    '/images/apple-style-2.jpg',
    '/images/apple-style-3.jpg',
];

let index = 0;
const bgDiv = document.querySelector('.auth-login-right');

function changeBackground() {
    // フェードアウト
    bgDiv.style.opacity = 0;

    setTimeout(() => {
        // 背景画像を変更
        index = (index + 1) % images.length;
        bgDiv.style.backgroundImage = `url('${images[index]}')`;
        // フェードイン
        bgDiv.style.opacity = 1;
    }, 500); // 500msでフェードアウト後に切り替え
}

// 初期値設定
bgDiv.style.backgroundImage = `url('${images[0]}')`;
bgDiv.style.transition = 'opacity 0.5s ease';

// 5秒ごとに切り替え
setInterval(changeBackground, 5000);
</script>
@endsection

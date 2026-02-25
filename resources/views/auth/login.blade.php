@extends('layouts.app')

@section('title', 'Login')
@section('hideNavbar', true)

@section('content')

<div class="auth-login-wrapper">
    <!-- 左 -->
    <div class="auth-login-left">
        <div class="auth-login-form fade-in-left">

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
    <div class="auth-login-right">
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
document.addEventListener("DOMContentLoaded", function () {

    const images = [
        "{{ asset('images/bard.jpg') }}",
        "{{ asset('images/dog.jpg') }}",
        "{{ asset('images/lizard.jpg') }}"
    ];

    const bgDiv = document.querySelector('.auth-login-right');
    const text = document.querySelector('.auth-login-text');
    let index = 0;

    // 初期画像設定
    bgDiv.style.backgroundImage = `url('${images[index]}')`;
    bgDiv.style.backgroundSize = "cover";
    bgDiv.style.backgroundPosition = "center";
    bgDiv.style.transition = "opacity 1s ease";

    // 複数アニメーションパターン
    const animations = [
        function(progress) {
            // 上下ゆらゆら
            const y = Math.sin(progress * 2 * Math.PI) * 15;
            return `translate(0px, ${y}px)`;
        },
        function(progress) {
            // 左右スイング
            const x = Math.sin(progress * 2 * Math.PI) * 15;
            return `translate(${x}px, 0px)`;
        },
        function(progress) {
            // 回転しながら上下
            const y = Math.sin(progress * 2 * Math.PI) * 10;
            const rot = Math.sin(progress * 2 * Math.PI) * 5;
            return `translate(0px, ${y}px) rotate(${rot}deg)`;
        },
        function(progress) {
            // ジグザグ
            const x = Math.sin(progress * 2 * Math.PI * 1.5) * 10;
            const y = Math.sin(progress * 2 * Math.PI) * 10;
            return `translate(${x}px, ${y}px)`;
        }
    ];

    let currentAnimation = null;

    function animateText() {
        const duration = 4000 + Math.random() * 4000; // 4~8秒周期
        const start = performance.now();

        function step(timestamp) {
            const elapsed = timestamp - start;
            const progress = (elapsed % duration) / duration;

            if(currentAnimation) {
                text.style.transform = currentAnimation(progress);
            }

            requestAnimationFrame(step);
        }

        requestAnimationFrame(step);
    }

    // 背景切替 & アニメーション更新
    function changeBackground() {
        bgDiv.style.opacity = 0;

        setTimeout(() => {
            // 背景切替
            index = (index + 1) % images.length;
            bgDiv.style.backgroundImage = `url('${images[index]}')`;
            bgDiv.style.opacity = 1;

            // ランダムアニメーション選択
            currentAnimation = animations[Math.floor(Math.random() * animations.length)];
        }, 1000);
    }

    // 初期アニメーション開始
    currentAnimation = animations[Math.floor(Math.random() * animations.length)];
    animateText();

    // 5秒ごとに背景とアニメーション切替
    setInterval(changeBackground, 5000);

});
</script>
@endsection

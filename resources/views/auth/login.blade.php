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
        <div class="bg-layer current"></div>
        <div class="bg-layer next"></div>
        <div class="auth-login-overlay">
            <h1 class="auth-login-text fade-in-right">
                Follow your vibes.<br>
                Snap. Share. Inspire.
            </h1>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.auth-login-right {
    position: relative;
    overflow: hidden;
}
.bg-layer {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-size: cover;
    background-position: center;
    transition: opacity 1s ease;
}
.bg-layer.next {
    opacity: 0;
}
.auth-login-overlay {
    position: relative;
    z-index: 2;
    color: white;
    text-align: center;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const images = [
        "{{ asset('images/bard.jpg') }}",
        "{{ asset('images/dog.jpg') }}",
        "{{ asset('images/lizard.jpg') }}"
    ];

    const currentLayer = document.querySelector('.bg-layer.current');
    const nextLayer = document.querySelector('.bg-layer.next');
    const text = document.querySelector('.auth-login-text');

    let index = 0;

    // 初期画像
    currentLayer.style.backgroundImage = `url('${images[index]}')`;

    // アニメーションパターン
    const animations = [
        // p => `translate(0px, ${Math.sin(p*2*Math.PI)*15}px)`,
        p => `translate(${Math.sin(p*2*Math.PI)*15}px, 0px)`
        // p => `translate(0px, ${Math.sin(p*2*Math.PI)*10}px) rotate(${Math.sin(p*2*Math.PI)*5}deg)`,
        // p => `translate(${Math.sin(p*2*Math.PI*1.5)*10}px, ${Math.sin(p*2*Math.PI)*10}px)`
    ];
    let currentAnimation = animations[Math.floor(Math.random()*animations.length)];

    // テキストアニメーション
    function animateText() {
        const duration = 4000 + Math.random() * 4000;
        const start = performance.now();

        function step(timestamp){
            const elapsed = timestamp - start;
            const progress = (elapsed % duration)/duration;
            if(currentAnimation) text.style.transform = currentAnimation(progress);
            requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }
    animateText();

    // 背景クロスフェード
    function changeBackground() {
        index = (index + 1) % images.length;
        nextLayer.style.backgroundImage = `url('${images[index]}')`;

        // フェードイン
        nextLayer.style.opacity = 0;
        requestAnimationFrame(() => {
            nextLayer.style.opacity = 1;
        });

        // フェード完了後に current を更新
        setTimeout(() => {
            currentLayer.style.backgroundImage = `url('${images[index]}')`;
            nextLayer.style.opacity = 0;

            // 新しいテキストアニメーション選択
            currentAnimation = animations[Math.floor(Math.random()*animations.length)];
        }, 1000);
    }

    setInterval(changeBackground, 5000);

});
</script>
@endsection
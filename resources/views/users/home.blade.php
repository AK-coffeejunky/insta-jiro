@extends('layouts.app')

@section('title', 'Home')

@section('content')

    {{-- THE HERO SECTION --}}
    <section class="apple-hero-section">
        <div class="hero-content fw-bolder">
            <h1 class="hero-title text-gradient-magical">Scroll into stories.</h1>
            <p class="hero-desc">A world of inspiration, frame by frame.</p>
            {{-- <h1 class="hero-title text-gradient-magical">The world, in focus.</h1>
            <p class="hero-desc">A curated gallery of the human experience.</p> --}}
            {{-- <h1 class="hero-title text-gradient-magical">Vision. Redefined.</h1>
            <p class="hero-desc">Connect through the lens of pure curiosity.</p> --}}

        </div>
    </section>


    {{-- THE MAIN CONTENT (The Single Column Masterpiece) --}}
    <div class="container main-content-wrapper">
        {{-- コンテンツを画面の中央に配置し、左右に贅沢な余白を持たせる --}}
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">

                {{-- THE DISCOVERY CAROUSEL --}}
                @if ($suggested_users)
                    <div class="discovery-section mb-5">
                        <p class="fw-bold text-secondary text-uppercase mb-3"
                            style="font-size: 0.85rem; letter-spacing: 0.05em; padding-left: 8px;">
                            Suggested for you
                        </p>
                        <div class="bento-carousel">
                            @foreach ($suggested_users as $user)
                                <div class="bento-card compact-bento">
                                    <div class="text-center">
                                        <a href="{{ route('profile.show', $user->id) }}" class="d-block mb-3">
                                            @if ($user->avatar)
                                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                                    class="rounded-circle shadow-sm"
                                                    style="width: 64px; height: 64px; object-fit: cover;">
                                            @else
                                                <i class="fa-solid fa-circle-user text-secondary"
                                                    style="font-size: 64px;"></i>
                                            @endif
                                        </a>
                                        <a href="{{ route('profile.show', $user->id) }}"
                                            class="text-decoration-none text-dark fw-bold d-block text-truncate mb-3"
                                            style="font-size: 1rem; letter-spacing: -0.01em;">
                                            {{ $user->name }}
                                        </a>
                                        <form action="{{ route('follow.store', $user->id) }}" method="POST">
                                            @csrf
                                            <button class="border-0 btn-apple-follow w-100">Follow</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- THE TIMELINE (妥協なきポストの羅列) --}}
                @forelse ($all_posts as $post)

                        <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="bento-card mb-5">
                            @include('users.posts.contents.title')
                            @include('users.posts.contents.body')
                        </div>
                    {{-- </div> --}}
                @empty
                    <div class="bento-card text-center py-5">
                        <h2 class="fw-bold text-dark mb-3">Share Photos</h2>
                        <p class="text-secondary mb-4">
                            When you share photos, they'll appear on your profile.
                        </p>
                        <a href="{{ route('post.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">Share
                            your first photo</a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    {{-- THE MAGIC SCRIPT (hero section) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const heroContent = document.querySelector('.hero-content');

            window.addEventListener('scroll', () => {
                // スクロール量を取得
                const scrolled = window.scrollY;

                // 魔法の計算式：スクロールに応じて透明度を下げ、奥へ沈み込み、少し下に移動する
                const opacity = 1 - (scrolled / 400);
                const scale = 1 - (scrolled / 2000);
                const translateY = scrolled * 0.4;

                if (heroContent) {
                    // 透明度が0未満にならないように制御
                    heroContent.style.opacity = Math.max(opacity, 0);
                    // パララックスとスケールダウンの適用
                    heroContent.style.transform = `translateY(${translateY}px) scale(${scale})`;

                    // 完全に消えたらクリック判定を無効化する（UXへの配慮）
                    heroContent.style.pointerEvents = opacity <= 0 ? 'none' : 'auto';
                }
            });
        });
    </script>

@endsection

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


    {{-- THE MAIN CONTENT --}}
    <div class="container main-content-wrapper">
        <div class="row gx-5">
            <div class="col-lg-8">
                @forelse ($home_posts as $post)
                    {{-- Bento Cardの魔法を適用 --}}
                    <div class="bento-card mb-5">
                        {{-- title --}}
                        @include('users.posts.contents.title')
                        {{-- body --}}
                        @include('users.posts.contents.body')
                    </div>

                @empty
                    <div class="text-center">
                        <h2>Share Photos</h2>
                        <p class="text-secondary">
                            When you share photos, they'll appear on your profile.
                        </p>
                        <a href="{{ route('post.create') }}" class="text-decoration-none">Share your first photo</a>
                    </div>
                @endforelse
            </div>


            <div class="col-lg-4">
                {{-- PROFILE OVERVIEW --}}
                <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', Auth::user()->id) }}">
                            @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="" class="rounded-circle avatar-md border border-2 border-white shadow-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ps-0">
                        <a href="{{ route('profile.show', Auth::user()->id) }}"
                            class="text-decoration-none text-dark fw-bold">{{ Auth::user()->name }}</a>
                        <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                @if ($suggested_users)
                    <div class="row">
                        <div class="col-auto">
                            <p class="fw-bold text-secondary">Suggested For you</p>
                        </div>
                        <div class="col text-end">
                            <a href="#" class="fw-bold text-dark text-decoration-none"></a>
                        </div>
                    </div>

                    @foreach ($suggested_users as $user)
                        <div class="row align-items-center mb-3">
                            <div class="col-auto">
                                <a href="{{ route('profile.show', $user->id) }}">
                                    @if ($user->avatar)
                                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                            class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif

                                </a>
                            </div>
                            <div class="col ps-0 text-truncate">
                                <a href="{{ route('profile.show', $user->id) }}"
                                    class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                            </div>
                            <div class="col-auto">
                                <form action="{{ route('follow.store', $user->id) }}" method="POST">
                                    @csrf
                                    <button class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
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

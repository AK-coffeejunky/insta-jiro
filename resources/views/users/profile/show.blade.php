@extends('layouts.app')

@section('title', $user->name)

@section('content')

@include('users.profile.header')

<style>
    /* Bento Grid System for Profile */
    .apple-profile-gallery {
        margin-top: 100px;
        padding: 0 40px; /* 圧倒的な余白 */
    }

    .apple-bento-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 常に完璧な3列 */
        gap: 24px; /* 計算し尽くされた空間 */
    }

    /* レスポンシブの魔法: モバイル体験も妥協しない */
    @media (max-width: 768px) {
        .apple-bento-grid {
            grid-template-columns: repeat(2, 1fr); /* iPadサイズ */
        }
    }
    @media (max-width: 480px) {
        .apple-bento-grid {
            grid-template-columns: 1fr; /* iPhoneサイズ */
        }
    }
</style>

<div style="margin-top: 100px">
    @if ($user->posts->isNotEmpty())
        <div class="row">
            @foreach ($user->posts as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="grid-img">
                    </a>
                </div>
            @endforeach

        </div>
    @else
        <h3 class="text-muted text-center">No Posts Yet</h3>
    @endif
</div>
@endsection

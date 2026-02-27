@extends('layouts.app')

@section('title', 'Show Post')

@section('content')
<div class="container main-content-wrapper mt-4">
    <div class="row justify-content-center">
        <div class="col-12">

            {{-- ▼ 新規追加: カードの外に配置された、静かなる「戻るボタン」 --}}
            <a href="{{ route('index') }}" class="btn-apple-back">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to Home
            </a>
            
            {{-- 魔法の分割カード（Bento Split Card） --}}
            <div class="row g-0 bento-split-card">
                
                {{-- LEFT: The Canvas (写真エリア) --}}
                <div class="col-md-7 split-left">
                    <img src="{{ $post->image }}" alt="post id {{ $post->id }}">
                </div>

                {{-- RIGHT: The Context (情報・対話エリア) --}}
                <div class="col-md-5 split-right">
                    
                    {{-- 1. Header (投稿者情報) --}}
                    <div class="split-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('profile.show', $post->user->id) }}">
                                    @if ($post->user->avatar)
                                        <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}"
                                            class="rounded-circle avatar-sm shadow-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col ps-0 text-truncate">
                                <a href="{{ route('profile.show', $post->user->id) }}"
                                    class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
                            </div>
                            <div class="col-auto">
                                @if (Auth::user()->id === $post->user->id)
                                    <div class="dropdown">
                                        <button class="btn btn-sm shadow-none" data-bs-toggle='dropdown'>
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        <div class="dropdown-menu border-0 shadow-sm rounded-4">
                                            <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                                                <i class="fa-regular fa-pen-to-square"></i> Edit
                                            </a>
                                            <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete-post-{{ $post->id }}">
                                                <i class="fa-regular fa-trash-can"></i> Delete
                                            </button>
                                        </div>
                                        @include('users.posts.contents.modals.delete')
                                    </div>
                                @else
                                    {{-- フォロー/アンフォローボタン (バグ修正＆Pill Button適用) --}}
                                    @if ($post->user->isFollowed())
                                        <form action="{{ route('follow.destroy', $post->user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 btn-apple-follow-sm bg-secondary text-white">Following</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow.store', $post->user->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="border-0 btn-apple-follow-sm">Follow</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- 2. Body (いいね、キャプション、コメント一覧) --}}
                    <div class="split-body">
                        {{-- Actions & Categories --}}
                        <div class="row align-items-center mb-3">
                            <div class="col-auto">
                                @if ($post->isLiked())
                                    <form action="{{ route('like.destroy', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm shadow-none p-0">
                                            <i class="fa-solid fa-heart text-danger fs-4"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('like.store', $post->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm shadow-none p-0">
                                            <i class="fa-regular fa-heart fs-4"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <div class="col-auto px-0">
                                <span class="fw-bold">{{ $post->likes->count() }}</span>
                            </div>
                            <div class="col text-end">
                                @forelse ($post->categoryPost as $category_post)
                                    <div class="badge bg-secondary bg-opacity-10 text-dark rounded-pill px-3 py-2 fw-normal">
                                        {{ $category_post->category->name }}
                                    </div>
                                @empty
                                    <div class="badge bg-secondary bg-opacity-10 text-dark rounded-pill px-3 py-2 fw-normal">
                                        Uncategorized
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Caption --}}
                        <div class="mb-4">
                            <a href="{{ route('profile.show', $post->user->id) }}"
                                class="text-decoration-none text-dark fw-bold me-1">{{ $post->user->name }}</a>
                            <p class="d-inline fw-normal" style="line-height: 1.6;">{{ $post->description }}</p>
                            <p class="text-uppercase text-secondary mt-1" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                                {{ date('M d, Y', strtotime($post->created_at)) }}
                            </p>
                        </div>

                        {{-- Comments List (透明でシームレスなリスト) --}}
                        @if ($post->comments->isNotEmpty())
                            <div class="comments-list mt-3">
                                @foreach ($post->comments as $comment)
                                    <div class="mb-3">
                                        {{-- バグ修正: user->id を $comment->user->id に変更 --}}
                                        <a href="{{ route('profile.show', $comment->user->id) }}"
                                            class="text-decoration-none text-dark fw-bold" style="font-size: 0.9rem;">
                                            {{ $comment->user->name }}
                                        </a>
                                        <span class="fw-normal ms-1" style="font-size: 0.95rem;">{{ $comment->body }}</span>
                                        
                                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="mt-1">
                                            @csrf
                                            @method('DELETE')
                                            <span class="text-uppercase text-secondary" style="font-size: 0.7rem; letter-spacing: 0.05em;">
                                                {{ date('M d, Y', strtotime($comment->created_at)) }}
                                            </span>
                                            @if (Auth::user()->id === $comment->user->id)
                                                <span class="text-muted mx-1">&middot;</span>
                                                <button class="border-0 bg-transparent text-danger p-0" style="font-size: 0.75rem;">Delete</button>
                                            @endif
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- 3. Footer (シームレスなコメント入力フォーム) --}}
                    <div class="split-footer">
                        <form action="{{ route('comment.store', $post->id) }}" method="post">
                            @csrf
                            <div class="d-flex align-items-end">
                                <textarea name="comment_body{{ $post->id }}" rows="1" 
                                    class="form-control input-apple-seamless flex-grow-1"
                                    placeholder="Add a comment...">{{ old('comment_body' . $post->id) }}</textarea>
                                
                                <button class="btn-apple-send ms-2 mb-1" type="submit" title="Post">
                                    <i class="fa-regular fa-paper-plane"></i>
                                </button>
                            </div>
                            @error('comment_body' . $post->id)
                                <div class="text-danger small mt-2 fw-bold">{{ $message }}</div>
                            @enderror
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
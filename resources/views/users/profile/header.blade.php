<div class="row">
    <div class="col-4">
        @if ($user->avatar)
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="d-block mx-auto avatar-lg">
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif
    </div>
    {{-- ace --}}
    <div class="col-8">
        <div class="row mb-3">
            <div class="col">
                <h2 class="display-6 mb-0">{{ $user->name }}</h2>
            </div>
            <div class="col p-2">
                @if (Auth::user()->id === $user->id)
                    <a href="{{ route('profile.edit') }}" class="apple-button-primary">
                        Edit Profile
                    </a>
                @else
                    @if ($user->isFollowed())
                        <form action="{{ route('follow.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                        </form>
                    @else
                        <form action="{{ route('follow.store', $user->id)}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id)}}" class="text-decoration-none text-dark">
                    <strong>{{ $user->posts->count() }}</strong> {{ $user->posts->count() == 1 ? 'post' : 'posts'}}
                </a>
            </div>
            <div class="col-auto">
                <a href={{ route('profile.show.follower', $user->id) }} class="text-decoration-none text-dark">
                    <strong>{{$user->followers->count() }}</strong> {{ $user->followers->count() == 1 ? 'follower' : 'followers'}}
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.show.following', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{$user->following->count() }}</strong> following
                </a>
            </div>
        </div>
        <p class="fw-bold">{{ $user->introduction }}</p>

    </div>

    <style>
        .apple-button-primary {
        background: #0071e3;
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 980px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        
    }

    .apple-button-primary:hover {
        background: #0077ed;
        opacity: 0.9;
    }
    </style>
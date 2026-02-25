@extends('layouts.app')

@section('title', 'Followers')

@section('content')

    @include('users.profile.header')

    <div style="margin-top: 100px">
        @if ($user->followers->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-4">
                    <h3 class="text-muted text-center">Followers</h3>

                    @foreach ($user->followers as $follow)
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <a href="{{ route('profile.show', $follow->follower->id) }}">
                                    @if ($follow->follower->avatar)
                                        <img src="{{ $follow->follower->avatar }}" alt="{{ $follow->follower->name }}"
                                            class="avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col ps-0 text-truncate">
                                <a href="{{ route('profile.show', $follow->follower->id) }}"
                                    class="text-decoration-none text-dark fw-bold">
                                    {{ $follow->follower->name }}
                                </a>
                            </div>
                            <div class="col-auto text-end">
                                @if ($follow->follower->id != Auth::user()->id)
                                    @if ($follow->follower->isFollowed())
                                        <form action="{{ route('follow.destroy', $follow->follower->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="border-0 bg-transparent p-0 text-secondary btn-sm">Following</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow.store', $follow->follower->id) }}" method="post">
                                            @csrf
                                            <button type="submit"
                                                class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <h3 class="text-muted text-center">No Followers Yet</h3>
        @endif
    </div>

@endsection

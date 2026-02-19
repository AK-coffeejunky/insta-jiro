@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <th></th>
            <th>CATEGORY</th>
            <th>OWNER</th>
            <th>CREATED AT</th>
            <th>STATUS</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($all_posts as $post)
                <tr>
                    <td>
                        @if ($post->image)
                            <img src="{{ $post->image }}" alt="{{ $post->image }}"
                                class="rounded-circle d-block mx-auto avatar-md">
                        @else
                            <i class="fa-solid fa-circle-post d-block text-center icon-md"></i>
                        @endif
                    </td>
                    <td>
                        @forelse ($post->categoryPost as $category_post)
                            <div class="badge bg-dark">{{ $category_post->category->name }}</div>
                        @empty
                            no category
                        @endforelse
                    </td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        @if ($post->trashed())
                            <i class="fa-regular fa-circle text-secondary"></i> &nbsp; Hidden
                        @else
                            <i class="fa-solid fa-circle text-info"></i> &nbsp; Visible
                        @endif
                    </td>
                    <td>
                        @if (Auth::user()->id != $post->id)
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown"">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>

                                <div class="dropdown-menu">
                                    @if ($post->trashed())
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#visible-post-{{ $post->id }}">
                                            <i class="fa-solid fa-post-check"></i> Hide Post {{ $post->id }}
                                        </button>
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                            data-bs-target="#hidden-post-{{ $post->id }}">
                                            <i class="fa-solid fa-post-slash"></i> Unhide Post {{ $post->id }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                            {{-- include modal here --}}
                            @include('admin.posts.modals.status')
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $all_posts->links() }}
    </div>

@endsection

@if ($post->trashed())
    {{-- visible --}}
    <div class="modal fade" id="visible-post-{{ $post->id }}">
        <div class="modal-dialog">
            <div class="modal-content border-success">
                <div class="modal-header border-success">
                    <h3 class="h5 modal-title text-success">
                        <i class="fa-solid fa-post-check"></i> visible post
                    </h3>
                </div>
                <div class="modal-body">
                    Are you sure you want to visible <span class="fw-bold">{{ $post->name }}</span> ?
                </div>
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.posts.visible', $post->id) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <button type="button" class="btn btn-outline-success btn-sm"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm">visible</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    {{-- hidden --}}
    <div class="modal fade" id="hidden-post-{{ $post->id }}">
        <div class="modal-dialog">
            <div class="modal-content border-danger">
                <div class="modal-header border-danger">
                    <h3 class="h5 modal-title text-danger">
                        <i class="fa-solid fa-post-slash"></i> hidden post
                    </h3>
                </div>
                <div class="modal-body">
                    Are you sure you want to hidden <span class="fw-bold">{{ $post->name }}</span> ?
                </div>
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.posts.hidden', $post->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-outline-danger btn-sm"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-sm">hidden</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

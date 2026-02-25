<div class="mt-4"> {{-- 空間の余裕は高級感の証。mt-3をmt-4へ --}}
    {{-- Show all comments here --}}
    @if ($post->comments->isNotEmpty())
        <hr class="text-muted opacity-25"> {{-- 境界線も少し優しく --}}
        <ul class="list-group list-group-flush"> {{-- list-group-flush で外枠の干渉を消す --}}
            @foreach ($post->comments->take(3) as $comment)
                {{-- ▼The Magic: bg-transparent を追加し、mb-3 で呼吸の空間を与える --}}
                <li class="list-group-item bg-transparent border-0 p-0 mb-3">
                    <a href="{{ route('profile.show', $comment->user->id) }}"
                        class="text-decoration-none text-dark fw-bold">
                        {{ $comment->user->name }}
                    </a>
                    <p class="d-inline fw-normal text-dark ms-1">{{ $comment->body }}</p>

                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="mt-1">
                        @csrf
                        @method('DELETE')
                        <span class="text-uppercase text-secondary" style="font-size: 0.7rem; letter-spacing: 0.05em;">
                            {{ date('M d, Y', strtotime($comment->created_at)) }}
                        </span>

                        @if (Auth::user()->id === $comment->user->id)
                            <span class="text-muted mx-1">&middot;</span>
                            <button class="border-0 bg-transparent text-danger p-0"
                                style="font-size: 0.75rem; transition: opacity 0.2s;"
                                onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                                Delete
                            </button>
                        @endif
                    </form>
                </li>
            @endforeach

            @if ($post->comments->count() > 3)
                <li class="list-group-item bg-transparent border-0 px-0 pt-0 mt-2">
                    <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none text-secondary fw-bold"
                        style="font-size: 0.85rem;">
                        View all {{ $post->comments->count() }} comments
                    </a>
                </li>
            @endif
        </ul>
    @endif
    {{-- 2. THE COMMENT FORM (The Seamless Interface) --}}
    <form action="{{ route('comment.store', $post->id) }}" method="post" class="mt-4">
        @csrf

        {{-- input-group を捨て、フレックスボックスで美しく配置 --}}
        <div class="d-flex align-items-end">
            <textarea name="comment_body{{ $post->id }}" rows="1" class="form-control input-apple-seamless flex-grow-1"
                placeholder="Add a comment...">{{ old('comment_body' . $post->id) }}</textarea>

            {{-- 専用の魔法クラスを持った送信ボタン --}}
            <button type="submit" class="btn-apple-send ms-2 mb-1">
                <i class="fa-regular fa-paper-plane"></i>
            </button>
        </div>

        {{-- Error --}}
        @error('comment_body' . $post->id)
            <div class="text-danger small mt-2 fw-bold">{{ $message }}</div>
        @enderror
    </form>
</div>

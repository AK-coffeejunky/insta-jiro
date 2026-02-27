@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container main-content-wrapper mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            {{-- 戻るボタン --}}
            <a href="{{ route('post.show', $post->id) }}" class="btn-apple-back mb-3">
                <i class="fa-solid fa-arrow-left me-2"></i>Cancel
            </a>

            {{-- 研磨のためのBento Card --}}
            <div class="bento-card p-5">
                <h2 class="fw-bold mb-4 text-center" style="letter-spacing: -0.02em;">Edit Post</h2>

                <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- 1. IMAGE UPLOAD (The Darkroom Preview) --}}
                    <div class="mb-5">
                        <label class="form-label fw-bold mb-2">Photo</label>
                        {{-- すでに画像があるので、最初から「暗室（黒背景＋実線）」の状態で表示する --}}
                        <div class="apple-file-upload-wrapper" id="upload-wrapper" 
                             style="border-style: solid; border-color: var(--card-border); background-color: #000000;">
                            
                            {{-- 透明なinput --}}
                            <input type="file" name="image" id="image" class="apple-file-upload-input" 
                                accept="image/jpeg, image/png, image/jpg, image/gif" 
                                onchange="previewImage(event)">
                            
                            {{-- ホバー時に現れる魔法のオーバーレイ --}}
                            <div class="apple-edit-overlay">
                                <i class="fa-solid fa-camera-rotate"></i>
                                <span class="fw-bold" style="letter-spacing: 0.05em;">Change Photo</span>
                            </div>

                            {{-- 現在の画像（または新しく選んだ画像）をフルサイズで表示 --}}
                            <img id="image-preview" src="{{ $post->image }}" alt="Current Post Image" class="w-100 h-100" 
                                style="object-fit: contain; border-radius: 18px; position: absolute; top: 0; left: 0; pointer-events: none; z-index: 0;">
                        </div>
                        
                        <div id="image-info" class="form-text mt-2 text-secondary small">
                            Leave this blank if you don't want to change the photo. (Max: 1MB)
                        </div>

                        @error('image')
                            <div class="text-danger small mt-2 fw-bold"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 2. DESCRIPTION (シームレスな入力欄) --}}
                    <div class="mb-5">
                        <label for="description" class="form-label fw-bold mb-1">Description</label>
                        <textarea name="description" id="description" rows="3" 
                            class="form-control input-apple-seamless" 
                            placeholder="Write a caption...">{{ old('description', $post->description) }}</textarea>
                        @error('description')
                            <div class="text-danger small mt-2 fw-bold"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 3. CATEGORIES (iOS風のピル・ボタン) --}}
                    <div class="mb-5">
                        <label class="form-label d-block fw-bold mb-3">
                            Category <span class="text-secondary fw-normal ms-1" style="font-size: 0.85rem;">(Select up to 3)</span>
                        </label>

                        <div>
                            @foreach ($all_categories as $category)
                                {{-- in_array で美しく判定 --}}
                                <input type="checkbox" name="category[]" id="cat_{{ $category->id }}" value="{{ $category->id }}" 
                                       class="apple-category-checkbox" 
                                       {{ in_array($category->id, $selected_categories) ? 'checked' : '' }}>
                                <label for="cat_{{ $category->id }}" class="apple-category-label">
                                    {{ $category->name }}
                                </label>
                            @endforeach
                        </div>
                        @error('category')
                            <div class="text-danger small mt-2 fw-bold"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 4. SUBMIT TRIGGER --}}
                    <div class="mt-5">
                        <button type="submit" class="btn-apple-submit">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
            
        </div>
    </div>
</div>

{{-- THE MAGIC SCRIPT (Image Preview) --}}
<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();

        reader.onload = function() {
            const preview = document.getElementById('image-preview');
            const wrapper = document.getElementById('upload-wrapper');

            // 読み込んだ新しい画像データをセット
            preview.src = reader.result;
            
            // 変更が加えられたことを視覚的にフィードバック（青い枠線）
            wrapper.style.borderColor = "var(--accent-blue)";
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
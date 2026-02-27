@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="container main-content-wrapper mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                {{-- 戻るボタン --}}
                <a href="{{ url('/') }}" class="btn-apple-back mb-3">
                    <i class="fa-solid fa-arrow-left me-2"></i>Cancel
                </a>

                {{-- 創造のためのBento Card --}}
                <div class="bento-card p-5">
                    <h2 class="fw-bold mb-4 text-center" style="letter-spacing: -0.02em;">New Post</h2>

                    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- 1. IMAGE UPLOAD (プレビュー機能付き) --}}
                        <div class="mb-5">
                            <div class="apple-file-upload-wrapper" id="upload-wrapper">
                                {{-- 透明なinput（onchangeイベントでJavaScriptを呼び出す） --}}
                                <input type="file" name="image" id="image" class="apple-file-upload-input"
                                    accept="image/jpeg, image/png, image/jpg, image/gif" onchange="previewImage(event)">

                                {{-- 選択前のプレースホルダー（アイコンとテキスト） --}}
                                <div id="upload-placeholder" class="text-center" style="transition: opacity 0.3s ease;">
                                    <i class="fa-regular fa-image apple-file-upload-icon"></i>
                                    <h5 class="fw-bold text-dark mb-1">Click or drag photo here</h5>
                                    <p class="text-secondary small mb-0">JPEG, PNG, JPG, GIF (Max: 1MB)</p>
                                </div>

                                {{-- 選択後に表示されるプレビュー画像（初期状態は d-none で非表示） --}}
                                <img id="image-preview" src="" alt="Preview" class="d-none w-100 h-100"
                                    style="object-fit: contain; border-radius: 18px; position: absolute; top: 0; left: 0; pointer-events: none;">
                            </div>

                            @error('image')
                                <div class="text-danger small mt-2 fw-bold"><i
                                        class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 2. DESCRIPTION (シームレスな入力欄) --}}
                        <div class="mb-5">
                            <label for="description" class="form-label fw-bold mb-1">Description</label>
                            {{-- 先ほど作った魔法の透明クラス（input-apple-seamless）を再利用 --}}
                            <textarea name="description" id="description" rows="3" class="form-control input-apple-seamless"
                                placeholder="Write a caption...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger small mt-2 fw-bold"><i
                                        class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 3. CATEGORIES (iOS風のピル・ボタン) --}}
                        <div class="mb-5">
                            <label class="form-label d-block fw-bold mb-3">
                                Category <span class="text-secondary fw-normal ms-1" style="font-size: 0.85rem;">(Select up
                                    to 3)</span>
                            </label>

                            <div>
                                @foreach ($all_categories as $category)
                                    {{-- inputを隠し、labelをボタンとして見せる --}}
                                    <input type="checkbox" name="category[]" id="cat_{{ $category->id }}"
                                        value="{{ $category->id }}" class="apple-category-checkbox">
                                    <label for="cat_{{ $category->id }}" class="apple-category-label">
                                        {{ $category->name }}
                                    </label>
                                @endforeach
                            </div>
                            @error('category')
                                <div class="text-danger small mt-2 fw-bold"><i
                                        class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 4. SUBMIT TRIGGER --}}
                        <div class="mt-5">
                            <button type="submit" class="btn-apple-submit">
                                Share Post
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
                const placeholder = document.getElementById('upload-placeholder');
                const wrapper = document.getElementById('upload-wrapper');

                // 読み込んだ画像データをimgタグのsrcにセット
                preview.src = reader.result;

                // プレビューを表示し、元のアイコンとテキストを隠す
                preview.classList.remove('d-none');
                placeholder.style.opacity = '0'; // ふわりと消える

                // ▼ The magic：　キャンパスを「暗室」へと変貌させ、作品を浮かび上がらる
                wrapper.style.borderStyle = "solid";
                wrapper.style.borderColor = "var(--text-primary)"; // 枠線をシャープに
                wrapper.style.backgroundColor = "#000000"; // 漆黒の背景
            };

            // ファイルが選択されていれば、読み込みを開始する
            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

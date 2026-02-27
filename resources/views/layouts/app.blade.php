<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- 2. 妥協なき美しさのためのグローバル定義 --}}
    <style>
        /* ページ全体のスクロールを、指に吸い付くように滑らかに */
        html {
            scroll-behavior: smooth;
        }

        /* AppleのRetinaディスプレイで文字を最も美しく（細く、鋭く）描画する魔法 */
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            padding-top: 80px;
        }

        /* スクロールバーの存在感を消し、コンテンツに没入させる (Webkit系) */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        /* ダークモード時のスクロールバー */
        @media (prefers-color-scheme: dark) {
            ::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.2);
            }
        }

        .navbar {
            backdrop-filter: saturate(100%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            transition: background-color 0.3s cubic-bezier(0.25, 0.1, 0.25, 1);
            background-color: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08), 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .fa-instagram {
            background: linear-gradient(135deg, #1100fa 0%, #ee2f2f 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;

            /* アイコン自体にも少しだけ影をつける */
            filter: drop-shadow(1px 1px 0px rgba(0, 0, 0, 0.4));

            display: inline-block;
            font-size: 1.5rem;
            /* サイズ調整 */
            vertical-align: middle;
        }

        /* アイコンとロゴの距離 */
        .navbar-brand {
            display: flex !important;
            align-items: center;
            gap: 10px;
            transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
            text-decoration: none !important;
        }

        .navbar-brand:active {
            transform: translateY(-8px) !important;
        }

        .navbar-brand:active i,
        .navbar-brand:active .h1 {
            filter:
                drop-shadow(0 3px 0 #ff00ff) drop-shadow(0 6px 0 #338f410b) drop-shadow(0 10px 10px rgba(0, 0, 0, 0.3)) !important;
        }

        .nav-item {
            display: flex;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            outline: none !important;
            -webkit-tap-highlight-color: transparent;
        }

        /* アバターのサイズ指定 */
        .avatar-xs {
            width: 24px;
            height: 24px;
            object-fit: cover;
            border-radius: 50%;
            vertical-align: middle;
        }

        .fa-square-plus

        /* .fa-square-plus */
        /* .fa-circle-plus */
            {
            font-size: 20px;
            display: inline-block;
            line-height: 1;
            vertical-align: middle;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .fa-square-plus:hover

        /* .fa-square-plus:hover */
        /* .fa-circle-plus:hover */
            {
            transform: rotate(180deg) scale(1.1);
        }

        /* Account  */
        .navbar-nav .dropdown-menu {
            display: block;
            visibility: hidden;
            opacity: 0;
            transform: translateY(10px) scale(0.95);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            pointer-events: none;
            min-width: 120px;
            padding: 0.5rem 0;
            overflow: hidden;
        }

        .navbar-nav .dropdown-menu.show {
            visibility: visible;
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .navbar-nav .dropdown-menu.show .dropdown-item {
            animation: slideInRight 0.5s ease forwards;
        }

        .navbar-nav .dropdown-menu.show .dropdown-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .navbar-nav .dropdown-menu.show .dropdown-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .navbar-nav .dropdown-menu.show .dropdown-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .navbar-nav .dropdown-item {
            opacity: 0;
        }

        .menu-item {
            transition: all 0.2s ease;
            padding: 12px;
            border-radius: 6px;
        }

        .admin-container .table {
            background-color: white;
        }

        /* 偶数行のセルを薄いグレーに */
        .admin-container .table tbody tr:nth-of-type(even) td {
            background-color: #f8f9fa !important;
        }

        /* 奇数行のセルを白に */
        .admin-container .table tbody tr:nth-of-type(odd) td {
            background-color: #ffffff !important;
        }

        /* ホバー時の色（少し濃いグレー） */
        .admin-container .table tbody tr:hover td {
            background-color: #f0f0f0 !important;
        }

        .admin-container .table td {
            border-bottom: 1px solid #f0f0f0 !important;
        }

        /* pagination */
        .pagination {
            border: none !important;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        /* 各ページリンクの装飾をリセット */
        .page-item .page-link {
            border: none !important;
            background: none !important;
            color: #888 !important;
            font-size: 1rem;
            font-weight: 500;
            padding: 8px 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border-radius: 50% !important;
        }

        /* マウスを乗せた時（薄いグレーの円が浮き出る） */
        .page-item .page-link:hover {
            background-color: rgba(0, 0, 0, 0.05) !important;
            color: #000 !important;
            transform: translateY(-1px);
        }

        /* 現在のページ（太字 ＋ 下のドット） */
        .page-item.active .page-link {
            color: #000 !important;
            font-weight: 800 !important;
        }

        /* 「前へ」「次へ」の矢印（< , >）を少し薄くする */
        .page-item:first-child .page-link,
        .page-item:last-child .page-link {
            font-size: 1.2rem;
            color: #ccc !important;
        }

        .page-item.disabled .page-link {
            color: #eee !important;
        }

    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])




</head>

<body style="background-color: var(--bg-page)">

    <div id="app">
        @if (!Route::is('login') && !Route::is('register'))
            <nav class="navbar navbar-expand-md navbar-light fixed-top">
                <div class="container">
                    <div class="logo">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <i class="fa-brands fa-instagram"></i>
                            <h1 class="h1 mb-0 fw-bold">{{ config('app.name') }}</h1>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        {{-- [SOON] SEARCH BAR HERE --}}
                        @auth
                            @if (!request()->is('admin/*'))
                                <ul class="navbar-nav ms-auto">
                                    <form action="{{ route('search') }}" style="width: 300px">
                                        <input type="search" name="search"
                                            class="form-control form-control-sm rounded-4 border-0" placeholder="Search...">
                                    </form>
                                </ul>
                            @endif
                        @endauth

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                {{-- Home --}}

                                {{-- Create Post --}}
                                <li class="nav-item" title="Create Post">
                                    <a href="{{ route('post.create') }}" class="nav-link">
                                        <i class="fa-solid fa-square-plus"></i>
                                        {{-- <i class="fa-regular fa-square-plus"></i> --}}
                                        {{-- <i class="fa-solid fa-circle-plus"></i> --}}

                                    </a>
                                </li>

                                {{-- Account --}}
                                <li class="nav-item dropdown">
                                    <button id="account-dropdown" class="btn shadow-none nav-link"
                                        data-bs-toggle="dropdown">
                                        @if (Auth::user()->avatar)
                                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                                class="rounded-circle avatar-xs">
                                        @else
                                            <i class="fa-solid fa-circle-user text-dark fa-lg"></i>
                                        @endif
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end menu-item"
                                        aria-labelledby="account-dropdown">
                                        {{-- [SOON] ADMIN CONTROLS --}}
                                        @can('admin')
                                            <a href="{{ route('admin.users') }}" class="dropdown-item">
                                                <i class="fa-solid fa-user-gear"></i> Admin
                                            </a>

                                            <hr class="dropdown-divider">
                                        @endcan


                                        {{-- Profile --}}
                                        <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item">
                                            <i class="fa-solid fa-book-open-reader"></i> Profile
                                        </a>

                                        {{-- Logout --}}
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            {{-- <i class="fa-solid fa-right-from-bracket"></i> --}}
                                            <i class="fa-solid fa-person-walking"></i>
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>

                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @endif

        
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    {{-- [SOON] ADMIN MENU (col-3) --}}
                    @if (request()->is('admin/*'))
                        <div class="col-3">
                            <div class="list-group">
                                <a href="{{ route('admin.users') }}"
                                    class="list-group-item {{ request()->is('admin/users') ? 'active' : '' }}">
                                    <i class="fa-solid fa-users"></i> Users
                                </a>
                                <a href="{{ route('admin.posts') }}"
                                    class="list-group-item {{ request()->is('admin/posts') ? 'active' : '' }}">
                                    <i class="fa-solid fa-newspaper"></i> Posts
                                </a>
                                <a href="{{ route('admin.categories') }}"
                                    class="list-group-item {{ request()->is('admin/categories') ? 'active' : '' }}">
                                    <i class="fa-solid fa-tags"></i> Categories
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="col-9 admin-container">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    @yield('scripts')

</body>

</html>

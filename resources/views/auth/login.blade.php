<!doctype html>
<?php

use Illuminate\Support\ViewErrorBag;

/**
 * @var ViewErrorBag $errors
 * Variables from Controller
 * @see App\Http\Controllers\Auth\LoginController::loginPage()
 * @var string $rememberMemberCode
 */
?>
<html lang="zh-Hant">
<head>
    <meta charset="utf-8">
    <title>員工登入 - Fonsen Staff Insight</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- 簡單版：先用 CDN，之後你要改成 Vite + 自己的 bootstrap 也很容易 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-light">

{{-- ⭐ 這裡使用 Flex 讓整個畫面垂直＋水平置中 --}}
<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="row justify-content-center w-100">
        <div class="col-md-5">

            <div class="text-center mb-4">
                <h1 class="h4">鋒形科技-開發部-回饋系統</h1>
                <p class="text-muted mx-0 mt-3">請使用員工編號與生日登入</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('frontend.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="code" class="form-label">員工編號</label>
{{--                            <input--}}
{{--                                autocomplete="off"--}}
{{--                                type="text"--}}
{{--                                name="code"--}}
{{--                                id="code"--}}
{{--                                class="form-control @error('code') is-invalid @enderror"--}}
{{--                                value="{{ old('code') }}"--}}
{{--                                placeholder="例如：F00132"--}}
{{--                                required--}}
{{--                                autofocus--}}
{{--                            >--}}
                            <input
                                autocomplete="off"
                                type="text"
                                name="code"
                                id="code"
                                class="form-control @error('code') is-invalid @enderror"
                                value="{{ old('code', $rememberMemberCode) }}"
                                placeholder="例如：F00132"
                                required
                                autofocus
                            >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">密碼 (生日四碼)</label>
                            <input
                                autocomplete="off"
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('code') is-invalid @enderror"
                                placeholder="例如：0501"
                                required
                            >
                        </div>

                        <div class="mb-3 form-check">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="remember"
                                name="remember"
                                value="1"
                                @if(!empty($rememberMemberCode)) checked @endif
                            >
                            <label class="form-check-label" for="remember">記住我 ( 這台裝置 )</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            登入
                        </button>

                        {{-- 錯誤訊息 --}}
                        @if ($errors->any())
                            <div class="alert alert-danger my-0 mt-3">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                    </form>
                </div>

                <div class="card-footer text-center text-muted small">
                    &copy; {{ date('Y') }} 鋒形科技 - Staff Insight
                </div>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

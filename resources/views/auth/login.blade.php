@extends('layouts.app')

@section('content')
    <div class="card border-0">
        <div class="card-header">
            <div class="edit-profile__title">
                <h6>Đăng nhập hệ thống thi</h6>
            </div>
        </div>
        <form method="POST" action="{{ route('login') }}" class="card-body">
            @csrf
            <div class="edit-profile__body">
                <div class="form-group mb-25">
                    <label for="username">Gmail</label>
                    <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus id="username" placeholder="name@example.com" />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group mb-15">
                    <label for="password-field">Mật khẩu</label>
                    <div class="position-relative">
                        <input id="password-field" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" />
                        <div class="uil uil-eye-slash text-lighten fs-15 field-icon toggle-password2"></div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="admin-condition">
                    <div class="checkbox-theme-default custom-checkbox">
                        <input class="checkbox" type="checkbox" name="remember" id="check-1" {{ old('remember') ? 'checked' : '' }}>
                        <label for="check-1">
                            <span class="checkbox-text">Nhớ mật khẩu</span>
                        </label>
                    </div>
                    <a href="forget-password.html">Bạn đã quên mật khẩu ?</a>
                </div>
                <div class="admin__button-group button-group d-flex pt-1 justify-content-md-start justify-content-center">
                    <button type="submit"
                        class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn">
                        Đăng nhập
                    </button>
                </div>
            </div>
        </form>

        <div class="admin-topbar">
            <p class="mb-0">
                Bạn chưa có tài khoản
                <a href="{{ route('register') }}" class="color-primary"> Đăng ký </a>
            </p>
        </div>
    </div>
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

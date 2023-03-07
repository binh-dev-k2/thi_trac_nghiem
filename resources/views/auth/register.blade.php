@extends('layouts.app')

@section('content')
    <div class="card border-0">
        <div class="card-header">
            <div class="edit-profile__title">
                <h6>Đăng ký tài khoản</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="edit-profile__body">
                <form method="POST"  action="{{ route('register') }}" class="edit-profile__body">
                    @csrf
                    <div class="form-group mb-20">
                        <label for="name">Họ và tên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus id="name" placeholder="Họ tên đầy đủ" />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group mb-20">
                        <label for="email">Địa chỉ Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="email" placeholder="name@example.com" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group mb-15">
                        <label for="password-field">Mật khẩu</label>
                        <div class="position-relative">
                            <input id="password-field" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" 
                                placeholder="Mật khẩu..." />
                            <div class="uil uil-eye-slash text-lighten fs-15 field-icon toggle-password2"></div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group mb-15">
                        <label for="password-cornfirm">Nhập lại mật khẩu</label>
                        <div class="position-relative">
                            <input id="password-cornfirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Mật khẩu..." />
                        </div>
                    </div>
                    <div class="form-group select-px-15">
                        <label for="countryOption" name="role" class="il-gray fs-14 fw-500 align-center mb-10">Bạn là ai:</label>
                        <select class="form-control px-15" name="role" id="countryOption">
                        <option>-----</option>
                          <option value="0">Học sinh</option>
                          <option value="1">Giáo viên</option>
                        </select>
                      </div>
                      @error('role')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    <div
                        class="admin__button-group button-group d-flex pt-1 justify-content-md-start justify-content-center">
                        <button type="submit"
                            class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn">
                            Tạo tài khoản
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="admin-topbar">
            <p class="mb-0">
                Bạn đã có tài khoản
                <a href="{{route('login')}}" class="color-primary">Đăng nhập</a>
            </p>
        </div>
    </div>
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

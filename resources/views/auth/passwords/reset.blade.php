@extends('auth.app')

@section('content')
    <div class="content content-fixed content-auth-alt">
        <div class="container d-flex justify-content-center ht-100p">
            <div class="mx-wd-300 wd-sm-450 ht-100p d-flex flex-column align-items-center justify-content-center">
{{--                <div class="wd-80p wd-sm-300 mg-b-15"><img src="https://via.placeholder.com/2083x1466" class="img-fluid"--}}
{{--                                                           alt=""></div>--}}
                <h4 class="tx-20 tx-sm-24">Reset your password</h4>
                <p class="tx-color-03 mg-b-30 tx-center">Enter your username or email address and we will send you a
                    link to reset your password.</p>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group mb-2">
                                    <label>{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                           autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label>{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label>{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation"
                                           required autocomplete="new-password">
                                </div>

                                <div class="row mb-0 d-flex justify-content-center">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- container -->
    </div><!-- content -->
@endsection

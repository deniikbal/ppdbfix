@extends('auth.app')
@section('content')
    <div class="content content-fixed content-auth">
        <div class="container">
            <div class="media align-items-stretch justify-content-center ht-100p">
                <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
                    <div class="pd-t-20 wd-100p">
                        <h4 class="tx-color-01 mg-b-5">Buat Akun Baru</h4>
                        <p class="tx-color-03 tx-16 mg-b-40">Silahkan membuat akun sesuai form</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group mb-2">
                                <label>Nama Lengkap</label>
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Alamat Email</label>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <div class="d-flex justify-content-between mg-b-5">
                                    <label class="mg-b-0-f">No WhatsApp <span class="tx-danger tx-xs-12">*Contoh: 0851xxxxxxxx</span></label>
                                </div>
                                <input id="email" type="text"
                                       class="form-control mb-1 @error('no_handphone') is-invalid @enderror"
                                       name="no_handphone" value="{{ old('no_handphone') }}"
                                       placeholder="0851xxxxxxxx">

                                @error('no_handphone')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Password</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Konfirmasi Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" autocomplete="new-password">
                            </div>
                            <div class="form-group tx-12">
                                Dimohon untuk mengisi nomor WhatsApp sesuai contoh.
                            </div><!-- form-group -->

                            <button type="submit" class="btn btn-danger btn-block">Buat Akun</button>
                            <div class="tx-13 mg-t-20 tx-center">Sudah memiliki akun? <a
                                        href="{{ route('login') }}">Sign
                                    In</a></div>
                        </form>
                    </div>
                </div><!-- sign-wrapper -->
                <div class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
                    <div class="mx-lg-wd-500 mx-xl-wd-550">
                        <img src="{{asset('assets/img/register.png')}}" class="img-fluid" alt="">
                    </div>
                </div><!-- media-body -->
            </div><!-- media -->
        </div><!-- container -->
    </div><!-- content -->
@endsection

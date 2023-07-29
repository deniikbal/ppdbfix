@extends('auth.app')
@section('content')
    <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
        <div class="card">
            <div class="card-body">

                <div class="wd-100p">
                    <h4 class="tx-color-01 mg-b-5">PPDB SMA TELKOM</h4>
                    <p class="tx-color-03 tx-16 mg-b-40">Selamat Datang kembali! Silahkan Untuk Sign In.
                    </p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label>Email address</label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mg-b-5">
                                <label class="mg-b-0-f">Password</label>
                                <a href="{{ route('password.request') }}" class="tx-13">Lupa password?</a>
                            </div>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-danger btn-block">Sign In</button>
                        <div class="tx-13 mg-t-20 tx-center">Tidak punya akun? <a
                                href="{{ route('register') }}">Buat
                                Akun</a></div>
                    </form>
                </div>

            </div>
        </div>
    </div><!-- sign-wrapper -->
@endsection

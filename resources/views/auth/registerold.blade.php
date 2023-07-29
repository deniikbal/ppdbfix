@extends('auth.app')
@section('content')
    <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
        <div class="card">
            <div class="card-body">
                <div class="pd-t-20 wd-100p">
                    <h4 class="tx-color-01 mg-b-5">PPDB SMA TELKOM</h4>
                    <p class="tx-color-03 tx-16 mg-b-40">Gratis untuk mendaftar dan hanya butuh satu menit.
                    </p>
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
                                <label class="mg-b-0-f">No WhatsApp</label>
                            </div>
                            <input id="email" type="text"
                                   class="form-control @error('no_handphone') is-invalid @enderror"
                                   name="no_handphone" value="{{ old('no_handphone') }}"
                                   autocomplete="no_handphone">

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
                            Dengan mengeklik Buat akun di bawah ini, Anda menyetujui persyaratan layanan dan
                            pernyataan privasi kami.
                        </div><!-- form-group -->

                        <button type="submit" class="btn btn-danger btn-block">Buat Akun</button>
                        <div class="tx-13 mg-t-20 tx-center">Sudah memiliki akun? <a
                                href="{{ route('login') }}">Sign
                                In</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- sign-wrapper -->
@endsection

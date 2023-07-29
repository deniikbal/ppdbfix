<div class="wd-80p wd-sm-300 mg-b-15"><img src="{{asset('assets/img/reset.png')}}" class="img-fluid" alt=""></div>
<h4 class="tx-20 tx-sm-24">Reset your password</h4>
<p class="tx-color-03 mg-b-30 tx-center">Enter your username or email address and we will send you a link to reset your password.</p>
<form method="POST" action="{{ route('password.email') }}">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">

            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach

        </div>
    @endif
    <div class="wd-100p d-flex flex-column flex-sm-row mg-b-40">

        <input type="text" class="form-control wd-sm-250 flex-fill @error('email') is-invalid @enderror"
               placeholder="Enter username or email address" name="email" value="{{old('email')}}">
        <button type="submit" class="btn btn-danger mg-sm-l-10 mg-t-10 mg-sm-t-0">Reset Password</button>
    </div>
</form>
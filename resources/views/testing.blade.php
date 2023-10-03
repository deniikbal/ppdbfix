@extends('layouts.admin.app')
@section('welcome')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Testing</a></li>
                <li class="breadcrumb-item active" aria-current="page">Telegram</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Testing Telegram Chanel</h4>
    </div>
    <div class="d-none d-md-block">
        <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="clock"
                                                                               class="wd-10 mg-r-5"></i>
            {{\Carbon\Carbon::now()->format('D, d M Y H:i:s')}}
        </button>
    </div>
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Admin</div>
            <div class="card-body">
                <div class="row">
                    <form action="{{route('sendnotif')}}" method="post">
                        @csrf
                        <button class="btn btn-primary mr-2" type="submit">Test</button>
                    </form>
                    <form action="{{route('bayar')}}" method="post">
                        @csrf
                        <button class="btn btn-danger mr-2" type="submit">Bayar</button>
                    </form>
                    <form action="{{route('usernotification')}}" method="post">
                        @csrf
                        <button class="btn btn-danger mr-2" type="submit">Sen User</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

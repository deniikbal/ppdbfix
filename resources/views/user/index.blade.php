@extends('layouts.user.app')
@section('welcome')
    <div>
        <h4 class="mg-b-0 tx-spacing--1">Welcome to Dashboard</h4>
    </div>
    <div class="d-none d-md-block">
        <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="file"
                                                                               class="wd-10 mg-r-5"></i>
            {{\Carbon\Carbon::now()->format('D, d M Y H:i:s')}}
        </button>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="col-12 mb-2">
            <div class="card">
                <div class="card-body">
                    <a href="/student" class="btn btn-danger">Student</a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body"></div>
            </div>
        </div>

    </div>
@endsection
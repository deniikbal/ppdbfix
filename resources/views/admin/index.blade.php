@extends('layouts.admin.app')
@section('welcome')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Welcome to Dashboard</h4>
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

            </div>
        </div>
    </div>
@endsection

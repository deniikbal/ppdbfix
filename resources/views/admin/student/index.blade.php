@extends('layouts.admin.app')

@section('welcome')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Student</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Student</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">All Student</h4>
    </div>
    <div class="d-none d-md-block">
        <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="clock" class="wd-10 mg-r-5"></i>
            {{ \Carbon\Carbon::now()->format('D, d M Y H:i:s') }}
        </button>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                        data-target="#exampleModal"><i data-feather="user-plus"></i> Add Student
                    </button>
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
    @include('admin.users.modal.createuser')
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

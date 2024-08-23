@extends('layouts.admin.app')

@section('welcome')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Peserta Didik</a></li>
                <li class="breadcrumb-item active" aria-current="page">Calon Peserta Didik</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Calon Peserta Didik</h4>
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
                    <!-- <button type="button" class="btn btn-outline-warning btn-sm mr-2" data-toggle="modal"
                        data-target="#nosurat"><i data-feather="file"></i> No Surat
                    </button> -->
                    <!-- <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                        data-target="#exampleModal"><i data-feather="user-plus"></i> Add Student
                    </button> -->
                    <a href="{{ route('export') }}" class="btn btn-outline-danger btn-sm ml-2"><i
                            data-feather="download"></i>
                        Export</a>
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
    <!-- @include('admin.student.modal.addstudent')
    @include('admin.student.modal.surat') -->
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

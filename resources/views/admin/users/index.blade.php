@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-primary btn-sm"
                            data-toggle="modal" data-target="#exampleModal"><i data-feather="user-plus"></i> Add Users</button>
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
    @include('admin.users.modal.createuser')
    @foreach($users as $user)
        @include('admin.users.modal.edituser')
    @endforeach
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

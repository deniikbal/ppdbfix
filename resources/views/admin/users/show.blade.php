@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-primary">Edit <strong>{{$users->name}}</strong></div>
                <div class="card-body">
                    <form action="{{route('users.update', $users->id)}}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{$users->name}}" name="name" class="form-control"
                                       id="inputEmail3" placeholder="Email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-4 col-form-label">No Handphone</label>
                            <div class="col-sm-8">
                                <input class="form-control @error('no_handphone') is-invalid @enderror" type="text"
                                       name="no_handphone" value="{{ $users->no_handphone }}">
                                @error('no_handphone')
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input class="form-control @error('email') is-invalid @enderror" type="text"
                                       name="email" value="{{ $users->email }}">
                                @error('email')
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="role" aria-label="Default select example">
                                    <option value="">--Pilih--</option>
                                    <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="siswa" {{ $users->role == 'siswa' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input class="form-control @error('password') is-invalid @enderror" type="text"
                                       name="password" value="">
                                @error('password')
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                <button class="btn btn-danger">Save Change</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection


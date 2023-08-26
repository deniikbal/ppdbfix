@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <div class="row d-flex flex-lg-row-reverse">
            <div class="col-lg-4">
                <div class="alert alert-solid alert-info alert-dismissible fade show">
                    Silahkan Untuk mengupdate status pembayaran
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-end">
                        8
                    </div>
                    <div class="card-body">
                        <form action="{{route('updatepayadmin', $pay->id)}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-row mb-1">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail3">Nama Siswa</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name')
                            is-invalid @enderror"
                                           placeholder="Nama Sekolah SMP/MTs" value="{{ $pay->student['name'] }}"
                                           readonly>
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail3">No Daftar</label>
                                    <input type="text" name="nodaftar" id="nodaftar"
                                           class="form-control @error('nodaftar') is-invalid @enderror"
                                           placeholder="NPSN"
                                           value="{{ $pay->student['nodaftar'] }}" readonly>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail3">Invoice</label>
                                    <input type="text" name="invoice" id="invoice"
                                           class="form-control @error('invoice') is-invalid @enderror"
                                           placeholder="NPSN"
                                           value="{{ $pay->external_id }}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail3">Nominal</label>
                                    <input type="text" name="amount" id="amount"
                                           class="form-control @error('amount') is-invalid @enderror" placeholder="NPSN"
                                           value="{{ $pay->amount }}" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail3">Status</label>
                                    <select class="form-control select2 @error('status') is-invalid @enderror"
                                            name="status"
                                            id="">
                                        <option value="">--Pilih--</option>
                                        <option value="SETTLED" {{ $pay->status == 'SETTLED' ? 'selected' : '' }}>
                                            SETTLED
                                        </option>
                                        <option value="PENDING" {{ $pay->status == 'PENDING' ? 'selected' : '' }}>
                                            PENDING
                                        </option>
                                        <option value="EXPIRED" {{ $pay->status == 'EXPIRED' ? 'selected' : '' }}>
                                            EXPIRED
                                        </option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-danger btn-sm" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.school.modal.addschool')

@endsection
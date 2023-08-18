@extends('layouts.student.main')
@section('title')
    Pembayaran Calon Siswa
@endsection
@section('main')
    Pembayaran
@endsection
@section('data')
    Pembayaran Calon Siswa
@endsection

@section('content')
    <div class="col-lg-12 mb-2">
        <div class="card bd-gray-500">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Selamat datang di web PPDB SMA TELKOM BANDUNG Tahun Ajaran 2023-2024, Berikut
                    Langkah-langkah untuk melakukan pembayaran PPDB SMA TELKOM BANDUNG</h6>
                <ul class="list-group mb-2">
                    <li class="list-group-item bg-primary text-white">Klik tombol Tambah Pembayaran, Isi dengan nominal
                        pembayaran.</li>
                    <li class="list-group-item bg-primary text-white">harap di isi data.</li>
                </ul>
                <a href="#createpaymenttp" class="btn btn-danger" data-toggle="modal">Tambah Pembayaran</a>
                @include('student.payment.modal.createpayment')
                <a href="#createpaymentdu" class="btn btn-danger" data-toggle="modal">Tambah Pembayaran DU</a>
                @include('student.payment.modal.createpaymentdu')
                <a href="#createpaymentdu" class="btn btn-danger" data-toggle="modal">Tambah Pembayaran DU</a>
                @include('student.payment.modal.createpaymentdu')
            </div>

        </div>
    </div>

    //payment Xendit
    @php
        $student = App\Models\Student::where('user_id', auth()->id())->first();
        $paymentxendit = App\Models\payment_xendit::where('student_id', $student->id)->get();
    @endphp
    @foreach ($paymentxendit as $pay)
        <div class="col-sm-6 col-lg-3">
            <div class="card card-body bd-gray-500">
                {{-- @if ($pay->jenis_bayar == 'Titipan Pembayaran')
                    <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold tx-primary mg-b-8">Titipan Pembayaran
                    </h6>
                @else
                    <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-warning tx-semibold mg-b-8">Daftar Ulang</h6>
                @endif --}}
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-warning tx-semibold mg-b-8">Daftar Ulang</h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                    <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">Rp. {{ $pay->gross_amount }}</h3>
                </div>
                <div>
                    <p class="mb-1">Order Id : {{ $pay->external_id }}</p>
                    @if ($pay->transaction_status == 'pending')
                        <p class="mb-1">Status : <span
                                class="badge badge-danger">{{ Str::upper($pay->transaction_status) }}</span></p>
                    @elseif ($pay->transaction_status == 'settlement')
                        <p class="mb-1">Status : <span
                                class="badge bg-success">{{ Str::upper($pay->transaction_status) }}</span></p>
                    @else
                        <p class="mb-1">Status : <span
                                class="badge badge-dark">{{ Str::upper($pay->transaction_status) }}</span></p>
                    @endif

                    <p class="mb-1">Type Pembayaran : {{ $pay->payment_type }}</p>
                    <p class="mb-1 badge badge-warning">{{ $pay->status_message }}</p>
                    <p class="mb-1 badge badge-info">{{ $pay->transaction_time }}</p>
                    <div style="display: inline-block">
                        @if ($pay->transaction_status == 'pending')
                            <a href="{{ $pay->pdf_url }}" class="badge badge-gray">
                                Download Instruksi Pembayaran
                            </a>
                        @else
                        @endif

                    </div>
                </div>
            </div>
        </div><!-- col -->
    @endforeach
@endsection

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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-secondary pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                <h6 class="tx-13 tx-spacing-1 tx-white tx-uppercase tx-semibold mg-b-0">Pembayaran Biaya Pendidikan</h6>
                <nav class="nav nav-with-icon tx-13">
                    <button type="button" class="btn btn-sm pd-x-15 btn-primary btn-xs btn-uppercase mg-l-5"
                        data-toggle="modal" data-target="#createpaymenttp"><i data-feather="plus"></i>
                        Add Pembayaran</button>
                </nav>
            </div><!-- card-header -->
            <div class="card-body">
                {{-- @foreach ($payment as $pay) --}}
                <div class="row row-xs">
                    @foreach ($payment as $pay)
                        <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
                            <div class="card card-body {{ $countpayment >= 4 ? 'mb-2' : '' }}">
                                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                                    @if ($pay->jenis_bayar == 'tp')
                                        <h6
                                            class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold tx-primary mg-b-8">
                                            Titipan Pembayaran</h6>
                                    @else
                                        <h6
                                            class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-warning tx-semibold mg-b-8">
                                            Daftar Ulang</h6>
                                    @endif
                                </h6>
                                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                                    <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">Rp. {{ $pay->gross_amount }}</h3>
                                </div>
                                <div>
                                    <p class="mb-1">Order Id : {{ $pay->order_id }}</p>
                                    @if ($pay->transaction_status == 'pending')
                                        <p class="mb-1">Status : <span
                                                class="badge badge-danger">{{ Str::upper($pay->transaction_status) }}</span>
                                        </p>
                                    @elseif ($pay->transaction_status == 'settlement')
                                        <p class="mb-1">Status : <span
                                                class="badge bg-success">{{ Str::upper($pay->transaction_status) }}</span>
                                        </p>
                                    @else
                                        <p class="mb-1">Status : <span
                                                class="badge badge-dark">{{ Str::upper($pay->transaction_status) }}</span>
                                        </p>
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
                                <form action="{{ route('payment.bayar', $pay->id) }}" method="post">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Bayar</button>
                                </form>
                            </div>
                        </div><!-- col -->
                    @endforeach

                    {{-- <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
                        <div class="card card-body">
                            <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Unique Purchases</h6>
                            <div class="d-flex d-lg-block d-xl-flex align-items-end">
                                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">3,137</h3>
                                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger">0.7% <i
                                            class="icon ion-md-arrow-down"></i></span> than last week</p>
                            </div>
                            <div class="chart-three">
                                <div id="flotChart4" class="flot-chart ht-30"></div>
                            </div><!-- chart-three -->
                        </div>
                    </div><!-- col -->
                    <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
                        <div class="card card-body">
                            <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Avg. Order Value</h6>
                            <div class="d-flex d-lg-block d-xl-flex align-items-end">
                                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">$306.20</h3>
                                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger">0.3% <i
                                            class="icon ion-md-arrow-down"></i></span> than last week</p>
                            </div>
                            <div class="chart-three">
                                <div id="flotChart5" class="flot-chart ht-30"></div>
                            </div><!-- chart-three -->
                        </div>
                    </div><!-- col -->
                    <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
                        <div class="card card-body">
                            <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Order Quantity</h6>
                            <div class="d-flex d-lg-block d-xl-flex align-items-end">
                                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">1,650</h3>
                                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">2.1% <i
                                            class="icon ion-md-arrow-up"></i></span> than last week</p>
                            </div>
                            <div class="chart-three">
                                <div id="flotChart6" class="flot-chart ht-30"></div>
                            </div><!-- chart-three -->
                        </div>
                    </div><!-- col --> --}}
                </div>
            </div>
            <div class="card-footer"></div>
            @include('student.payment.modal.createpayment')
        </div>
    </div>
@endsection

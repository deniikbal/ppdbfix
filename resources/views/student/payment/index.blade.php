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
    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card-body">
                <div class="alert alert-solid alert-info alert-dismissible fade show" role="alert">
                    <p>Pada menu pembayaran ini silahkan untuk mengikuti </p>
                    <ol>
                        <li>Isi data siswa dengan mengklik
                            <diV class="badge badge-danger"> Verifikasi Data Siswa dan Sekolah</diV>
                            , harap di isi data siswa dengan
                            data sebenar-benarnya dan jika sudah terisi semua klik simpan permananen diakhir mengisi.
                        </li>
                        <li>Klik tombol
                            <div class="badge badge-primary">Pembayaran Biaya Pendidikan</div>
                            , upload bukti transfernya.
                        </li>
                        <li>Jika pembayaran sudah diverifikasi Download file
                            <div class="badge badge-dark">Kartu Peserta dan Kartu Formulir</div>
                        </li>
                    </ol>
                </div>
                <div class="alert alert-light">
                    @php
                        $student = App\Models\Student::where('user_id', auth()->id())->first();
                        $paymentxendit = App\Models\payment_xendit::where('student_id', $student->id)->get();
                        $countxendit = App\Models\payment_xendit::where('student_id', $student->id)->count();
                        $pay01 = App\Models\payment_xendit::where('student_id', $student->id)->count();
                        $pay02 = App\Models\payment_xendit::where('description', 'Titipan Pembayaran')->where('status',
                        'EXPIRED')->where('student_id', $student->id)->count();
                        $pay03 = App\Models\payment_xendit::where('description', 'Titipan Pembayaran')->where('status',
                        'pending')->where('student_id', $student->id)->count();
                        $settled = App\Models\payment_xendit::where('status','settled')->where('student_id',
                        $student->id)->where('description', 'Titipan Pembayaran')->count();
                    @endphp

                    <a href="#createpaymenttp" class="btn btn-danger btn-sm @if($settled==1) disabled @endif"
                       data-toggle="modal">Titipan Pembayaran</a>
                    @if($settled!=0)
                        <a href="#createpaymentdu" class="btn btn-success btn-sm" data-toggle="modal">Daftar Ulang</a>
                    @endif
                    @include('student.payment.modal.createpaymentdu')
                    @include('student.payment.modal.createpayment')
                </div>
                <div class="row">
                    @foreach ($paymentxendit as $pay)
                        <div class="col-sm-6 col-lg-3">
                            <div class="alert alert-light">
                                @if ($pay->description == 'Titipan Pembayaran')
                                    <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold tx-primary mg-b-8">
                                        Titipan
                                        Pembayaran
                                    </h6>
                                @else
                                    <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-warning tx-semibold mg-b-8">
                                        Daftar
                                        Ulang</h6>
                                @endif
                                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                                    <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">Rp. {{ $pay->amount }}</h3>
                                </div>
                                <div>
                                    <p class="mb-1">INVOICE : {{ $pay->external_id }}</p>
                                    @if ($pay->status == 'pending')
                                        <p class="mb-1">Status : <span
                                                    class="badge badge-danger">{{ Str::upper($pay->status) }}</span>
                                        </p>
                                    @elseif ($pay->status == 'SETTLED')
                                        <p class="mb-1">Status : <span
                                                    class="badge badge-success">{{ Str::upper($pay->status) }}</span>
                                        </p>
                                    @else
                                        <p class="mb-1">Status : <span
                                                    class="badge badge-dark">{{ Str::upper($pay->status) }}</span>
                                        </p>
                                    @endif

                                    @if($pay->status =='PENDING')
                                        <p class="mb-1 badge badge-danger">Expiry
                                            : {{ Carbon\carbon::parse($pay->expiry_date) }}
                                        </p>
                                    @endif
                                    @if ($pay->status == 'PENDING')
                                        <a href="{{ $pay->invoice_url }}" target="blank"
                                           class="btn btn-primary btn-block">
                                            Bayar
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div><!-- col -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

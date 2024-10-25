@extends('layouts.student.main')
@section('title')
    Pembayaran Calon Peserta Didik, {{$student->name}}
@endsection
@section('main')
    Pembayaran
@endsection
@section('data')
    Pembayaran Calon Peserta Didik
@endsection

@section('content')
    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card-body">
                <div class="alert alert-solid alert-info alert-dismissible fade show" role="alert">
                    <p>Pada menu pembayaran ini silahkan untuk mengikuti alur berikut : </p>
                    <ol>
                        <li>Silahkan untuk melakukan transfer titipan pembayaran sebesar <span
                                class="badge
                        badge-danger">Rp. 300
                                .000</span> ke
                            nomor
                            rekening yang di informasikan oleh admin.
                        </li>
                        <li>
                            Setelah melakukan transfer upload bukti transfer dengan mengklik tombol upload titipan
                            pembayaran, tunggu sampai di verifikasi oleh admin.
                        </li>
                    </ol>
                </div>
                <div class="alert alert-light">
                    @php
                        $student = App\Models\Student::where('user_id', auth()->id())->first();
                        $set = App\Models\WhatsApp::find(1);
                        $countverifikasi = App\Models\Payment::where('student_id', $student->id)
                            ->where('jenis_bayar', 'Titipan Pembayaran')
                            ->count();
                    @endphp
                    <a href="#uploadtp" class="btn btn-danger btn-sm @if ($countverifikasi == 1) disabled @endif"
                        data-toggle="modal">Titipan Pembayaran</a>
                    @if ($countverifikasi != 0)
                        <a href="#uploaddu" class="btn btn-success btn-sm" data-toggle="modal">Daftar Ulang</a>
                    @endif
                    @include('student.payment.modal.uploaddu')
                    @include('student.payment.modal.uploadtp')

                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <table id="example2" class="table">
                                <thead class="table-danger">
                                    <tr>
                                        <th>No.</th>
                                        <th>Invoice</th>
                                        <th>Nominal</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Bayar</th>
{{--                                        <th>Verifikasi</th>--}}
                                        <th>Bukti</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    @foreach ($payments as $pay)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $pay->id_bayar }}</td>
                                            <td>{{ $pay->nominal }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pay->tanggal)->isoFormat('D MMMM Y') }}</td>
                                            <td>{{ $pay->jenis_bayar }}</td>
{{--                                            <td>--}}
{{--                                                <span--}}
{{--                                                    class="badge badge-pill badge-{{ $pay->verifikasi == 1 ? 'info' : 'danger' }}">{{ $pay->verifikasi == 1 ? 'Sudah Verifikasi' : 'Belum Veriifikasi' }}</span>--}}
{{--                                            </td>--}}
                                            <td>
                                                <button type="button"
                                                    class="btn btn-sm pd-x-15 btn-primary btn-xs btn-uppercase mg-l-5"
                                                    data-toggle="modal" data-target="#viewbukti{{ $pay->id }}"><i
                                                        class="far
                                        fa-eye"></i></button>
                                            </td>
                                            <td>
                                                <form action="{{ route('deletepayment', $pay->id) }}" method="post"
                                                    style="display: inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Yakin Mau ' +
                                             'Verifikasi
                                            {{ $pay->id_bayar }}')"
                                                        class="btn btn-xs btn-danger"{{ $pay->verifikasi == 1 ? 'disabled' : '' }}>Hapus
                                                    </button>
                                                </form>
                                                {{-- <button type="button"
                                                    class="btn btn-sm pd-x-15 btn-primary btn-xs btn-uppercase mg-l-5"
                                                    data-toggle="modal" data-target="#editpay3{{ $pay->id }}"><i
                                                        class="far
                                        fa-edit"></i></button> --}}
                                            </td>
                                        </tr>
                                        @include('student.payment.modal.viewbukti')
                                        @include('student.payment.modal.editdu')
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#example2').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Cari data...',
                sSearch: '',
                lengthMenu: '_MENU_ items/halaman',
            },
        });
    </script>
@endpush

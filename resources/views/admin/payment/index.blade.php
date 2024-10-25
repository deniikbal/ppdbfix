@extends('layouts.admin.app')
@section('welcome')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Pembayaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Biaya Pendidikan</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Pembayaran Biaya Pendidikan</h4>
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
                <div class="card-header">
                    Pembayaran
                </div>
                <div class="card-body">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table">
                            <thead class="table-danger">
                                <tr>
                                    <th>No.</th>
                                    <th>No Daftar</th>
                                    <th>Nama Lengkap</th>
                                    <th>Invoice</th>
                                    <th>Nominal</th>
                                    <th>Tanggal</th>
                                    <th>Bukti Bayar</th>
                                    <th>Jenis Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                                $payments = App\Models\Payment::with('student')->get();
                            @endphp

                            <tbody>
                                @foreach ($payments as $pay)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $pay->student->nodaftar }}</td>
                                        <td>{{ $pay->student->name }}</td>
                                        <td>{{ $pay->id_bayar }}</td>
                                        <td>{{ $pay->nominal }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pay->tanggal)->isoFormat('D MMMM Y') }}</td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-sm pd-x-15 btn-danger btn-xs btn-uppercase mg-l-5"
                                                data-toggle="modal" data-target="#viewbukti{{ $pay->id }}"><i
                                                    class="far
                                        fa-eye"></i></button>
                                        </td>
                                        <td>
                                            @if ($pay->verifikasi == 1)
                                                <a class="badge badge-success badge-pill">{{ $pay->jenis_bayar }}</a>
                                            @else
                                                <a class="badge badge-primary badge-pill">{{ $pay->jenis_bayar }}</a>
                                            @endif
                                        </td>
                                        <td>
{{--                                            <form action="{{ route('verifikasipay', $pay->id) }}" method="post"--}}
{{--                                                style="display: inline-block">--}}
{{--                                                @csrf--}}
{{--                                                @method('PUT')--}}
{{--                                                <button type="submit"--}}
{{--                                                    onclick="return confirm('Yakin Mau ' +--}}
{{--                                             'Verifikasi--}}
{{--                                            {{ $pay->id_bayar }}')"--}}
{{--                                                    class="btn btn-xs btn-primary">Verifikasi--}}
{{--                                                </button>--}}
{{--                                            </form>--}}
                                            <form action="{{ route('deletepayment', $pay->id) }}" method="post"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Yakin Mau ' +
                                             'Verifikasi
                                            {{ $pay->id_bayar }}')"
                                                    class="btn btn-xs btn-danger">Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @include('student.payment.modal.viewbukti')
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- df-example -->
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
    <script type="text/javascript">
        $('.delete-confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endpush

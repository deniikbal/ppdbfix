@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info d-flex justify-content-end">
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
                                        <td>{{ $pay->jenis_bayar }}</td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-sm pd-x-15 btn-primary btn-xs btn-uppercase mg-l-5"
                                                data-toggle="modal" data-target="#editapikey{{ $pay->id }}"><i
                                                    class="far
                                        fa-edit"></i></button>
                                            <form onclick="return confirm('Yakin Mau Menghapus Api Key ')"
                                                action="{{ route('deletewa', $pay->id) }}" method="post"
                                                style="display: inline-block">
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="submit"><i
                                                        class="far
                                    fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
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
@endpush

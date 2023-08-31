@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                        data-target="#addschool"><i data-feather="plus"></i> Add
                        School
                    </button>
                </div>
                @php
                    $set = App\Models\WhatsApp::find(1);
                @endphp
                <div class="card-body">
                    <table id="example2" class="table">
                        <thead class="table-danger">
                            <tr>
                                <th>No.</th>
                                <th>Invoice</th>
                                <th>Nominal</th>
                                <th>Tanggal</th>
                                <th>Jenis Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                            $payments = App\Models\Payment::all();
                        @endphp
                        @foreach ($payments as $pay)
                            <tbody>
                                <tr>
                                    <td>{{ $no++ }}</td>
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
                            </tbody>
                            @include('admin.whatsapp.modal.editsettingwa')
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.school.modal.addschool')
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

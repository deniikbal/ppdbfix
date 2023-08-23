@extends('layouts.admin.app')

@section('welcome')
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Setting WhatsApp
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end mb-2">
                    <button type="button" class="btn btn-sm pd-x-15 btn-primary btn-xs btn-uppercase mg-l-5"
                            data-toggle="modal" data-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-file wd-10 mg-r-5">
                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                            <polyline points="13 2 13 9 20 9"></polyline>
                        </svg>
                        Add Setting WA
                    </button>
                    @include('admin.whatsapp.modal.addsettingwa')
                </div>
                <table id="example2" class="table">
                    <thead class="table-danger">
                    <tr>
                        <th>No.</th>
                        <th>Api Key</th>
                        <th>Sender</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($settings as $set)
                        <tbody>
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$set->api_key}}</td>
                            <td>{{$set->sender}}</td>
                            <td>
                                <button type="button" class="btn btn-sm pd-x-15 btn-primary btn-xs btn-uppercase mg-l-5"
                                        data-toggle="modal" data-target="#editapikey{{$set->id}}"><i class="far
                                        fa-edit"></i></button>
                                <form onclick="return confirm('Yakin Mau Menghapus Api Key ')" action="{{route
                                ('deletewa',
                                $set->id)}}" method="post" style="display: inline-block">
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
            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#example2').DataTable({
            responsive: false,
            language: {
                searchPlaceholder: 'Cari data...',
                sSearch: '',
                lengthMenu: '_MENU_ items/halaman',
            },
        });

    </script>
@endpush
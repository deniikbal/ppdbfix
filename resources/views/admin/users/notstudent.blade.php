@extends('layouts.admin.app')

@section('welcome')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Users</li>
            </ol>
        </nav>
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
                    {{-- <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                        data-target="#exampleModal"><i data-feather="user-plus"></i> Add Users
                    </button> --}}
                    <H6>Data User Belum Punya No Daftar</H6>
                </div>
                <div class="card-body">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table">
                            <thead class="table-danger">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>No Handphone</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;

                            @endphp

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->no_handphone }}</td>
                                        <td>{{ $user->role }}</td>
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
            responsive: false,
            language: {
                searchPlaceholder: 'Cari data...',
                sSearch: '',
                lengthMenu: '_MENU_ items/halaman',
            },
        });
    </script>
@endpush

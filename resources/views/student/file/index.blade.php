@extends('layouts.student.main')
@section('title')
    Upload File
@endsection
@section('main')
    Upload File
@endsection
@section('data')
    File
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="card bd-0 bd-md-x bd-md-y card-body mg-t-10 mb-2">
                <div class="media">
                    <span class="tx-color-05"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                   viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                   stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                   class="feather feather-book-open wd-60 ht-60"><path
                                    d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path
                                    d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg></span>
                    <div class="media-body mg-l-20">
                        <h6 class="mg-b-10">Upload Persyaratan</h6>
                        <p class="tx-color-05 mg-b-0">Silahkan Upload Ijazah SD, Kartu Keluarga dan Akte Lahir.
                        </p>
                    </div>
                </div><!-- media -->
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-primary-light d-flex justify-content-end">
                    <a href="{{route('file')}}" class="btn btn-primary btn-sm btn-outline-primary text-white"><i
                                data-feather="refresh-cw"></i>
                        Refresh</a>
                </div>
                <div class="card-body">
                    <div class="container d-flex justify-content-center">
                        <table class="table">
                            <thead class="table-danger">
                            <tr>
                                <th scope="col">Jenis Dokumen</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="tg-0lax" style="width: 500px">
                                    <span class="text-uppercase badge badge-primary font-weight-bold">Pas
                                        Foto
                                    </span>
                                    <br>
                                    Upload Pas Foto Ukuran 4x6 menggunakan pakaian seragam sekolah background biru
                                    dalam format file JPG,JPEG.
                                </td>
                                <td>
                                    @if($student->foto==null)
                                        <span class="text-uppercase badge badge-danger
                                        font-weight-bold">Belum Unggah</span>
                                    @else
                                        <span class="text-uppercase badge badge-success font-weight-bold">Sudah
                                            Unggah</span>
                                    @endif
                                </td>
                                <td class="tg-0lax">
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#uploadfoto">
                                        <i data-feather="upload"></i> Upload
                                    </button>
                                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal"
                                            data-target="#viewfoto{{$student->id}}">
                                        <i data-feather="eye"></i> View
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="tg-0lax" style="width: 500px">
                                    <span class="text-uppercase badge badge-primary font-weight-bold">Kartu Keluarga</span>
                                    <br>
                                    Upload Kartu Keluarga dalam format file JPG,JPEG. Kartu Keluarga diperlukan untuk
                                    verifikasi data di aplikasi DAPODIK.
                                </td>
                                <td>
                                    @if($student->doc_kk==null)
                                        <span class="text-uppercase badge badge-danger
                                        font-weight-bold">Belum Unggah</span>
                                    @else
                                        <span class="text-uppercase badge badge-success font-weight-bold">Sudah
                                            Unggah</span>
                                    @endif
                                </td>
                                <td class="tg-0lax">
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#uploadkk">
                                        <i data-feather="upload"></i> Upload
                                    </button>
                                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal"
                                            data-target="#viewkk{{$student->id}}">
                                        <i data-feather="eye"></i> View
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">
                                    <span class="text-uppercase badge badge-primary font-weight-bold">Akte Lahir</span>

                                    <br>
                                    Upload Akte Lahir dalam format file JPG,JPEG. Akte Lahir diperlukan untuk verifikasi
                                    data di aplikasi DAPODIK.
                                </td>
                                <td>
                                    @if($student->doc_akte==null)
                                        <span class="text-uppercase badge badge-danger
                                        font-weight-bold">Belum Unggah</span>
                                    @else
                                        <span class="text-uppercase badge badge-success font-weight-bold">Sudah
                                            Unggah</span>
                                    @endif
                                </td>
                                <td class="tg-0lax">

                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#uploadakte">
                                        <i data-feather="upload"></i> Upload
                                    </button>
                                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal"
                                            data-target="#viewakte{{$student->id}}">
                                        <i data-feather="eye"></i> View
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('student.file.modal.uploadkk')
    @include('student.file.modal.viewkk')
    @include('student.file.modal.uploadakte')
    @include('student.file.modal.viewakte')
    @include('student.file.modal.uploadfoto')
    @include('student.file.modal.viewfoto')
@endsection

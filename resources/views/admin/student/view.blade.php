@extends('layouts.admin.app')

@section('welcome')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Peserta Didik</a></li>
                <li class="breadcrumb-item active" aria-current="page">Calon Peserta Didik</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Calon Peserta Didik</h4>
    </div>
    <div class="d-none d-md-block">
        <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="clock" class="wd-10 mg-r-5"></i>
            {{ \Carbon\Carbon::now()->format('D, d M Y H:i:s') }}
        </button>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-end mb-2">
                <a href="{{ route('allstudent') }}" class="btn btn-danger btn-sm mr-3"><i
                        data-feather="skip-back"></i>Back</a>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Data Calon Peserta Didik
                    </div>
                    <div class="card-body">
                        <style type="text/css">
                            .tg  {border-collapse:collapse;border-spacing:0;}
                            .tg td{border-color: #ffffff;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                                overflow:hidden;padding:10px 5px;word-break:normal;}
                            .tg th{border-color: #ffffff;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                                font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
                            .tg .tg-0lax{text-align:left;vertical-align:top}
                        </style>
                        <table class="tg" style="undefined;table-layout: fixed; width: 501px"><colgroup>
                                <col style="width: 180.333333px">
                                <col style="width: 27.333333px">
                                <col style="width: 250.333333px">
                            </colgroup>
                            <thead>
                            <tr>
                                <th class="tg-0lax">NIK</th>
                                <th class="tg-0lax">:</th>
                                <th class="tg-0lax">{{$student->nik}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="tg-0lax">Nama Lengkap</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->name}}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">NISN</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->nisn}}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Jenis Kelamin</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->nisn}}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Tempat Lahir</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->tempat_lahir}}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Tanggal Lahir</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{date('d-m-Y', strtotime($student->tanggal_lahir))}}</td>
                            </tr>

                            <tr>
                                <td class="tg-0lax">Alamat</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->alamat_pd}}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Desa / Kelurahan</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->desa_pd}}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Kecamatan</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->kec_pd}}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Kabupaten</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->kota_pd}}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Provinsi</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->provinsi_pd}}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Kode Pos</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->kode_pos}}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Agama</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->agama}}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Suku</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->suku}}</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">Bahasa</td>
                                <td class="tg-0lax">:</td>
                                <td class="tg-0lax">{{$student->bahasa}}</td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
                <div class="col-lg-6">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    Data Ayah / Wali
                                </div>
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    Data Ibu
                                </div>
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

        </div>

    </div>
@endsection

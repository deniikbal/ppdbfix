@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-lg-2">
            <div class="card">
                .
                <form action="{{route('sendnotif')}}" method="post">
                    @csrf
                    <button class="btn btn-primary" type="submit">Test</button>
                </form>
                <form action="{{route('bayar')}}" method="post">
                    @csrf
                    <button class="btn btn-danger" type="submit">Bayar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
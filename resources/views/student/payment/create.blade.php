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
    <div class="col-lg-8 mb-2">
        <div class="card bd-gray-500">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Payment Detail</h6>
                <div class="p-3" style="background-color: #eee;">
                    <div class="d-flex justify-content-between mt-2">
                        <span>Nama Calon Siswa</span> <span>{{ $temppayment->name }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Email</span> <span>{{ $temppayment->email }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>No Hp</span> <span>{{ $temppayment->nohp }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Jenis Pembayaran</span> <span>{{ $temppayment->jenis_bayar }}</span>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between mt-2">
                        <span>Nominal Pembayaran</span> <span> Rp. {{ $temppayment->nominal }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card bd-gray-500">
            <div class="card-body">
                <h6 class="card-subtitle mb-2">Perhatikan Data-data Pembayaran</h6>
                <button class="btn btn-danger" id="pay-button">Bayar</button>
            </div>
        </div>
    </div>

    <form action="{{ route('checkout', $temppayment->id) }}" id="submit_form" method="POST">
        @csrf
        <input type="hidden" name="json" id="json_callback">
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    send_response_to_form(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    send_response_to_form(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    send_response_to_form(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });

        function send_response_to_form(result) {
            document.getElementById('json_callback').value = JSON.stringify(result);
            $('#submit_form').submit();
        }
    </script>
@endsection

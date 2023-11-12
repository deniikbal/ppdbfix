<div class="modal fade" id="uploaddu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Pembayaran Daftar Ulang</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('uploadtp') }}" enctype="multipart/form-data">
                    {{--                <form method="POST" action="{{ route('payment_xendit') }}"> --}}
                    @csrf
                    <input type="hidden" name="id" value="{{ $student->id }}">
                    <input type="hidden" name="idUser" value="{{ auth()->id() }}">
                    <div class="form-group mb-2">
                        <label for="formGroupExampleInput" class="d-block">Nama Calon Siswa</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter your full name" value="{{ $student->name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="formGroupExampleInput" class="d-block">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your full email" value="{{ auth()->user()->email }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="formGroupExampleInput" class="d-block">Tanggal Pembayaran</label>
                        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="formGroupExampleInput2" class="d-block">Nama Pembayaran</label>
                        <input type="text" name="jenis_bayar" class="form-control" value="Daftar Ulang" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="formGroupExampleInput2" class="d-block">Jenis Pembayaran</label>
                        <select name="jenis_pembayaran"
                            class="form-control @error('jenis_pembayaran') is-invalid @enderror">
                            <option value="">--Pilih--</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                        </select>
                        @error('jenis_pembayaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="formGroupExampleInput" class="d-block">Nominal Pembayaran DU</label>
                        <input type="text" name="nominal" id="nominal"
                            class="form-control @error('nominal') is-invalid @enderror" placeholder="Nominal Pembayaran"
                            value="{{ old('nominal') }}"
                            data-inputmask="'alias': 'numeric','prefix':'Rp. ','digits':0,'groupSeparator':'.','autoGroup':true,'digitsOptional':true,'removeMaskOnSubmit':true,'autoUnmask':true">
                        @error('nominal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="formGroupExampleInput" class="d-block">Bukti Pembayaran</label>
                        <input type="file" name="bukti_bayar"
                            class="form-control @error('bukti_bayar') is-invalid @enderror"
                            placeholder="Nominal Pembayaran">
                        @error('bukti_bayar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger tx-13">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadakte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Upload Akte Lahir {{auth()->id()}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('uploadakte') }}" enctype="multipart/form-data">
                    {{--                <form method="POST" action="{{ route('payment_xendit') }}">--}}
                    @csrf
                    <input type="hidden" name="id" value="{{ $student->id }}">
                    <input type="hidden" name="oldfile" value="{{$student->doc_akte}}">
                    <div class="form-group mb-2">
                        <label for="formGroupExampleInput" class="d-block">Akte Lahir</label>
                        <input type="file" name="doc_akte"
                               class="form-control @error('doc_akte') is-invalid @enderror"
                               placeholder="Nominal Pembayaran">
                        @error('doc_akte')
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

<div class="modal fade" id="exampleModal{{ $student->uuid }}" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT ASAL SEKOLAH</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="image-upload" method="post" action="{{ route('updatesekolah', $student->uuid) }}"
                  enctype="multipart/form-data" id="locations">
                @csrf
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail3">Asal Sekolah</label>
                            <select class="form-control select2" id="asal_sekolah" name="asal_sekolah">
                                <option value="">---Pilih---</option>
                                @foreach ($schools as $item)
                                    <option
                                            value="{{ $item->id }}"{{ $item->sekolah == $student->asal_sekolah ? 'selected' : '' }}>
                                        {{ $item->sekolah }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="formSubmit">Update Sekolah</button>
                </div>
            </form>
        </div>
    </div>
</div>


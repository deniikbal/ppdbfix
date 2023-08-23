<div class="modal fade" id="editapikey{{$set->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">WA SETTING</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="image-upload" method="post" action="{{ route('waupdate', $set->id)}}"
                  enctype="multipart/form-data" id="locations">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="form-row mb-1">
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">Api Key</label>
                            <input type="text" name="api_key" id="api_key" class="form-control @error('api_key')
                            is-invalid @enderror"
                                   placeholder="Api Key" value="{{ $set->api_key }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">Wa Sender</label>
                            <input type="text" name="sender" id="sender"
                                   class="form-control @error('sender') is-invalid @enderror" placeholder="WA Sender"
                                   value="{{ $set->sender }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="formSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

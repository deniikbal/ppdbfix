<div class="modal fade" id="viewfoto{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Pas Foto {{$student->name}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/' . $student->foto. '#zoom=25') }}" frameborder="0" width="100%"
                     height="100%" frameborder="0" allowfullscreen>
            </div>
        </div>
    </div>
</div>
</div>

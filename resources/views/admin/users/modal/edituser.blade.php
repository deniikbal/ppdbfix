<div class="modal fade" id="exampleModal{{$user->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User {{$user->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('users.update', $user->id)}}" method="post">
                @method('put')
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" id="name" class="form-control"
                                   placeholder="Nama Lengkap" value="{{$user->name}}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid
                            @enderror" placeholder="Email" value="{{$user->email}}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Role</label>
                        <div class="col-sm-8">
                            <select name="role" id="role" class="form-control select2">
                                <option value="">--Pilih--</option>
                                <option value="admin" {{$user->role =="Admin" ? 'selected' :
                                ''}}>Admin</option>
                                <option value="student" {{$user->role =="Student" ? 'selected' :
                                ''}}>Student</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">No Handphone</label>
                        <div class="col-sm-8">
                            <input type="text" name="no_handphone" id="no_handphone" class="form-control @error('no_handphone')
                            is-invalid @enderror"
                                   placeholder="No Handphone" value="{{$user->no_handphone}}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" id="password" class="form-control @error('password')
                            is-invalid
                            @enderror"
                                   placeholder="Password" value="{{old('password')}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" >Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

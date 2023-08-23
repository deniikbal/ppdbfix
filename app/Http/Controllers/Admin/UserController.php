<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\RegisterNewUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        $users = User::all();
        return $dataTable->render('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->password == null) {
            $user->update([
                'name' => $request->name,
                'no_handphone' => $request->no_handphone,
                'email' => $request->email,
                'role' => $request->role,
            ]);
            return redirect()->route('users.index')->with('success', 'User ' . $request->name . ' Berhasil di Update');
        } else {
            $user->update([
                'name' => $request->name,
                'no_handphone' => $request->no_handphone,
                'email' => $request->email,
                'role' => $request->role,
                'password_plain' => $request->password,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('users.index')->with('success', 'User ' . $request->name . ' Berhasil di Update');
        }

    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', ' Berhasil di Hapus');
    }

    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'role' => 'required',
            'no_handphone' => 'required',
            'password' => 'required',
        ]);
        if ($valid->fails()) {
            return response()->json(['errors' => $valid->errors()->all()]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_handphone' => $request->no_handphone,
                'role' => $request->role,
                'password_plain' => $request->password,
            ]);
            RegisterNewUser::dispatch($user);
        }
    }

    public function regisnewuser($id)
    {
        $user = User::find($id);
        RegisterNewUser::dispatch($user);
        return redirect()->back()->with('success', ' Berhasil di Hapus');
    }
}

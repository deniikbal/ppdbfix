<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\RegisterNewUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        $title = 'User Managemenet';
        $users = User::all();
        return $dataTable->render('admin.users.index', compact('users', 'title'));
    }

    public function show($id)
    {
        $title = 'Edit User';
        $user = User::find($id);
        return view('admin.users.show', compact('user', 'title'));
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
        return redirect()->back()->with('success', ' Berhasil Mengirim Wa');
    }

    public function notstudent()
    {
        $users = User::doesntHave('student')
            ->where('role', 0)
            ->get();
        $title = 'User Belum Punya No Daftar';
        // $users = User::whereDoesntHave('student', function (Builder $query) {
        //     $query->where('role',);
        // })->get();
        //dd($users);
        return view('admin.users.notstudent', compact('users', 'title'));
    }
}

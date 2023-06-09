<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.users-list', ['users' => $users]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.edit-user', ['user' => $user]);
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['id']);
        unset($data['_token']);
        unset($data['id']);
        $flag = $user->update($data);
        if ($flag) {
            return response()->json(['is' => 'success', 'complete' => 'Người dùng đã được cập nhật']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Người dùng chưa được cập nhật']);
    }

    public function destroy($id)
    {
        return User::findOrFail($id)->delete();
    }
}

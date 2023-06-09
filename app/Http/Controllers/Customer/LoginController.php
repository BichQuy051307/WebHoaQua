<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
//đăng nhập 
class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        //Hàm Validator kiểm tra xem các trường email và password có được cung cấp hay không.
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập mật khẩu',
        ]);

        if ($validator->fails()) {
            return response()->json(['is' => 'login-failed', 'error' => $validator->errors()->all()]);
        }
        //Auth::attempt để thử đăng nhập người dùng/ kt có khớp với csdl hay 
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember = true)) {
            if (Auth::user()->role == 'customer') { // xác định là khách hàng
                return response()->json(['is' => 'login-success']);
            }
            Auth::logout();
        }
        return response()->json(['is' => 'incorrect', 'incorrect' => 'Sai tài khoản hoặc mật khẩu!']);
    }
}

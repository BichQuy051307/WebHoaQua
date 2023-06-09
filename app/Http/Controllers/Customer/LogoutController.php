<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/');//chuyển hướng người dùng đến trang chủ hoặc trang được chỉ định trước đó (nếu có).
    }
}

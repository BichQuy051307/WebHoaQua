<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/user/member';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('showLoginForm', 'logoutAdmin', 'postLoginAdmin', 'getChangePassword', 'changePassword');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * get login admin
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * login admin
     */
    public function postLoginAdmin(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|min:8|max:32'
            ],
            [
                'email.required' => 'Email là trường bắt buộc',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Mật khẩu là trường bắt buộc',
                'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
                'password.max' => 'Mật khẩu tối đa 32 kí tự',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['is' => 'login-failed', 'error' => $validator->errors()->all()]);
        }
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::guard('admin')->user()->role == 'admin') {
                return response()->json(['is' => 'login-success']);
            }
            Auth::logout();
        }
        return response()->json(['is' => 'incorrect', 'incorrect' => 'Sai tên đăng nhập hoặc mật khẩu!']);
    }

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function getChangePassword()
    {
        return view('admin.change-password');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'old_pass' => 'required',
                'new_pass' => 'required|min:8|max:32',
                're_new_pass' => 'required'
            ],
            [
                'old_pass.required' => 'Bạn chưa nhập mật khẩu cũ',
                'new_pass.required' => 'Bạn chưa nhập mật khẩu mới',
                're_new_pass.required' => 'Bạn cần nhập lại mật khẩu mới',
                'new_pass.min' => 'Mật khẩu tối thiểu 8 kí tự',
                'new_pass.max' => 'Mật khẩu tối đa 32 kí tự',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }

        $old_pass =  $request->old_pass;
        $new_pass = trim($request->new_pass);
        $re_new_pass = trim($request->re_new_pass);
        if ($new_pass !== $re_new_pass) {
            return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Mật khẩu mới không khớp !!']);
        }

        if ($id = Auth::guard('admin')->user()->id) {
            $password = DB::table('admins')->find($id)->password;
        } else {
            return redirect()->back();
        }

        if (Hash::check($old_pass, $password)) {
            DB::table('admins')->where('id', $id)->update(['password' => bcrypt($new_pass)]);
            Auth::guard('admin')->logout();
            return response()->json(['is' => 'success', 'complete' => 'Đổi mật khẩu thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Mật khẩu hiện tại không đúng']);
    }
}

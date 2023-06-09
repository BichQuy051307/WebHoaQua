<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    // hiển thị trang tài khoản của người dùng (nếu người dùng đã đăng nhập và $user_id trùng khớp với id của người dùng)
    public function myAccount($user_id)
    {
        if (Auth::check()) {
            if ($user_id == Auth::user()->id) {
                $user = User::where('id', $user_id)->first();
                return view('my_account', compact('user'));
            }
        }
        return view('404');
    }

//xử lý yêu cầu cập nhật thông tin tài khoản người dùng. Nó kiểm tra và xác thực dữ liệu đầu vào, sau đó cập nhật thông tin tài khoản trong cơ sở dữ liệu và trả về phản hồi JSON tương ứng.
    public function updateMyAccount(Request $request) 
    {
        $validator = Validator::make( // tạo một đối tượng Validator để kiểm tra dữ liệu đầu vào từ yêu cầu.
            $request->all(),
            [
                'name' => 'required',
                'address' => 'required'
            ],
            [
                'name.required' => 'Bạn chưa nhập họ tên!!',
                'address.required' => 'Bạn chưa nhập địa chỉ!!',
            ]
        );
//Nếu Validator xác nhận rằng dữ liệu không hợp lệ (fails), phương thức trả về một JSON response với các thông tin lỗi từ Validator.
        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data['user_id'] = $request->user_id; // neu dữ liệu hợp
        $data['name'] = $request->name;
        $data['address'] = $request->address;
        if (Auth::check()) { //phương thức kiểm tra xem người dùng đã đăng nhập (Auth::check()) và xác thực người dùng có khớp với $data['user_id'] hay không.
            if (Auth::user()->id == $data['user_id']) {
                $user = User::where('id', $data['user_id'])
                    ->update(['name' => $data['name'], 'address' => $data['address']]);
                if ($user) {
                    return response()->json(['is' => 'success', 'complete' => 'Thông tin tài khoản đã được cập nhật']);
                }
                return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Việc cập nhật thông tin tài khoản đã gặp sự cố!']);
            }
        }
        return view('404');
    }
}

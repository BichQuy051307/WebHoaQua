<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderHistoryController extends Controller
{
    //quyền truy cập của người dùng và hiển thị danh sách đơn hàng của người dùng
    public function myOrder($user_id)//id của người dùng cần hiển thị đơn hàng
    {
        if (Auth::check()) {//kiểm tra 
            if ($user_id == Auth::user()->id) {
                $orders = Order::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(5);//Kết quả truy vấn được sắp xếp theo thời gian tạo (orderBy('created_at', 'desc')) và phân trang (hiển thị 5 đơn hàng trên mỗi trang).
                return view('my_orders', compact('orders'));
            }
        }
        return view('404');
    }
    //quyền truy cập của người dùng và hiển thị chi tiết đơn hàng tương ứng
    public function myOrderDetail($order_id)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $order = Order::where('order_id', $order_id)->where('user_id', $user_id)->first();
            if ($order) {//nếu tồn tại order
                $order_detail = OrderDetail::where('order_id', $order_id)->where('status', 1)->paginate(5);//các chi tiết đơn hàng từ cơ sở dữ liệu với điều kiện order_id bằng $order_id và status bằng 1 (để lọc các chi tiết đơn hàng có trạng thái đúng)
                return view('my_orders_detail', compact('order_detail'));
            }
        }
        return view('404');
    }
}
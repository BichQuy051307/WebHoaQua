<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // tìm kiếm sản phẩm
    public function search(Request $request){
        $parameter = trim($request->parameter);//Lấy tham số parameter từ yêu cầu, tham số là từ muốn tìm
        $products = Product::where('name', 'like', "%$parameter%")->where('status', 1)->where('quantity', '>', 0)->orderBy('name', 'asc')->paginate(15);// Các sản phẩm phải có trạng thái là 1 (hoạt động) và số lượng lớn hơn 0
        return view('search', ['parameter' => $parameter, 'products' => $products]);//sắp xếp theo tên sản phẩm theo thứ tự tăng dần.
        //% đại diện cho bất kỳ ký tự nào. 
    }

    // chi tiết sản phẩm
    public function productDetail($slug)
    {
        $product_key = 'product' . $slug;//Tạo khóa $product_key bằng cách kết hợp chuỗi 'product' với $slug
        $current_time = time();//Lấy thời gian hiện tại sử dụng hàm time
        if (Session::has($product_key)) { //kiểm tra xem phiên làm việc có tồn tại khóa $product_key hay không
            if ($current_time - Session::get($product_key) > 1800) {//So sánh thời gian hiện tại với thời gian lưu trữ trong session,trôi qua 1800 giây
                Product::where('slug', $slug)->firstOrFail()->increment('view_count');//tăng sl lượt xem
                Session::put(//cập nhật thời gian
                    [
                        $product_key => $current_time,
                    ]
                );
            }
        } else {
            Product::where('slug', $slug)->firstOrFail()->increment('view_count');
            Session::put(
                [
                    $product_key => $current_time,
                ]
            );
        }
        $product = Product::where('slug', $slug)->first();
        return view('product_detail', compact('product'));
    }
}

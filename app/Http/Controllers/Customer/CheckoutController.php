<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');//duyệt từng muc trong giỏ hàng
            //
            foreach ($cart as $id => $product) {
                $item = Product::where('id', $id)->first();
                if ($product['qty'] > $item->quantity) {//so sánh số lượng yêu cầu với sl hiện có
                    return view('shopping_cart', ['limit' => 'Sản phẩm ' . $product['name'] . ' không đáp ứng đủ số lượng! Sản phẩm này hiện có số lượng là ' . $item->quantity . '.']);
                }
            }
            //chuỗi đại diện cho mã đơn hàng
            $order_id = "ORD" . "" . date('YmdHis') . strtoupper(Str::random(3)); // "ORD YYYYMMDDHHMMSS XXX" order_id
            // chi tiết đơn hàng mới cho mỗi sản phẩm trong giỏ hàng.
            foreach ($cart as $id => $product) {
                $data = [];
                $data['order_id'] = $order_id;
                $data['product_id'] = $id;
                $data['name'] = $product['name'];
                $data['slug'] = $product['slug'];
                $data['code'] = $product['code'];
                $data['image'] = $product['image'];
                $data['price'] = $product['price'];
                $data['price_sale'] = $product['price_sale'];
                $data['quantity'] = $product['qty'];

                OrderDetail::create($data);
            }
            //lấy thông tin chi tiết đơn hàng cần thanh toán
            $orders = OrderDetail::where('status', 0)->where('order_id', $order_id)->get();
            return view('checkout', ['orders' => $orders, 'order_id' => $order_id]);
        }
        return view('checkout');
    }

    public function order(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'phone' => 'required|max:11',
                'address' => 'required',
            ],
            [
                'name.required' => 'Tên khách hàng không được để trống',
                'name.max' => 'Tên khách hàng không được nhiều hơn 255 kí tự',
                'phone.required' => 'Số điện thoại không được để trống',
                'address.required' => 'Địa chỉ nhận hàng không được để trống',
                'phone.max' => 'Số điện thoại không quá 11 số',
            ]
);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $data['order_id'] = $request->order_id;//lấy thông tin từ $request và lưu vào một mảng $data. 
            $data['amount'] = $request->amount;

            // upload anh 
            $time = time();
            if ($files = $request->file('image_prescriptions')) {
                $destinationPath = 'images/prescriptions/'; // upload path
                $time = time();
                $fileName = $time . "" . date('YmdHis') . "" . $files->hashName();
                $files->move($destinationPath, $fileName);
                $data['image'] = $fileName;
            }

           //thu thập thông tin khách hàng từ biểu mẫu đặt hàng và gán chúng vào các trường tương ứng của đối tượng $data để lưu trữ thông tin đơn hàng.
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['address'] = $request->address;
            $data['customer_notes'] = $request->note;
            $data['user_id'] = auth()->user()->id;
            //tạo hoặc cập nhật đối tượng $order    
            $order = Order::updateOrCreate($data);

            if (Session::has('cart')) { //nếu có thông tin giỏ hàng trong Session
                Session::forget('cart');//giỏ hàng được làm trống sau khi đặt hàng thành công.
            }

            if ($order) {
                $products_order_detail = DB::table('orders_detail')//lấy danh sách các sản phẩm trong đơn hàng chi tiết 
                    ->where('order_id', $order->order_id)//truy vấn cơ sở dữ liệu với điều kiện order_id tương ứng với order->order_id.
                    ->get();

                foreach ($products_order_detail as $item) {// lặp qua các ctdh
                    $product = DB::table('products')// lấy thông tin số lượng (quantity) của sản phẩm tương ứng với product_id của mỗi mục trong đơn hàng chi tiết
                        ->select('quantity')
                        ->where('id', $item->product_id)
                        ->first();

                    $quantity = $product->quantity - $item->quantity;//tính toán số lượng mới bằng cách trừ đi số lượng đã bán từ số lượng ban đầu của sản phẩm.
                    if ($quantity < 0) {
                        return Redirect::back()->withErrors('Sản phẩm ' . $product->name . ' không đáp ứng đủ số lượng! Sản phẩm này hiện có số lượng là ' . $product->quantity . '.');
                    }
                    DB::table('products')->where('id', $item->product_id)
                        ->update([
                            'quantity' => $quantity
                        ]);
                }
                //cập nhật trạng thái chi tiết đơn hàng
                $order_detail = DB::table('orders_detail')->where('order_id', $order->order_id)
                    ->update([
                        'status' => 1 //các chi tiết đơn hàng đã được xử lý và có trạng thái đã hoàn thành.
                    ]);

                if ($order_detail) {
                    return redirect('/checkout/order-received/' . $order->order_id);
                } else {
                    DB::table('orders')->where('order_id', $order->order_id)
                        ->update([
                            'notes' => 'Lỗi hệ thống đã xảy ra',
                            'status' => 3,
                        ]);
                    return view('500');
                }
            }
            return view('500');
        }
    }
    //hiển thị trang "order_received" sau khi đơn hàng đã được tiếp nhận.
    public function orderReceived($order_id)
    {
        $order = Order::where('order_id', $order_id)->first();
        $order_detail = OrderDetail::where('order_id', $order_id)->where('status', 1)->get();
        if (isset($order) && isset($order_detail)) {
            return view('order_received', [
                'success' => 'Cám ơn bạn. Đơn hàng của bạn đã được tiếp nhận.',
                'order' => $order, 'order_detail' => $order_detail
            ]);
        }
        return view('404');
    }
}
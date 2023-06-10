<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //hiển thị danh sách các đơn đặt hàng
    public function index()
    {
        $orders = Order::all();//truy vấn tất cả các đơn đặt hàng từ cơ sở dữ liệu và gán chúng cho biến $orders.
        return view('admin.order.order_lists', ['orders' => $orders]);//hiển thị danh sách đơn đặt hàng và có thể truy cập thông tin của mỗi đơn đặt hàng thông qua biến $orders.
    }
    //hiển thị danh sách các đơn đặt hàng chờ xử lý 
    public function pending()
    {
        $orders = Order::where('status', 0)->get();//Biến $orders được gán giá trị là tất cả các bản ghi trong bảng orders mà có trường status có giá trị là 0
        return view('admin.order.order_lists_pending', ['orders' => $orders]);
    }
    //hiển thị danh sách các đơn đặt hàng đã được gửi đi
    public function shipped()
    {
        $orders = Order::where('status', 1)->get();
        return view('admin.order.order_lists_shipped', ['orders' => $orders]);
    }
    //hiển thị danh sách các đơn đặt hàng đã giao hàng thành công
    public function delivered()
    {
        $orders = Order::where('status', 2)->get();
        return view('admin.order.order_lists_delivered', ['orders' => $orders]);
    }
    //hiển thị danh sách các đơn đặt hàng đã bị hủy
    public function cancel()
    {
        $orders = Order::where('status', 3)->get();
        return view('admin.order.order_lists_cancel', ['orders' => $orders]);
    }
    //sẽ hiển thị chi tiết của một đơn đặt hàng dựa trên order_id đã được cung cấp.
    public function show($order_id)
    {
        $relationship = ['orderDetails', 'censor:id,email,name'];
        $order = Order::with($relationship)->where('order_id', $order_id)->first();

        return view('admin.order.order_detail', ['order' => $order]);
    }
    //cập nhật trạng thái của một đơn đặt hàng dựa trên dữ liệu gửi lên và lưu trạng thái đã thay đổi vào cơ sở dữ liệu.
    public function update(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $data = $request->all();
            $order = Order::find($data['id']);
            if ($order->status == 0) { //Nếu trạng thái là 0, tức là chưa giao hàng, thì nó sẽ được cập nhật thành 1, tức là đã giao hàng. 
                $order->status = 1;
                $order->censor_id = auth()->guard('admin')->user()->id ?? "";
            } else if ($order->status == 1) {
                $order->status = 2;
            } else {
                $order->status = 3;
            }
            //cập nhật số lượng sản phẩm đã được mua hàng khi đơn hàng có trạng thái là 2 (đã hoàn thành)
            if ($order->status == 2) {
                $products_order_detail = DB::table('orders_detail')//lấy tất cả các mục trong bảng orders_detail
                    ->where('order_id', $order->order_id)
                    ->get();

                foreach ($products_order_detail as $item) {
                    $product = DB::table('products')
                        ->select('bought')//để lấy số lượng đã mua của sản phẩm có id tương ứng với product_id của mục hiện tại. 
                        ->where('id', $item->product_id)
                        ->first();

                    $bought = $product->bought + $item->quantity; //Tính toán giá trị mới cho số lượng đã mua  bằng cách thêm số lượng (quantity) của mục hiện tại vào $product->bought

                    DB::table('products')->where('id', $item->product_id)// cập nhật số lượng đã mua của sản phẩm có id tương ứng với product_id của mục hiện tại
                        ->update([
                            'bought' => $bought
                        ]);
                }
            }
            // lưu các thay đổi đã thực hiện trên đơn hàng
            $flag = $order->save();
            if ($flag) {
                return response()->json(['is' => 'success', 'complete' => 'Đã cập nhật đơn hàng!']);
            }
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Đã xảy ra lỗi!']);
    }
    //hủy đơn hàng bằng cách cập nhật các trạng thái và số lượng sản phẩm liên quan trong cơ sở dữ liệu
    public function cancelOrder(Request $request)
    {
        $data = $request->all();//lấy dữ liệu gửi từ client
        $order = Order::find($data['id']);

        $products_order_detail = DB::table('orders_detail')//lấy danh sách chi tiết đơn hàng (orders_detail) của đơn hàng được hủy. 
            ->where('order_id', $order->order_id)
            ->get();

        foreach ($products_order_detail as $item) { //duyệt qua danh sách  và cập nhật số lượng  của sản phẩm tương ứng trong bảng products. 
            $product = DB::table('products')
                ->select('quantity')
                ->where('id', $item->product_id)
                ->first();

            $quantity = $product->quantity + $item->quantity;//Số lượng sản phẩm được cập nhật bằng cách thêm lại vào số lượng hiện tại.

            DB::table('products')->where('id', $item->product_id)
                ->update([
                    'quantity' => $quantity
                ]);
        }
        //mã cập nhật trạng thái (status) của các chi tiết đơn hàng trong bảng orders_detail thành 0 (đánh dấu là đã hủy).
        DB::table('orders_detail')->where('order_id', $order->order_id)
            ->update([
                'status' => 0
            ]);

        if (Auth::guard('admin')->check()) {
            $order->status = 3;
            $order->save();
            return response()->json(['is' => 'success', 'complete' => 'Đơn hàng vừa bị hủy!']);
        }

        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Đơn hàng chưa bị hủy!']);
    }
    //Hàm destroy nhận một tham số $id là ID của đơn hàng cần xóa
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
    }
}

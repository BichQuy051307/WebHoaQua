<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller
{
    //lay du lieu tu session và truyen vao
    public function index()
    {
        $data = [];
        if (Session::has('cart')) { //kiểm tra xem session có tồn tại giỏ hàng hay không
            $data = Session::get('cart');//giá trị của giỏ hàng được lấy từ session
        }
        return view('shopping_cart', compact('data'));
    }

    public function addSpecialItem(Request $request)
    {
        $id = $request->id;// lấy id và qty từ request
        $qty = $request->qty;// tìm kiếm sản phẩm tương ứng với id
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['is' => 'failed', 'message' => 'Sản phẩm không tồn tại']);
        }
        if ($qty > 3) {
            return response()->json(['is' => 'failed', 'message' => 'Sản phẩm đã vượt quá số lượng cho phép']);
        }

        $cart = Session::get('cart');
        // Nếu giỏ hàng trống,chúng ta tạo một mảng mới và thêm sản phẩm vào giỏ hàng với id là khóa và thông tin sản phẩm là giá trị
        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "slug" => $product->slug,
                    "code" => $product->code,
                    "image" => $product->image,
                    "price" => $product->price,
                    "price_sale" => $product->price_sale,
                    "qty" => $qty
                ]
            ];
            Session::put('cart', $cart);//lưu giỏ hàng
            return response()->json(['is' => 'success', 'message' => 'Sản phẩm đã được thêm vào giỏ hàng']);
        }

        //nếu giỏ hàng không trống thì kiểm tra xem sản phẩm này có tồn tại không thì tăng số lượng
        if (isset($cart[$id])) {//kiểm 
            if($cart[$id]['qty'] + $qty > 3){
                return response()->json(['is' => 'failed', 'message' => 'Sản phẩm đã vượt quá số lượng cho phép']);
            }
            $cart[$id]['qty'] += $qty;//Nếu số lượng không vượt quá giới hạn, cập nhật số lượng của sản phẩm trong giỏ hàng bằng cách tăng giá trị
        } else {
            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "name" => $product->name,
                "slug" => $product->slug,
                "code" => $product->code,
                "image" => $product->image,
                "price" => $product->price,
                "price_sale" => $product->price_sale,
                "qty" => $qty
            ];
        }
        Session::put('cart', $cart);
        return response()->json(['is' => 'success', 'message' => 'Sản phẩm đã được thêm vào giỏ hàng']);
    }

    public function addItem(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);//lấy id từ request và tìm kiếm sản phẩm tương ứng với id
        if (!$product) {
            return response()->json(['is' => 'failed', 'message' => 'Sản phẩm không tồn tại']);
        }
        $cart = Session::get('cart');//lấy giỏ  
        // Nếu giỏ hàng trống, tạo một mảng mới và thêm sản phẩm vào giỏ hàng với id là khóa và thông tin sản phẩm là giá trị
        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "slug" => $product->slug,
                    "code" => $product->code,
                    "image" => $product->image,
                    "price" => $product->price,
                    "price_sale" => $product->price_sale,
                    "qty" => 1 //số lượng được đặt là 1
                ]
            ];
            Session::put('cart', $cart);//lưu
            return response()->json(['is' => 'success', 'message' => 'Sản phẩm đã được thêm vào giỏ hàng']);
        }

        // nếu giỏ hàng không rỗng và sản phẩm với id đã tồn tại trong giỏ hàng 
        if (isset($cart[$id])) {
            if($cart[$id]['qty'] > 3){
                return response()->json(['is' => 'failed', 'message' => 'Sản phẩm đã vượt quá số lượng cho phép']);
            }
            $cart[$id]['qty']++;//số lượng chưa vượt quá giới hạn, tăng số lượng (qty) của sản phẩm trong giỏ hàng lên 1 
        } else {
            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                "name" => $product->name,
                "slug" => $product->slug,
                "code" => $product->code,
                "image" => $product->image,
                "price" => $product->price,
                "price_sale" => $product->price_sale,
                "qty" => 1
            ];
        }
        Session::put('cart', $cart);
        return response()->json(['is' => 'success', 'message' => 'Sản phẩm đã được thêm vào giỏ hàng']);
    }
    //xóa sản phẩm
    public function remove($id)
    {
        if ($id) {
            $cart = Session::get('cart');//lấy giỏ hàng từ session
            if (isset($cart[$id])) {
                unset($cart[$id]);//xóa sp
                Session::put('cart', $cart);//lưu giỏ hàng
            }
            Session::flash('success', 'Sản phẩm đã được xóa');
        }
    }
    //xóa toàn bộ dữ liệu giỏ hàng trong session, đảm bảo rằng giỏ hàng trở về trạng thái trống.
    public function clearCart()
    {
        if (Session::has('cart')) {
            Session::forget('cart');
        }
    }
    //tăng số lượng của một sản phẩm trong giỏ hàng, kiểm tra xem số lượng đã vượt quá giới hạn cho phép hay chưa
    public function increment(Request $request)
    {
        $id = $request->id;
        if ($id) { //kt nếu id tồn  
            $cart = Session::get('cart'); //lấy giỏ 
            if ($cart[$id]) {
                if($cart[$id]['qty'] > 2){
                    return response()->json(['is' => 'failed', 'message' => 'Sản phẩm đã vượt quá số lượng cho phép']);
                }
                $cart[$id]['qty']++; //tăng số lượng 
                Session::put('cart', $cart);
            }
        }
    }
    //giảm số lượng của một sản phẩm trong giỏ hàng.   
    public function decrement(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $cart = Session::get('cart');//Lấy giỏ hàng từ session 
            if ($cart[$id]) {
                if ($cart[$id]['qty'] == 1) {
                    unset($cart[$id]);
                    Session::put('cart', $cart);
                } else {
                    $cart[$id]['qty'] -= 1;
                    Session::put('cart', $cart);
                }
            }
        }
    }

    public function getItemNumber()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            return $cart->totalProduct;
        }
        return 0;
    }
}

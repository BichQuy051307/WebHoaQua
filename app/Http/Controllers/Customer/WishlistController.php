<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    //hiển thị danh sách sản phẩm trong danh sách yêu thích của người dùng
    public function index()
    {
        $user_id = Auth::user()->id;//lấy id của người dùng hiện 
        if ($user_id) {
            $wishlists = DB::table('wishlists')
                ->select(
                    'wishlists.id',
                    'products.id as product_id',
                    'products.image',
                    'products.name',
                    'products.slug',
                    'products.code',
                    'products.price',
                    'products.price_sale',
                    'products.quantity'
                )
                ->join('products', 'wishlists.product_id', '=', 'products.id')//lấy thông tin về sản phẩm trong danh sách yêu thích.
                ->where('wishlists.user_id', '=', $user_id)//lọc các sản phẩm trong danh sách yêu thích của ng dùng hiện tại
                ->where('products.status', '=', 1)// có trạng thái đang hoạt động
                ->orderBy('wishlists.created_at', 'desc')//sắp xếp danh sách theo thứ tự ngày tạo, giảm 
                ->paginate(5);
            return view('wishlist', ['wishlists' => $wishlists]);
        }
    }
    //thêm sp yêu thích
    public function addWishlist(Request $request)
    {
        if (Auth::check()) {//kt người dùng đăng nhập hay chưa
            $data['user_id'] = Auth::user()->id;///lấy id
            $data['product_id'] = $request->id;
            $check = Wishlist::where('user_id', $data['user_id'])->where('product_id', $data['product_id'])->get()->first();//kt xem sp đã tồn tại trong ds yêu thích chưa, 
            if ($check) {
                return response()->json(['is' => 'exist']);//nếu đã tồn tại thì tyhoong báo đã tồn tại
            }
            $product = Product::find($data['product_id']);//Tìm kiếm sản phẩm trong bảng products
            if ($product) {
                $wishlist = Wishlist::create($data);
                if ($wishlist) {
                    return response()->json(['is' => 'success']);
                }
            }
            return response()->json(['is' => 'unsuccess']);
        }
        return response()->json(['is' => 'notlogged']);
    }
    //xóa 
    public function delete($id)
    {
        $user_id = Auth::user()->id;
        if ($user_id && $id) {
            Wishlist::where('id', $id)->where('user_id', $user_id)->delete();
        }
    }
}

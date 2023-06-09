<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();//truy vấn cơ sở dữ liệu để lấy thông tin về danh mục có slug tương ứng với tham số $slug
        if (empty($category)) {
            return view('product_list');
        };

        $sortby = $request->sortby;
        $min_price = ((int) $request->min_price) / 1000;///Chuyển đổi giá trị min_price và max_price sang đơn vị nghìn đồng (được chia cho 1000) để đảm bảo tính nhất quán với đơn vị của giá sản phẩm.
        $max_price = ((int) $request->max_price) / 1000;
        if ($min_price && $max_price) {//kt min và max cung cấp hay chưa
            if ($sortby == 'price-desc')//xác định cách sắp xếp danh sách sản phẩm theo giá bán giảm dần
                $products = Product::select('id', 'name', 'slug', 'image', 'price_sale', 'price', 'quantity')
                    ->where('category_id', $category->id)
                    ->where('status', 1)
                    ->where('price_sale', '>=', $min_price)
                    ->where('price_sale', '<=', $max_price)
                    ->orderBy('price_sale', 'desc');
            else if ($sortby == 'name')
                $products = Product::select('id', 'name', 'slug', 'image', 'price_sale', 'price', 'quantity')
                    ->where('category_id', $category->id)
                    ->where('status', 1)
                    ->where('price_sale', '>=', $min_price)
                    ->where('price_sale', '<=', $max_price)
                    ->orderBy('name');
            else if ($sortby == 'date')
                $products = Product::select('id', 'name', 'slug', 'image', 'price_sale', 'price', 'quantity')
                    ->where('category_id', $category->id)
                    ->where('status', 1)
                    ->where('price_sale', '>=', $min_price)
                    ->where('price_sale', '<=', $max_price)
                    ->orderBy('created_at', 'desc');
            else
                $products = Product::select('id', 'name', 'slug', 'image', 'price_sale', 'price', 'quantity')//tăng dần
                    ->where('category_id', $category->id)
                    ->where('status', 1)
                    ->where('price_sale', '>=', $min_price)
                    ->where('price_sale', '<=', $max_price)
                    ->orderBy('price_sale', 'asc');
        } else {
            if ($sortby == 'price-desc')
                $products = Product::select('id', 'name', 'slug', 'image', 'price_sale', 'price', 'quantity')->where('category_id', $category->id)->where('status', 1)->orderBy('price_sale', 'desc');
            else if ($sortby == 'name')
                $products = Product::select('id', 'name', 'slug', 'image', 'price_sale', 'price', 'quantity')->where('category_id', $category->id)->where('status', 1)->orderBy('name');
            else if ($sortby == 'date')
                $products = Product::select('id', 'name', 'slug', 'image', 'price_sale', 'price', 'quantity')->where('category_id', $category->id)->where('status', 1)->orderBy('created_at', 'desc');
            else
                $products = Product::select('id', 'name', 'slug', 'image', 'price_sale', 'price', 'quantity')->where('category_id', $category->id)->where('status', 1)->orderBy('price_sale', 'asc');
        }// xử lý các trường hợp không phải 'price-desc', 'name' hoặc 'date'. Trong trường hợp này, danh sách sản phẩm sẽ được sắp xếp theo giá bán tăng dần bởi câu lệnh orderBy('price_sale', 'asc').

        $products = $products->paginate(4);//phân trang trong danh mục sp
        return view('product_list', ['products' => $products]);
    }
}

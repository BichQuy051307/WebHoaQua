<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();//lấy tất cả các sảnphaamr từ bảng 
        $categories = Category::all();
        return view('admin.product.products-list', ['products' => $products, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(//Kiểm tra và xác thực dữ liệu nhập vào từ request bằng cách sử dụng Validator.
            $request->all(),
            [
                'name' => 'required|max:512|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
                'code' => 'required|max:512|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
                'unit' => 'required|max:512|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
                'description' => 'required',
                'category_id' => 'required',
                'quantity' => 'required|min:1',
                'price' => 'required',
                'price_sale' => 'required',
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên sản phẩm không được để trống',
                'name.max' => 'Tên sản phẩm không được nhiều hơn :max kí tự',
                'name.regex' => 'Tên sản phẩm không được chứa kí tự đặc biệt',
                'code.required' => 'Mã sản phẩm không được để trống',
                'code.max' => 'Mã sản phẩm không được nhiều hơn :max kí tự',
                'code.regex' => 'Mã sản phẩm không được chứa kí tự đặc biệt',
                'unit.required' => 'Đơn vị tính của sản phẩm không được để trống',
                'unit.max' => 'Đơn vị tính của sản phẩm không được nhiều hơn :max kí tự',
                'unit.regex' => 'Đơn vị tính của sản phẩm không được chứa kí tự đặc biệt',
                'description.required' => 'Mô tả sản phẩm không được để trống',
                'category_id.required' => 'Danh mục sản phẩm không được để trống',
                'quantity.required' => 'Số lượng sản phẩm không được để trống',
                'quantity.min' => 'Số lượng sản phẩm ít nhất là 1',
                'price.required' => 'Giá sản phẩm không được để trống',
                'price_sale.required' => 'Giá bán không được để trống',
                'status.required' => 'Trạng thái không được để trống',
            ]
        );
        //lỗi
        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data = $request->all();
        unset($data['_token']);

        if ($files = $request->file('image')) {
            $destinationPath = 'images/products/'; // upload path
            $time = time();
            $fileName = $time . "" . date('YmdHis') . "" . $files->hashName();
            $files->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        } else {
            unset($data['image']);//cập nhật tên file vào $data['image']
        }
        $data['slug'] = Str::slug($data['name']);//Xử lý slug của sản phẩm từ tên sản phẩm và gán vào $data['slug']
        $product = Product::create($data);//tạo mới một đối tượng Product với dữ liệu từ $data.

        if (isset($product)) {
            return response()->json(['is' => 'success', 'complete' => 'Sản phẩm được thêm thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Sản phẩm chưa được thêm']);
    }

    public function show($id)//hiển thị thông tin và chỉnh sửa sản phẩm có id tương ứng 
    {
        $product = Product::find($id);//tìm sản phẩm với id được truyền vào
        $categories = Category::all();
        return view('admin.product.edit-product', ['product' => $product, 'categories' => $categories]);//lấy danh sách tất cả các danh mục từ bảng categories và truyền cả hai biến $product và $categories vào view.
    }
    //cập nhật thông tin của sản phẩm.
    public function edit(Request $request)
    {
        $validator = Validator::make(//kiểm tra và validate dữ liệu gửi lên từ request  
            $request->all(),
            [
                'name' => 'required|max:512|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
                'code' => 'required|max:512|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
                'unit' => 'required|max:512|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
                'description' => 'required',
                'category_id' => 'required',
                'quantity' => 'required|min:1',
                'price' => 'required',
                'price_sale' => 'required',
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên sản phẩm không được để trống',
                'name.max' => 'Tên sản phẩm không được nhiều hơn :max kí tự',
                'name.regex' => 'Tên sản phẩm không được chứa kí tự đặc biệt',
                'code.required' => 'Mã sản phẩm không được để trống',
                'code.max' => 'Mã sản phẩm không được nhiều hơn :max kí tự',
                'code.regex' => 'Mã sản phẩm không được chứa kí tự đặc biệt',
                'unit.required' => 'Đơn vị tính của sản phẩm không được để trống',
                'unit.max' => 'Đơn vị tính của sản phẩm không được nhiều hơn :max kí tự',
                'unit.regex' => 'Đơn vị tính của sản phẩm không được chứa kí tự đặc biệt',
                'description.required' => 'Mô tả sản phẩm không được để trống',
                'category_id.required' => 'Danh mục sản phẩm không được để trống',
                'quantity.required' => 'Số lượng sản phẩm không được để trống',
                'quantity.min' => 'Số lượng sản phẩm ít nhất là 1',
                'price.required' => 'Giá sản phẩm không được để trống',
                'price_sale.required' => 'Giá bán không được để trống',
                'status.required' => 'Trạng thái không được để trống',
            ]
        );
        //Nếu validation thất bại, ta trả về một JSON response chứa thông báo lỗi.
        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }

        $data = $request->all();
        $product = Product::find($data['id']);//tìm sản phẩm cần cập nhật
        if ($files = $request->file('image')) {
            $destinationPath = 'images/products/'; // upload path
            $time = time();
            $fileName = $time . "" . date('YmdHis') . "" . $files->hashName();
            $files->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        } else {
            $data['image'] = $product->image;
        }
        unset($data['_token']);//xóa các phần tử không cần thiết trong mảng $data
        unset($data['id']);
        $flag = $product->update($data);
        if ($flag) {
            return response()->json(['is' => 'success', 'complete' => 'Sản phẩm đã được cập nhật']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Sản phẩm chưa được cập nhật']);
    }

    public function update(Request $request)
    {
        
    }

    public function destroy($id)
    {
        return Product::findOrFail($id)->delete();
    }
}

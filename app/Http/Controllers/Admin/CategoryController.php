<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //lấy danh sách các danh mục từ cơ sở dữ liệu và hiển thị chúng trong một view
    public function index()
    {
        $categories = Category::all();//tất cả các danh mục  từ cơ sở dữ liệu bằng cách sử dụng phương thức all() trên model Category.
        return view('admin.category.categories-list', ['categories' => $categories]);
    }

    // xử lý yêu cầu tạo mới danh mục
    public function store(Request $request)
    {
        $validator = Validator::make( //tạo một đối tượng Validator để kiểm tra dữ liệu đầu vào từ yêu cầu
            $request->all(),
            [
                'name' => 'required|max:255|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
            ],
            [
                'name.required' => 'Loại tài khoản không được để trống',
                'name.max' => 'Loại tài khoản không được nhiều hơn :max kí tự',
                'name.regex' => 'Loại tài khoản không được chứa kí tự đặc biệt',
            ]
        );
        //dữ liệu không hợp lệ, phương thức trả về một JSON response với thông tin lỗi từ Validator.
        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        //lấy tất cả dữ liệu từ yêu cầu và gán cho mảng $data. Dòng $data['_token'] được loại bỏ khỏi mảng.
        $data = $request->all();
        unset($data['_token']);
        $data['slug'] = Str::slug($data['name']);//Slug là một phiên bản chuỗi dạng URL thân thiện, thường được tạo từ trường 'name' để đại diện cho danh mục.
        $category = Category::create($data);//Danh mục mới được tạo bằng cách sử dụng phương thức create() trên model Category, với $data là thông tin của danh mục. Kết quả được gán cho biến $category.
        if (isset($category)) {
            return response()->json(['is' => 'success', 'complete' => 'Danh mục được thêm thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Danh mục chưa được thêm']);
    }

    public function show($id)
    {
        $category = Category::find($id);//nhận một tham số $id làm đối số để tìm một danh mục cụ thể trong cơ sở dữ liệu 
        return view('admin.category.edit-category', ['category' => $category]);//hiển thị form để chỉnh sửa thông tin của danh mục, ruy cập thông tin của danh mục trong view.
    }
    //hiển thị form chỉnh sửa thông tin danh mục và xử lý yêu cầu cập nhật thông tin danh mục.
    public function edit(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
            ],
            [
                'name.required' => 'Loại tài khoản không được để trống',
                'name.max' => 'Loại tài khoản không được nhiều hơn :max kí tự',
                'name.regex' => 'Loại tài khoản không được chứa kí tự đặc biệt',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data = $request->all();
        $category = Category::find($data['id']);
        unset($data['_token']);
        unset($data['id']);
        $data['slug'] = Str::slug($data['name']);
        $flag = $category->update($data);//để cập nhật thông tin của danh mục với dữ liệu mới trong mảng $data
        if ($flag) {
            return response()->json(['is' => 'success', 'complete' => 'Danh mục đã được cập nhật']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Danh mục chưa được cập nhật']);
    }

    public function destroy($id)
    {
        return Category::findOrFail($id)->delete();
    }
}
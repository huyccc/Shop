<?php

namespace App\Http\Controllers;

use App\Category;
use App\Brand;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

session_start();
class CategoryProduct extends Controller
{
    //BACK-END
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/admin/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }
    public function add_category_Product()
    {
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_Product()
    {
        $this->AuthLogin();
        //khai báo biến $all_category_product và dùng pt get để lấy toàn bộ thông tin trong db
        //lưu thông tin từ hàm get vào biến
        $all_category_product = Category::orderBy('category_id','desc')->get();
        //trả về view trang với các thông tin của biến đã lưu
        return view('admin.all_category_product')->with('all_category_product',$all_category_product);
    }
    public function save_category_Product(Request $request)
    {
        $this->AuthLogin();
        // $data = array();
        // //thực hiện lấy cơ sở dữ liệu
        // //lấy ở $data là cột trong database, còn ở $request là ở name trong form
        // $data['category_name'] = $request->category_product_name;
        // $data['category_desc'] = $request->category_product_desc;
        // $data['category_status'] = $request->category_product_status;
        // //hàm insert để thêm vào database
        $data = $request->all();

        $category = new Category();
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->category_status = $data['category_product_status'];

        $category->save();

        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('/add-category-product');
    }
    public function activate_category_Product($category_product_id){
        $this->AuthLogin();
        //lấy ra từ db
        //kiểm tra xem id của product có bằng với id của biến khai báo, sau đó update vào db
        Category::where('category_id',$category_product_id)->update(['category_status' =>1]);
        Session::put('message','Đã đổi trạng thái từ ẩn sang hiện');
        return Redirect::to('/all-category-product');
    }
    public function deactivate_category_Product($category_product_id){
        $this->AuthLogin();
        Category::where('category_id',$category_product_id)->update(['category_status' =>0]);
        Session::put('message','Đã đổi trạng thái từ hiện sang ẩn');
        return Redirect::to('/all-category-product');
    }
    public function edit_category_Product($category_product_id)
    {
        $this->AuthLogin();
        $edit_category_product = Category::where('category_id',$category_product_id)->get();
        //trả về view trang với các thông tin của biến đã lưu
        return view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
    }
    public function update_category_Product(Request $request, $category_product_id)
    {
        $this->AuthLogin();
        //hàm update để update dữ liệu vào database sau khi sửa
        $data = $request->all();

        $category = Category::find($category_product_id);
        $category['category_name'] = $data['category_product_name'];
        $category['category_desc'] = $data['category_product_desc'];
        $category->save();
        Category::where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật thành công');
        return Redirect::to('/all-category-product');
    }
    public function delete_category_Product($category_product_id)
    {
        $this->AuthLogin();
        Category::where('category_id',$category_product_id)->delete();
        Session::put('message','Xoá danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    //END BACK-END
    //FRONT-END
    public function show_category_home($category_product_id)
    {
        $category_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        //hiển thị website dựa trên id
        $category_by_id = Product::join('category_product','category_product.category_id','=','product.category_id')
        ->where('product.category_id',$category_product_id)->get();
        $category_name = Category::where('category_product.category_id',$category_product_id)->limit(1)->get();

        return view('pages.category.show_category')->with('brand',$brand_product)->with('category',$category_product)
        ->with('category_by_id',$category_by_id)->with('category_name', $category_name);
    }
}

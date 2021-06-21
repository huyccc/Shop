<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class BrandProduct extends Controller
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
    public function add_brand_Product()
    {
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_Product()
    {
        $this->AuthLogin();
        //khai báo biến $all_brand_product và dùng pt get để lấy toàn bộ thông tin trong db
        //lưu thông tin từ hàm get vào biến
        //$all_brand_product = DB::table('brand_product')->get();
        $all_brand_product = Brand::orderBy('brand_id','desc')->get();
        
        //trả về view trang với các thông tin của biến đã lưu
        return view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
    }
    public function save_brand_Product(Request $request)
    {
        $this->AuthLogin();
        // $data = array();
        // //thực hiện lấy cơ sở dữ liệu
        // //lấy ở $data là cột trong database, còn ở $request là ở name trong form
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;
        // $data['brand_status'] = $request->brand_product_status;
        // //hàm insert để thêm vào database
        // DB::table('brand_product')->insert($data);
        $data = $request->all();

        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];

        $brand->save();

        Session::put('message','Thêm danh mục thương hiệu thành công');
        return Redirect::to('/add-brand-product');
    }
    public function activate_brand_Product($brand_product_id){
        $this->AuthLogin();
        //lấy ra từ db
        //kiểm tra xem id của product có bằng với id của biến khai báo, sau đó update vào db
        Brand::where('brand_id',$brand_product_id)->update(['brand_status' =>1]);
        Session::put('message','Đã đổi trạng thái từ ẩn sang hiện');
        return Redirect::to('/all-brand-product');
    }
    public function deactivate_brand_Product($brand_product_id){
        $this->AuthLogin();
        Brand::where('brand_id',$brand_product_id)->update(['brand_status' =>0]);
        Session::put('message','Đã đổi trạng thái từ hiện sang ẩn');
        return Redirect::to('/all-brand-product');
    }
    public function edit_brand_Product($brand_product_id)
    {
        $this->AuthLogin();
        $edit_brand_product = Brand::where('brand_id',$brand_product_id)->get();
        //trả về view trang với các thông tin của biến đã lưu
        return view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
    }
    public function update_brand_Product(Request $request, $brand_product_id)
    {
        $this->AuthLogin();
        //hàm update để update dữ liệu vào database sau khi sửa
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;
        // DB::table('brand_product')->where('brand_id',$brand_product_id)->update($data);
        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        //không cần thêm $brand = new Brand() vì nếu thêm khi sửa sẽ tạo ra sp mới
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];

        
        $brand->save(); 
        Session::put('message','Cập nhật thành công');
        return Redirect::to('/all-brand-product');
    }
    public function delete_brand_Product($brand_product_id)
    {
        $this->AuthLogin();
        Brand::where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xoá danh mục thương hiệu thành công');
        return Redirect::to('/all-brand-product');
    }
    //END BACK-END
    //FRONT-END
    public function show_brand_home($brand_product_id)
    {
        $category_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        //hiển thị website dựa trên id
        $brand_by_id = Product::join('brand_product','brand_product.brand_id','=','product.brand_id')
        ->where('product.brand_id',$brand_product_id)->get();
        $brand_name = Brand::where('brand_product.brand_id',$brand_product_id)->limit(1)->get();
        return view('pages.brand.show_brand')->with('brand',$brand_product)->with('category',$category_product)
        ->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }
}

<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

session_start();
class ProductController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/admin/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }
    public function add_Product()
    {
        //do ta cần lấy thông tin product, bao gồm cả id của 2 bảng category và bảng brand
        //do đó mỗi khi ta cần gọi sản phẩm, gọi biến chứa thông tin của id hai bảng đó
        $this->AuthLogin();
        $category_product = Category::orderby('category_id','desc')->get();
        $brand_product = Brand::orderby('brand_id','desc')->get();
        return view('admin.add_product')
            ->with('category_product',$category_product)
            ->with('brand_product',$brand_product);
    }
    public function all_Product()
    {
        $this->AuthLogin();
        //khai báo biến $all_product và dùng pt get để lấy toàn bộ thông tin trong db
        //lưu thông tin từ hàm get vào biến
        $all_product = Product::join('category_product','category_product.category_id','=','product.category_id')
        ->join('brand_product','brand_product.brand_id','=','product.brand_id')
        ->orderby('product_id','desc')->get();
        //trả về view trang với các thông tin của biến đã lưu
        //'all_product' ở đây chính là all_product của hàm foreach
        return view('admin.all_product')->with('all_product',$all_product);
    }
    public function save_Product(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        //thực hiện lấy cơ sở dữ liệu
        //lấy ở $data là cột trong database, còn ở $request là ở name trong form
        $product = new Product();
        $product->product_name = $data['product_name'];
        $product->product_price = $data['product_price'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->category_id = $data['category_product'] ;
        $product->brand_id = $data['brand_product'];
        $product->product_status = $data['product_status'];
     
        $get_image = $request->file('product_image');
        //kiểm tra file up vào có phải ảnh ko
        if($get_image){
            //lấy tên của ảnh up
            $get_name_img = $get_image->getClientOriginalName();
            //
            $name_image =current(explode('.',$get_name_img)); 
            //hàm getclient.. dùng để lấy đuôi mở rộng ở file ảnh
            //gán số vào file ảnh tránh trùng lặp
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            //chuyển file ảnh vào thư mục uploads
            $get_image->move('public/uploads/product',$new_image);
            $product->product_image = $new_image; 
            $product->save();
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('/add-product');
        }
        $product->product_image = ""; 
        //hàm insert để thêm vào database
        $product->save();
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('/add-product');
    }
    public function activate_Product($product_id){
        $this->AuthLogin();
        //lấy ra từ db
        //kiểm tra xem id của product có bằng với id của biến khai báo, sau đó update vào db
        Product::where('product_id',$product_id)->update(['product_status' =>1]);
        Session::put('message','Đã đổi trạng thái từ ẩn sang hiện');
        return Redirect::to('/all-product');
    }
    public function deactivate_Product($product_id){
        $this->AuthLogin();
        Product::where('product_id',$product_id)->update(['product_status' =>0]);
        Session::put('message','Đã đổi trạng thái từ hiện sang ẩn');
        return Redirect::to('/all-product');
    }
    public function edit_Product($product_id)
    {
        $this->AuthLogin();
        $category_product = Category::orderby('category_id','desc')->get();
        $brand_product = Brand::orderby('brand_id','desc')->get();
        $edit_product = Product::where('product_id',$product_id)->get();
        //trả về view trang với các thông tin của biến đã lưu
        //tên trong ngoặc là tên gọi hàm foreach
        return view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('category_product',$category_product)
        ->with('brand_product',$brand_product);
    }
    public function update_Product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = $request->all();
        //thực hiện lấy cơ sở dữ liệu
        //lấy ở $data là cột trong database, còn ở $request là ở name trong form
        $product = Product::find($product_id);
        $product->product_name = $data['product_name'];
        $product->product_price = $data['product_price'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->category_id = $data['category_product'] ;
        $product->brand_id = $data['brand_product'];
        $product->product_status = $data['product_status'];
     
        $get_image = $request->file('product_image');
        //kiểm tra file up vào có phải ảnh ko
        if($get_image){
            //lấy tên của ảnh up
            $get_name_img = $get_image->getClientOriginalName();
            //
            $name_image =current(explode('.',$get_name_img)); 
            //hàm getclient.. dùng để lấy đuôi mở rộng ở file ảnh
            //gán số vào file ảnh tránh trùng lặp
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            //chuyển file ảnh vào thư mục uploads
            $get_image->move('public/uploads/product',$new_image);
            $product->product_image = $new_image; 
            $product->save();
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('/all-product');
        }
        //hàm insert để thêm vào database
        $product->save();
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function delete_Product($product_id)
    {
        $this->AuthLogin();
        Product::find($product_id)->delete();
        Session::put('message','Xoá sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    //End Admin Page

    public function details_product($product_id)
    {
        $category_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        $details_product = Product::join('category_product','category_product.category_id','=','product.category_id')
        ->join('brand_product','brand_product.brand_id','=','product.brand_id')
        ->where('product.product_id',$product_id)->get();

        
        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
        }
        //lấy ra tất cả sản phẩm có category_id =  category_id của sản phẩm đang xem
        $related_product = Product::join('category_product','category_product.category_id','=','product.category_id')
        ->join('brand_product','brand_product.brand_id','=','product.brand_id')
        ->where('category_product.category_id',$category_id)->get();

        return view('pages.product.show_details')->with('brand',$brand_product)->with('category',$category_product)
        ->with('product_id',$product_id)->with('details_product',$details_product)->with('related_product',$related_product);
    }
}

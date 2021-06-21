<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\Brand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome()
    {
        //do ta cần lấy thông tin product, bao gồm cả id của 2 bảng category và bảng brand
        //do đó mỗi khi ta cần gọi sản phẩm, gọi biến chứa thông tin của id hai bảng đó
        $category_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_product = Product::where('product_status','1')->orderby('product_id','desc')->limit(4)->get();
        return view('pages.home')->with('brand',$brand_product)->with('category',$category_product)->with('all_product',$all_product);
    }
    public function search(Request $request)
    {
        $keyword = $request->keyword_submit;
        $category_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        $search_product = Product::where('product_name','like','%'.$keyword.'%')->get();
        return view('pages.product.search')->with('brand',$brand_product)->with('category',$category_product)->with('search_product',$search_product);
    }
}

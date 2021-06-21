<?php


namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\Brand;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

session_start();
class CartController extends Controller
{    
    public function show_cart()
    {
        $category_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.show_cart')->with('brand',$brand_product)->with('category',$category_product);
    }
    public function save_cart(Request $request)
    {

        $product_id = $request->product_id_hidden;
        $quantity = $request->qty;

        $product_info = Product::where('product_id',$product_id)->first();

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = 0;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);  
        return Redirect::to('/show-cart');
    }
    public function delete_cart($rowId)
    {
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_qty(Request $request)
    {
        $rowId = $request->rowId_cart;
        $quantity= $request->cart_quantity;
        Cart::update($rowId,$quantity);
        return Redirect::to('/show-cart');
    }

}

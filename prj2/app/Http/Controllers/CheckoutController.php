<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\Brand;
use App\Customer;
use App\Order;
use App\Order_details;
use App\Payment;
use App\Shipping;
use DB;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class CheckoutController extends Controller
{
    public function login_checkout()
    {
        $category_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('brand',$brand_product)->with('category',$category_product);
    }
    public function add_customer(Request $request)
    {
        $data = $request->all();
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->customer_phone = $data['customer_phone'];
        $customer->save();

        $new_id = $customer->customer_id;

        Session::put('customer_id',$new_id);
        Session::put('customer_name',$customer->customer_name);
        return Redirect::to('/checkout');
    }
    public function login_customer(Request $request){
        //yêu cầu email và password
        $data = $request->all();
        $customer = Customer::all();
        $customer->customer_email = $data['email_account'];
        $customer->customer_password = md5($data['password_account']);
      
        $result = Customer::where('customer_email', $customer->customer_email)->where('customer_password',$customer->customer_password)
        ->first();
        //validate dữ liệu admin
        if($result){
            //lấy kết quả từ db và put vào session(đặt cho admin name và id theo database)
            Session::put('customer_id',$result->customer_id);
            //nếu put được hết thì sẽ điều hướng về trang dashboard
            return Redirect::to('/home');
        } else {
            //nếu nhập sai thì điều hướng về trang login
            //put 1 tin nhắn vào session (đặt)
            Session::put('message','Email hoặc mật khẩu bị sai. Vui lòng nhập lại');
            return Redirect::to('/login-checkout');
        }
    }
    public function logout_customer(){
        //logout thì lúc này đặt cho session admin name và id rỗng
        Session::put('customer_id',null);
        return Redirect::to('/login-checkout');
        
    }
    public function checkout()
    {
        $category_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.show_checkout')->with('brand',$brand_product)->with('category',$category_product);
    }
    public function save_checkout_customer(Request $request)
    {
        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->save();

        $new_id = $shipping->shipping_id;

        Session::put('shipping_id',$new_id);

        return Redirect::to('/payment');
    }
    public function payment()
    {
        $category_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.payment')->with('brand',$brand_product)->with('category',$category_product);
    }
    public function order_place(Request $request)
    {
        //insert payment data
        $payment_data = $request->all();
        $payment = new Payment();
        $payment->payment_method = $payment_data['payment_method'];
        $payment->payment_status = 'Đang chờ xử lý';
        $payment->save();

        $new_payment_id = $payment->payment_id;

        //insert order data
        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = Session::get('shipping_id');
        $order->payment_id = $new_payment_id;
        $order->order_total = Cart::total();
        $order->order_status = 'Đang chờ xử lý';
        $order->save();

        $new_order_id = $order->order_id;

        //insert order details
        $content = Cart::content();
        foreach ($content as $key => $value) {
            $order_d_data['order_id'] = $new_order_id;
            $order_d_data['product_id'] = $value->id;
            $order_d_data['product_name'] = $value->name;
            $order_d_data['product_price'] = $value->price;
            $order_d_data['product_sales_quantity'] = $value->qty;
            DB::table('order_details')->insert($order_d_data);
        }
        if($payment->payment_method ==1){
            echo 'Thanh toán thẻ ATM';

        } elseif($payment->payment_method == 2) {
            Cart::destroy();
            $category_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
            $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
            return view('pages.checkout.handcash')->with('category',$category_product)->with('brand',$brand_product);
        } else {
            echo 'Thẻ ghi nợ';
        }
    }
    public function manage_order()
    {
        return view('admin.manage_order');
    }
}

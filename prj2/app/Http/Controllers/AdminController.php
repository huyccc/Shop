<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
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
    public function showAdmin()
    {
        return view('admin_login');
    }
    public function showDashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function AdminDashboard(Request $request){
        //yêu cầu email và password
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        //kiểm tra trong db
        //first vì để lấy duy nhất 1 admin
        $result = DB::table('admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        //validate dữ liệu admin
        if($result){
            //lấy kết quả từ db và put vào session(đặt cho admin name và id theo database)
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            //nếu put được hết thì sẽ điều hướng về trang dashboard
            return Redirect::to('/admin/dashboard');
        } else {
            //nếu nhập sai thì điều hướng về trang login
            //put 1 tin nhắn vào session (đặt)
            Session::put('message','Email hoặc mật khẩu bị sai. Vui lòng nhập lại');
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        //logout thì lúc này đặt cho session admin name và id rỗng
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}

@extends('welcome') 
<!--khu vực riêng mang tên content, được nối với tập cha với phương thức yield-->
@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập vào tài khoản của bạn</h2>
                    <?php
                    //khai báo message trong session
                    //dùng get để lấy 
                    $message = Session::get('message');
                    if($message){
                        //kiểm tra xem có xuất hiện message ko, nếu có thì in ra
                        echo '<span class="text-alert">'.$message.'</span>';
                        //đặt lại giá trị message về null, nếu ko sẽ lỗi
                        Session::put('message',null);
                    }
                    ?>
                    <form action="{{ URL::to('/login-customer') }}" method="POST">
                        @csrf
                        <input type="email" name="email_account" placeholder="Địa chỉ Email" />
                        <input type="password" name="password_account" placeholder="Mật khẩu"/>
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Nhớ đăng nhập
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">HOẶC</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng kí mới!</h2>
                    <form action="{{ URL::to('/add-customer') }}" method="POST">
                        @csrf
                        <input type="text" name="customer_name" placeholder="Họ tên"/>
                        <input type="email" name="customer_email" placeholder="Địa chỉ email"/>
                        <input type="password" name="customer_password"placeholder="Mật khẩu"/>
                        <input type="text"name="customer_phone" placeholder="Số điện thoại">
                        <button type="submit" class="btn btn-default">Đăng kí</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection
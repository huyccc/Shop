<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ asset('images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('public/frontend/images/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('public/frontend/images/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('public/frontend/images/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('public/frontend/images/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{ URL::to('/home') }}"><img src="{{ asset('public/frontend/images/logo.png') }}" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{ URl::to('/login-checkout') }}"><i class="fa fa-user"></i> Tài khoản</a></li>
								<?php
								$customer_id = Session::get('customer_id');
								$shipping_id = Session::get('shipping_id');
								 if($shipping_id == null && $customer_id != null){
								?>
								<li><a href="{{ URL::to('/checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
								} elseif ($shipping_id !=null && $customer_id != null) {
								?>
								<li><a href="{{ URl::to('/payment') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
								} else {
								?>
								<li><a href="{{ URl::to('/login-checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
								} 
								?>
								<li><a href="{{ URL::to('/show-cart') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								<?php
								$customer_id = Session::get('customer_id');
								 if($customer_id != null){
								?>
								<li><a href="{{ URl::to('/logout-checkout') }}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
								<?php
								} else {
								?>
								<li><a href="{{ URl::to('/login-checkout') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ URL::to('/home') }}" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Tiện ích<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
										<li><a href="{{ URL::to('/checkout') }}">Checkout</a></li> 
										<li><a href="{{ URL::to('/show-cart') }}">Cart</a></li> 
										<li><a href="{{ URl::to('/login-checkout') }}">Login</a></li> 
                                    </ul>
                                </li> 
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{ URL::to('/tim-kiem') }}" method="POST">
								@csrf
							<div class="search_box pull-right">
								<input type="text" name="keyword_submit" placeholder="Tìm kiếm sản phẩm"/>
								<input type="submit" style="color: black; margin-top: 0" class="btn btn-primary btn-sm" name="search_items" value="Tìm kiếm">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ asset('public/frontend/images/girl1.jpg') }}" class="girl img-responsive" alt="" />
									<img src="{{ asset('public/frontend/images/pricing.png') }}"  class="pricing" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ asset('public/frontend/images/girl2.jpg') }}" class="girl img-responsive" alt="" />
									<img src="{{ asset('public/frontend/images/pricing.png') }}"  class="pricing" alt="" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ asset('public/frontend/images/girl3.jpg') }}" class="girl img-responsive" alt="" />
									<img src="{{ asset('public/frontend/images/pricing.png') }}" class="pricing" alt="" />
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
				
				<div class="col-sm-9 padding-right">
					<!--nối từ section tên content-->
					<section id="cart_items">
						<div class="container">
							<div class="breadcrumbs">	
								<ol class="breadcrumb">
								  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
								  <li class="active">Giỏ hàng của bạn</li>
								</ol>
							</div>
							<div class="table-responsive cart_info">
								<?php
								$content = Cart::content();
								
								?>
								<table class="table table-condensed">
									<thead>
										<tr class="cart_menu">
											<td class="image">Hình ảnh</td>
											<td class="description">Tên sản phẩm</td>
											<td class="price">Giá</td>
											<td class="quantity">Số lượng</td>
											<td class="total">Tổng tiền</td>
											<td></td>
										</tr>
									</thead>
									<tbody>
										@foreach($content as $v_content)
										<tr>
											<td class="cart_product">
												<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="80" height="90" alt="" /></a>
											</td>
											<td class="cart_description">
												<h4><a href="">{{$v_content->name}}</a></h4>
												<p>ID sản phẩm: {{ $v_content->id }}</p>
											</td>
											<td class="cart_price">
												<p>{{number_format($v_content->price).' '.'vnđ'}}</p>
											</td>
											<td class="cart_quantity">
												<div class="cart_quantity_button">
													<form action="{{URL::to('/update-cart-qty')}}" method="POST">
													@csrf
													<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}" >
													<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
													<input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
													</form>
												</div>
											</td>
											<td class="cart_total">
												<p class="cart_total_price">
													
													<?php
													$subtotal = $v_content->price * $v_content->qty;
													echo number_format($subtotal).' '.'vnđ';
													?>
												</p>
											</td>
											<td class="cart_delete">
												<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</section> <!--/#cart_items-->
				
					<section id="do_action">
						<div class="container">
						
							<div class="row">
							
								<div class="col-sm-6">
									<div class="total_area">
										
										<ul>
											<b>Vui lòng kiểm tra lại thông tin sản phẩm trước khi thanh toán</b>
											<li>Tổng <span>{{Cart::subtotal().' '.'vnđ'}}</span></li>
											<li>Thuế <span>{{Cart::tax().' '.'vnđ'}}</span></li>
											<li>Phí vận chuyển <span>Free</span></li>
											<li>Thành tiền <span>{{Cart::total().' '.'vnđ'}}</span></li> 
											<?php
											$customer_id = Session::get('customer_id');
											 if($customer_id != null){
											?>
											<a href="{{ URL::to('/checkout') }}"><button class="btn btn-primary">Thanh toán</button></a>
											<?php
											} else {
											?>
											<a href="{{ URl::to('/login-checkout') }}"><button class="btn btn-primary">Thanh toán</button></a>
											<?php
											}
											?>
										</ul>
											
									</div>
								</div>
							</div>
						</div>
					</section><!--/#do_action-->
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Dịch vụ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Liên hệ ngay</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Phone</a></li>
								<li><a href="#">Laptop</a></li>
								<li><a href="#">PC</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Tablet</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Chính sách</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Điều khoản sử dụng</a></li>
								<li><a href="#">Chính sách cá nhân</a></li>
								<li><a href="#">Chính sách hoàn tiền</a></li>
								<li><a href="#">Hệ thống thanh toán</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<img src="{{ asset('public/frontend/images/logo.png') }}" alt="" width="400" style="margin-top:50px;"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2021 E-SHOPPER Inc. All rights reserved.</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->

  
    <script src="{{ asset('public/frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
</body>
</html>
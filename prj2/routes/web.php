<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//front-end


Route::get('/','HomeController@showHome');
Route::get('/home','HomeController@showHome');
Route::post('/tim-kiem','HomeController@search');
//danh mục sản phẩm
Route::get('/danh-muc-san-pham/{category_product_id}','CategoryProduct@show_category_home');
//thương hiệu
Route::get('/thuong-hieu-san-pham/{brand_product_id}','BrandProduct@show_brand_home');
//chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{product_id}','ProductController@details_product');
//thêm vào giỏ hàng
Route::get('/show-cart','CartController@show_cart');
Route::post('/save-cart','CartController@save_cart');
//xoá sản phẩm khỏi giỏ hàng
Route::get('/delete-cart/{rowId}','CartController@delete_cart');
//cập nhật số lượng sản phẩm
Route::post('/update-cart-qty','CartController@update_cart_qty');
//login checkout
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-checkout-customer', 'CheckoutController@save_checkout_customer');
//thêm người dùng
Route::post('/add-customer','CheckoutController@add_customer');
//đăng nhập-đăng xuất
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/logout-checkout','CheckoutController@logout_customer');
//thanh toán
Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');


//back-end
//quản lý admin
Route::get('/admin','AdminController@showAdmin');
Route::get('/admin/dashboard','AdminController@showDashboard');
Route::post('/admin-dashboard','AdminController@AdminDashboard');
Route::get('/logout','AdminController@logout');



//quản lý danh mục sản phẩm (Category Product)
//thêm
Route::get('/add-category-product','CategoryProduct@add_category_Product');
Route::post('/save-category-product','CategoryProduct@save_category_Product');
//liệt kê
Route::get('/all-category-product','CategoryProduct@all_category_Product');
//sửa
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_Product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_Product');
//xoá
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_Product');
//trạng thái hiển thị
Route::get('/deactivated-category-product/{category_product_id}','CategoryProduct@activate_category_Product');
Route::get('/activated-category-product/{category_product_id}','CategoryProduct@deactivate_category_Product');



//quản lý thương hiệu (Brand)
//thêm
Route::get('/add-brand-product','BrandProduct@add_brand_Product');
Route::post('/save-brand-product','BrandProduct@save_brand_Product');
//liệt kê
Route::get('/all-brand-product','BrandProduct@all_brand_Product');
//sửa
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_Product');
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_Product');
//xoá
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_Product');
//trạng thái hiển thị
Route::get('/deactivated-brand-product/{brand_product_id}','BrandProduct@activate_brand_Product');
Route::get('/activated-brand-product/{brand_product_id}','BrandProduct@deactivate_brand_Product');


//quản lý sản phẩm (Product)
//thêm
Route::get('/add-product','ProductController@add_Product');
Route::post('/save-product','ProductController@save_Product');
//liệt kê
Route::get('/all-product','ProductController@all_Product');
//sửa
Route::get('/edit-product/{product_id}','ProductController@edit_Product');
Route::post('/update-product/{product_id}','ProductController@update_Product');
//xoá
Route::get('/delete-product/{product_id}','ProductController@delete_Product');
//trạng thái hiển thị
Route::get('/deactivated-product/{product_id}','ProductController@activate_Product');
Route::get('/activated-product/{product_id}','ProductController@deactivate_Product');

//Quản lý đơn hàng
Route::get('/manage-order','CheckoutController@manage_order');

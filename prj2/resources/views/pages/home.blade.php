<!--tập con của welcome-->
@extends('welcome') 
<!--khu vực riêng mang tên content, được nối với tập cha với phương thức yield-->
@section('content')
    				
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    @foreach ($all_product as $key =>$product)
    <a href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" height="220px" />
                        <h2>{{ number_format($product->product_price).' '.'VNĐ' }}</h2>
                        <p>{{ ($product->product_name) }}</p>
                        <button type="submit" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                    </div>
            </div>
        </div>
    </div>
    @endforeach
</div><!--features_items-->


@endsection
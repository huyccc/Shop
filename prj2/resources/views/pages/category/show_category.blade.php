<!--tập con của welcome-->
@extends('welcome') 
<!--khu vực riêng mang tên content, được nối với tập cha với phương thức yield-->
@section('content')
    				
<div class="features_items"><!--features_items-->
    @foreach ($category_name as $key => $name)
    <h2 class="title text-center">{{ $name->category_name }}</h2>
    @endforeach

    @foreach ($category_by_id as $key =>$product)
    <a href="{{ URL::to('chi-tiet-san-pham/'.$product->product_id) }}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" height="220px" />
                        <h2>{{ number_format($product->product_price).' '.'VNĐ' }}</h2>
                        <p>{{ ($product->product_name) }}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                    </div>
                    {{-- <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{ number_format($product->product_price).' '.'VNĐ' }}</h2>
                            <p>{{ ($product->product_name) }}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                        </div>
                    </div> --}}
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>
    </a>
    @endforeach
</div><!--features_items-->


@endsection
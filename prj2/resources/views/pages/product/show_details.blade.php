<!--tập con của welcome-->
@extends('welcome') 
<!--khu vực riêng mang tên content, được nối với tập cha với phương thức yield-->
@section('content')
@foreach ($details_product as $key => $value)
    		
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{ asset('public/uploads/product/'.$value->product_image) }}" alt="" />
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="{{ asset('public/frontend/images/new.jpg') }}" class="newarrival" alt="" />
            <h2>{{ $value->product_name }}</h2>
            <p>ID sản phẩm: {{ $value->product_id }}</p>
            <img src="{{ asset('public/frontend/images/rating.png') }}" alt="" />
        <form action="{{ URL::to('/save-cart') }}" method="post">
            @csrf
            <span>
                <span>{{ number_format($value->product_price).' VNĐ' }}</span>
                <label>Số lượng:</label>
                <input name="qty" type="number" min="0" value="1" />
                <input name="product_id_hidden" type="hidden" value="{{ $value->product_id }}" />
                <button type="submit" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Thêm vào giỏ
                </button>
            </span>
        </form>
            <p><b>Tình trạng:</b> Còn hàng</p>
            <p><b>Điều kiện:</b> Mới</p>
            <p><b>Thương hiệu:</b> <strong>{{ $value->brand_name }}</strong> </p>
            <p><b>Danh mục:</b> <strong>{{ $value->category_name }}</strong> </p>
            <a href=""><img src="{{ asset('public/frontend/images/share.png') }}" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--product details-->
<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" >
           <p>{!! $value->product_desc !!}</p>
        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
            <p>{!! $value->product_content !!}</p>
        </div>
    </div>
</div><!--/category-tab-->
@endforeach	
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">	
            @foreach ($related_product as $key =>$relate)
            <a href="{{ URL::to('/chi-tiet-san-pham/'.$relate->product_id) }}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('public/uploads/product/'.$relate->product_image) }}" alt="" />
                                <h2>{{ number_format($relate->product_price).' VNĐ' }}</h2>
                                <p>{{ $relate->product_name }}</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
                            </div>
                        </div>
                    </div>
                </div>            
            @endforeach
            </div>

        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->

@endsection
@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Cập nhật sản phẩm
        </header>

        <div class="panel-body">
            @foreach ($edit_product as $key=> $edit_value)
            
            <div class="position-center">
                <form role="form" action="{{ URL::to('/update-product/'.$edit_value->product_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                    <label for="product_name">Tên sản phẩm</label>
                    <input type="text" name ="product_name" value="{{ $edit_value->product_name}}"class="form-control" placeholder="Tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="product_price">Giá sản phẩm</label>
                    <input type="text" name ="product_price" value="{{ $edit_value->product_price}}"class="form-control" placeholder="Giá sản phẩm">
                </div>
                <div class="form-group">
                    <label for="product_image">Hình ảnh sản phẩm</label>
                    <input type="file" name ="product_image" value="{{ $edit_value->product_image}}"class="form-control" placeholder="Hình ảnh sản phẩm">
                    <img src="{{ URL::to('public/uploads/product/'.$edit_value->product_image) }}" height="100" width="80">
                </div>
                <div class="form-group">
                    <label for="product_desc">Mô tả sản phẩm</label>
                    <textarea style="resize:none" rows=2 name="product_desc" class="form-control" placeholder="Mô tả sản phẩm">{{ $edit_value->product_desc}}</textarea>
                </div>
                <div class="form-group">
                    <label for="product_desc">Nội dung sản phẩm</label>
                    <textarea style="resize:none" rows=12 name="product_content" class="form-control" placeholder="Nội dung sản phẩm">{{ $edit_value->product_content}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Danh mục sản phẩm</label>
                    <select name="category_product" class="form-control input-m m-bot15">
                        @foreach ($category_product as $key => $category)
                            @if ($category->category_id==$edit_value->category_id)
                            <option selected value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @else
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endif
                        @endforeach
                    
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Thương hiệu sản phẩm</label>
                    <select name="brand_product" class="form-control input-m m-bot15">
                        @foreach ($brand_product as $key => $brand)
                            @if ($brand->brand_id==$edit_value->brand_id)
                            <option selected value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                            @else
                            <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Hiển thị</label>
                    <select name="product_status" class="form-control input-m m-bot15">
                        @if ($edit_value->product_status == 1)
                        <option selected value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                        @else
                        <option selected value="0">Ẩn</option>
                        <option value="1">Hiển thị</option>
                        @endif
                    </select>
                </div>
                <button type="submit" name="add_product"class="btn btn-info">Cập nhật sản phẩm</button>
            </form>
            </div>
            @endforeach
        </div>
    </section>

</div>
@endsection

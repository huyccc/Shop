@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm sản phẩm
        </header>

        <div class="panel-body">
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
            <div class="position-center">
                <form role="form" action="{{ URL::to('/save-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                    <label for="product_name">Tên sản phẩm</label>
                    <input type="text" name="product_name"class="form-control" placeholder="Sản phẩm">
                </div>
                <div class="form-group">
                    <label for="product_price">Giá sản phẩm</label>
                    <input type="text" name="product_price"class="form-control" placeholder="Giá sản phẩm">
                </div>
                <div class="form-group">
                    <label for="product_image">Hình ảnh sản phẩm</label>
                    <input type="file" name="product_image"class="form-control" placeholder="Hình ảnh sản phẩm">
                </div>
                <div class="form-group">
                    <label for="product_desc">Mô tả sản phẩm</label>
                    <textarea style="resize:none" rows=2 name="product_desc" class="form-control" placeholder="Mô tả sản phẩm"></textarea>
                </div>
                <div class="form-group">
                    <label for="product_content">Nội dung sản phẩm</label>
                    <textarea style="resize:none" rows=12 name="product_content" class="form-control" placeholder="Nội dung sản phẩm"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Danh mục sản phẩm</label>
                    <select name="category_product" class="form-control input-m m-bot15">
                        @foreach ($category_product as $key => $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Thương hiệu sản phẩm</label>
                    <select name="brand_product" class="form-control input-m m-bot15">
                        @foreach ($brand_product as $key => $brand)
                            <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Hiển thị</label>
                    <select name="product_status" class="form-control input-m m-bot15">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiển thị</option>
                    </select>
                </div>

                <button type="submit" name="add_product"class="btn btn-info">Thêm sản phẩm</button>
            </form>
            </div>

        </div>
    </section>

</div>
@endsection

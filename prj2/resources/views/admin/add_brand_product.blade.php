@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm danh mục thương hiệu
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
                <form role="form" action="{{ URL::to('/save-brand-product') }}" method="POST">
                    @csrf
                <div class="form-group">
                    <label for="brand_product_name">Tên thương hiệu</label>
                    <input type="text" name="brand_product_name"class="form-control" placeholder="Tên danh mục">
                </div>
                <div class="form-group">
                    <label for="brand_product_desc">Mô tả thương hiệu</label>
                    <textarea style="resize:none" rows=12 name="brand_product_desc" class="form-control" placeholder="Mô tả danh mục"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Hiển thị</label>
                    <select name="brand_product_status" class="form-control input-m m-bot15">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiển thị</option>
                    </select>
                </div>

                <button type="submit" name="add_brand_product"class="btn btn-info">Thêm thương hiệu</button>
            </form>
            </div>

        </div>
    </section>

</div>
@endsection
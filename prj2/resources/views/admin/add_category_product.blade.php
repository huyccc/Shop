@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm danh mục sản phẩm
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
                <form role="form" action="{{ URL::to('/save-category-product') }}" method="POST">
                    @csrf
                <div class="form-group">
                    <label for="category_product_name">Tên danh mục</label>
                    <input type="text" name="category_product_name"class="form-control" placeholder="Tên danh mục">
                </div>
                <div class="form-group">
                    <label for="category_product_desc">Mô tả danh mục</label>
                    <textarea style="resize:none" rows=12 name="category_product_desc" class="form-control" placeholder="Mô tả danh mục"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Hiển thị</label>
                    <select name="category_product_status" class="form-control input-m m-bot15">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiển thị</option>
                    </select>
                </div>

                <button type="submit" name="add_category_product"class="btn btn-info">Thêm danh mục</button>
            </form>
            </div>

        </div>
    </section>

</div>
@endsection

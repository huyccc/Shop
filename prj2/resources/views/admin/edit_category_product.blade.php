@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Cập nhật danh mục sản phẩm
        </header>

        <div class="panel-body">
            @foreach ($edit_category_product as $key=> $edit_value)
            
            <div class="position-center">
                <form role="form" action="{{ URL::to('/update-category-product/'.$edit_value->category_id) }}" method="POST">
                    @csrf
                <div class="form-group">
                    <label for="category_product_name">Tên danh mục</label>
                    <input type="text" name ="category_product_name" value="{{ $edit_value->category_name}}"class="form-control" placeholder="Tên danh mục">
                </div>
                <div class="form-group">
                    <label for="category_product_desc">Mô tả danh mục</label>
                    <textarea style="resize:none" rows=12 name="category_product_desc" class="form-control" placeholder="Mô tả danh mục">{{ $edit_value->category_desc}}</textarea>
                </div>

                <button type="submit" name="add_category_product"class="btn btn-info">Cập nhật danh mục</button>
            </form>
            </div>
            @endforeach
        </div>
    </section>

</div>
@endsection

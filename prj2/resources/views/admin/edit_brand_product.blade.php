@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Cập nhật danh mục thương hiệu
        </header>

        <div class="panel-body">
            @foreach ($edit_brand_product as $key=> $edit_value)
            
            <div class="position-center">
                <form role="form" action="{{ URL::to('/update-brand-product/'.$edit_value->brand_id) }}" method="POST">
                    @csrf
                <div class="form-group">
                    <label for="brand_product_name">Tên danh mục</label>
                    <input type="text" name ="brand_product_name" value="{{ $edit_value->brand_name}}"class="form-control" placeholder="Tên thương hiệu">
                </div>
                <div class="form-group">
                    <label for="brand_product_desc">Mô tả danh mục</label>
                    <textarea style="resize:none" rows=12 name="brand_product_desc" class="form-control" placeholder="Mô tả thương hiệu">{{ $edit_value->brand_desc}}</textarea>
                </div>

                <button type="submit" name="add_brand_product"class="btn btn-info">Cập nhật thương hiệu</button>
            </form>
            </div>
            @endforeach
        </div>
    </section>

</div>
@endsection

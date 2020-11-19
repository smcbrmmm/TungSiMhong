@extends('layouts.app')

@section('style')
    <style>
        .productImg {
            object-fit: cover;
            width: 100px;
            height: 100px;
            max-width: 100px;
        }
    </style>
@endsection

@section('content')

    <div class="container container-page">

        <div style="font-size: 24px" class="mb-2">
            ระบบการแก้ไขข้อมูลของสินค้า
        </div>

        <form action="{{ route('product.update',['product'=> $product->id]) }}" class="form" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="product_name">ชื่อสินค้า <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name"
                       name="product_name" value="{{ old('product_name',$product->product_name) }}"
                       aria-describedby="product_nameHelp" placeholder="ตัวอย่าง : ประทัด 1000 นัด">
                <small id="product_nameHelp" class="form-text text-muted">
                    ชื่อสินค้า จำเป็น
                </small>
                @error('product_name')
                <div class="alert alert-danger"> {{ $messege }} </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_code">รหัสสินค้า <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control @error('product_code') is-invalid @enderror" id="title"
                       name="product_code" value="{{ old('product_code',$product->product_code) }}"
                       aria-describedby="product_codeHelp" placeholder="ตัวอย่าง : ABC1234567">
                <small id="product_codeHelp" class="form-text text-muted">
                    รหัสสินค้า จำเป็น
                </small>
                @error('product_code')
                <div class="alert alert-danger"> รหัสสินค้าซ้ำหรือรูปแบบไม่ถูกต้อง </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_price">ราคาสินค้า (บาท) <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control @error('product_price') is-invalid @enderror" id="product_price"
                       name="product_price" value="{{ old('product_price',$product->product_price) }}"
                       aria-describedby="product_priceHelp" placeholder="ตัวอย่าง : 200">
                <small id="product_priceHelp" class="form-text text-muted">
                    ราคาสินค้า จำเป็น
                </small>
                @error('product_price')
                <div class="alert alert-danger"> รหัสสินค้าซ้ำหรือรูปแบบไม่ถูกต้อง </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_quantity">จำนวนสินค้าที่มี <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control @error('product_quantity') is-invalid @enderror" id="product_quantity"
                       name="product_quantity" value="{{ old('product_quantity',$product->product_quantity) }}"
                       aria-describedby="product_quantityHelp" placeholder="ตัวอย่าง : 23">
                <small id="product_quantityHelp" class="form-text text-muted">
                    จำนวนสินค้าที่มี จำเป็น
                </small>
                @error('product_quantity')
                <div class="alert alert-danger"> จำนวนเงินไม่ถูกต้อง </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_weight">น้ำหนักสินค้า/ต่อชิ้น <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control @error('product_weight') is-invalid @enderror" id="product_weight"
                       name="product_weight" value="{{ old('product_weight',$product->product_weight) }}"
                       aria-describedby="product_weightHelp" placeholder="ตัวอย่าง : 200">
                <small id="product_weightHelp" class="form-text text-muted">
                    น้ำหนักสินค้า/ต่อชิ้น จำเป็น
                </small>
                @error('product_weight')
                <div class="alert alert-danger">น้ำหนักสินค้าไม่ถูกต้อง</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_detail">ข้อมูลเพิ่มเติมของสินค้า <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <textarea class="form-control @error('product_detail') is-invalid @enderror" id="product_detail"
                          placeholder="ตัวอย่าง : ประทัด 1000 นัดเหมาะสำหรับงานใหญ่"
                          name="product_detail">{{old('product_detail',$product->product_detail) }}"</textarea>
                <small id="product_weightHelp" class="form-text text-muted">
                    ข้อมูลเพิ่มเติมของสินค้า จำเป็น
                </small>
                @error('product_detail')
                <div class="alert alert-danger">จำนวนสินค้าไม่ถูกต้อง</div>
                @enderror
            </div>



            <div class="form-group">
                <label for="img">รูปภาพของสินค้า <i style="color: indianred" class="fas fa-star-of-life"></i></label>

                <div>
                    <img src="http://localhost:8000/storage{{ $product->img }}" alt="{{ $product->product_code }}"
                         class="productImg">
                </div>

                <input type="file" class="form-control-file mt-1"
                       id="img" name="img" onchange="readURL(this);">
            </div>

            <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>

        </form>

    </div>


@endsection


@section('script')

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.productImg')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


    </script>

@endsection

@extends('layouts.app')

@section('style')
    <style>
        .productImg {
            object-fit: cover;
            width: 200px;
            height: 150px;

        }
    </style>
@endsection

@section('content')

    <div class="container container-page">

        <div style="font-size: 24px">
            เพิ่มสินค้า
        </div>
        <br>

        <form action="{{ route('product.store') }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="product_name">ชื่อสินค้า  <i style="color: indianred" class="fas fa-star-of-life"></i> </label>
                <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name"
                       name="product_name" required placeholder="ตัวอย่าง : ประทัด 1000 นัด"
                       aria-describedby="product_nameHelp">
                <small id="telHelp" class="form-text text-muted">
                    ชื่อสินค้า จำเป็น
                </small>
                @error('product_name')
                <div class="alert alert-danger"> {{ $messege }} </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_code">รหัสสินค้า <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control @error('product_code') is-invalid @enderror" id="title"
                       name="product_code" required placeholder="ตัวอย่าง : ABC1234567"
                       aria-describedby="product_codeHelp">
                <small id="telHelp" class="form-text text-muted">
                    รหัสสินค้า จำเป็น
                </small>
                @error('product_code')
                <div class="alert alert-danger"> รหัสสินค้าซ้ำหรือรูปแบบไม่ถูกต้อง </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_price">ราคาสินค้า (บาท) <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control @error('product_price') is-invalid @enderror" id="product_price"
                       name="product_price" required placeholder="ตัวอย่าง : 200"
                       aria-describedby="product_priceHelp">
                <small id="telHelp" class="form-text text-muted">
                    ราคาสินค้า (บาท) จำเป็น
                </small>
                @error('product_price')
                <div class="alert alert-danger"> จำนวนเงินไม่ถูกต้อง </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_quantity">จำนวนสินค้าที่มี (ชิ้น) <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control @error('product_quantity') is-invalid @enderror" id="product_quantity"
                       name="product_quantity" required placeholder="ตัวอย่าง : 23"
                       aria-describedby="product_quantityHelp">
                <small id="telHelp" class="form-text text-muted">
                    จำนวนสินค้าที่มี (ชิ้น) จำเป็น
                </small>
                @error('product_quantity')
                <div class="alert alert-danger">จำนวนสินค้าไม่ถูกต้อง</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_weight">น้ำหนักสินค้า/ต่อชิ้น (กรัม) <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control @error('product_weight') is-invalid @enderror" id="product_weight"
                       name="product_weight" required placeholder="ตัวอย่าง : 200"
                       aria-describedby="product_weightHelp">
                <small id="telHelp" class="form-text text-muted">
                    น้ำหนักสินค้า/ต่อชิ้น (กรัม) จำเป็น
                </small>
                @error('product_weight')
                <div class="alert alert-danger">น้ำหนักสินค้าไม่ถูกต้อง</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_detail">ข้อมูลเพิ่มเติมของสินค้า <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <textarea class="form-control @error('product_detail') is-invalid @enderror" id="product_detail"
                          required placeholder="ตัวอย่าง : ประทัด 1000 นัดเหมาะสำหรับงานใหญ่"
                          name="product_detail"></textarea>
                <small id="telHelp" class="form-text text-muted">
                    ข้อมูลเพิ่มเติมของสินค้า จำเป็น
                </small>
                @error('product_detail')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="img">รูปภาพของสินค้า</label>
                <img src="" alt=""
                     class="productImg mb-3" >
            </div>


            <div class="form-group">

                <input type="file" class="form-control-file" required
                       id="img" name="img" onchange="readURL(this)">
            </div>


            <button type="submit" class="btn btn-primary">เพิ่มสินค้า</button>

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

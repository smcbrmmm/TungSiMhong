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

        <form action="{{ route('product.update',['product'=> $product->id]) }}" class="form" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="product_name">ชื่อสินค้า</label>
                <input type="text" class="form-control" id="product_name"
                       name="product_name" value="{{ old('product_name',$product->product_name) }}"
                       aria-describedby="product_nameHelp">
                <small id="product_nameHelp" class="form-text text-muted">
                    ชื่อสินค้า is required .
                </small>
            </div>

            <div class="form-group">
                <label for="product_code">รหัสสินค้า</label>
                <input type="text" class="form-control" id="title"
                       name="product_code" value="{{ old('product_code',$product->product_code) }}"
                       aria-describedby="product_codeHelp">
                <small id="product_codeHelp" class="form-text text-muted">
                    รหัสสินค้า is required .
                </small>
            </div>

            <div class="form-group">
                <label for="product_price">ราคาสินค้า</label>
                <input type="text" class="form-control" id="product_price"
                       name="product_price" value="{{ old('product_price',$product->product_price) }}"
                       aria-describedby="product_priceHelp">
                <small id="product_priceHelp" class="form-text text-muted">
                    ราคาสินค้า is required .
                </small>
            </div>

            <div class="form-group">
                <label for="product_quantity">จำนวนสินค้าที่มี</label>
                <input type="text" class="form-control" id="product_quantity"
                       name="product_quantity" value="{{ old('product_quantity',$product->product_quantity) }}"
                       aria-describedby="product_quantityHelp">
                <small id="product_quantityHelp" class="form-text text-muted">
                    จำนวนสินค้าที่มี is required .
                </small>
            </div>

            <div class="form-group">
                <label for="product_weight">น้ำหนักสินค้า/ต่อชิ้น</label>
                <input type="text" class="form-control" id="product_weight"
                       name="product_weight" value="{{ old('product_weight',$product->product_weight) }}"
                       aria-describedby="product_weightHelp">
                <small id="product_weightHelp" class="form-text text-muted">
                    น้ำหนักสินค้า/ต่อชิ้น is required .
                </small>
            </div>

            <div class="form-group">
                <label for="product_detail">ข้อมูลเพิ่มเติมของสินค้า</label>
                <textarea class="form-control" id="product_detail"
                          name="product_detail">{{old('product_detail',$product->product_detail) }}"</textarea>
            </div>



            <div class="form-group">
                <label for="img">รูปภาพของสินค้า</label>

                <div>
                    <img src="http://localhost:8000/storage{{ $product->img }}" alt="{{ $product->product_code }}"
                         class="productImg">
                </div>

                <input type="file" class="form-control-file mt-1"
                       id="img" name="img" onchange="readURL(this);">
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

    <script>
        // $(document).ready(function(){
        //     $('#img').on('change', function (e){
        //        console.log('samut');
        //        $('.productImg').attr('src',"http://localhost:8000/storage/imgProduct/3.jpg");
        //     });
        // });
    </script>
@endsection

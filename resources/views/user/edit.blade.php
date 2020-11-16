@extends('layouts.app')

@section('style')

@endsection

@section('content')

    <div class="container">
        <div> แก้ไขข้อมูลส่วนตัว </div>

        <form action="" method="POST">
        @method('PUT')
        @csrf

{{--            <label for="img_path">Img_path</label>--}}
{{--            <input type="file" class="form-control"--}}
{{--                   id="img_path" name="img_path">--}}

            <div class="form-group">
                <label for="img_path">ไฟล์รูปภาพของคุณ</label>
                <input type="file" class="form-control-file" id="img_path" name="img_path">
            </div>


        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                   name="title" value="{{ old('title', $user->name) }}"
                   aria-describedby="titleHelp">
            <small id="titleHelp" class="form-text text-muted">
                Post Title is required
            </small>
{{--            @error('title')--}}
{{--            <div class="alert alert-danger">{{ $message }}</div>--}}
{{--            @enderror--}}
        </div>

        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                      name="content">{{ old('content', $user->tel) }}</textarea>
            @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">แก้ไข</button>
        </form>


    </div>


@endsection

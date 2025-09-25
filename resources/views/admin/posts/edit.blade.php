@extends('layouts.app_admin')

@section('content')
<div class="container mt-4 mb-4">
    <h2>Sửa tin tức<caption></caption></h2>

    <form action="{{ route('posts.update',$post) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.posts.form')
        <button type="submit" class="btn btn-success">Lưu thay đổi</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection

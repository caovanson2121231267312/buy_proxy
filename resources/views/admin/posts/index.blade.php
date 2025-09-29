@extends('layouts.app_admin')

@section('content')
    <div class="container mt-4 mb-4">
        <h2 class="mb-4">Quản lý tin tức</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>
        <a href="{{ route('crawl.index') }}" class="btn btn-info mb-3">+ Cào Bài viết</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Người tạo</th>
                        <th>Trang thái</th>
                        <th width="180">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                <div>
                                    @if (!empty($post->image))
                                        <img src="{{ asset('storage/' . $post->image) }}" width="80" class="mt-2">
                                    @endif
                                </div>
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name ?? 'N/A' }}</td>
                            <td>{{ $post->status ? 'hiện' : 'ẩn' }}</td>
                            <td>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-info btn-sm">Xem trước</a>
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $posts->links() }}

        </div>
    </div>
@endsection

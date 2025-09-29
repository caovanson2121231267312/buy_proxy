@extends('layouts.app_admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Crawl dữ liệu từ Website</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('crawl.submit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="url" class="form-label">Nhập link bài viết</label>
                    <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror"
                           placeholder="https://example.com/bai-viet" value="{{ old('url') }}">
                    @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="domain" class="form-label">Chọn Domain</label>
                    <select name="domain" id="domain" class="form-select @error('domain') is-invalid @enderror">
                        <option value="">-- Chọn Domain --</option>
                        @foreach($domains as $key => $name)
                            <option value="{{ $key }}" {{ old('domain') == $key ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('domain')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Chọn Trạng thái hiển thị</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="">-- Chọn trạng thái hiển thị --</option>
                        <option value="0">Ẩn</option>
                        <option value="1">Hiện</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-cloud-download"></i> Crawl Ngay
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

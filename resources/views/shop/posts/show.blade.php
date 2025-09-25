@extends('layouts.app_seo')

@section('content')
    <div class="inner-hero1 pt-60" style="background-image: url({{ asset('seo/assets/img/bg/inner-hero1-bg.jpg') }});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="main-heading1">
                        <h1>Bài viết</h1>
                        <div class="breadcrumbs-pages">
                            <ul>
                                {{-- <li><a href="{{ route('home_index') }}">Trang chủ</a></li> --}}
                                {{-- <li class="angle"><i class="fa-solid fa-angle-right"></i></li> --}}
                                {{-- <li>Liên hệ chúng tôi</li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="images">
                        <img src="{{ asset('seo/assets/img/images/inner-hero-image1.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="sec-shape">
            <img src="{{ asset('seo/assets/img/shapes/inner-hero-shape.png') }}" alt="">
        </div>
    </div>
<div class="container py-4">
    <div class="card shadow-sm border-0">
        @if($post->image)
            {{-- <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}"> --}}
        @endif

        <div class="card-body">
            <h1 class="card-title mb-3">{{ $post->title }}</h1>
            <p class="text-muted">
                ✍️ {{ $post->user->name }} • {{ $post->created_at->format('d/m/Y') }}
            </p>

            <div class="card-text">
                {!! $post->content !!}
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('blog') }}" class="btn btn-secondary">⬅️ Quay lại danh sách</a>
    </div>
</div>
</div>
@endsection

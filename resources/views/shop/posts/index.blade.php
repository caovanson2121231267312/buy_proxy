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
    <h1 class="mb-4 text-center">📚 Danh sách bài viết</h1>

    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('seo.posts.show', ['slug' => $post->slug]) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                            </a>
                        </h5>
                        <p class="card-text text-muted">{{ $post->description }}</p>
                        <div class="mt-auto">
                            <small class="text-secondary">
                                ✍️ {{ $post->user->name }} • {{ $post->created_at->format('d/m/Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection

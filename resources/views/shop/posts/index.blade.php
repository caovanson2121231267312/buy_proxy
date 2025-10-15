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
                <a href="{{ route('seo.posts.show', ['slug' => $post->slug]) }}" class="d-block w-100 h-100">
                    <div class="card shadow-sm h-100">
                        @if($post->image)
                            <div class="card-img">
                                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                {{ $post->title }}
                            </h5>
                            <p class="card-text text-muted">{{ $post->description }}</p>
                            <div class="mt-auto">
                                <small class="text-secondary">
                                    ✍️ {{ $post->user->name }} • {{ $post->created_at->format('d/m/Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
</div>

<style>
    .card-img {
        max-height: 226px;
    overflow: hidden;
    }
.card {
    transition: all 0.3s ease;
    border: none;
    border-radius: 12px;
    overflow: hidden;
}
.card img {
    transition: transform 0.4s ease;
}
.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.card:hover img {
    /* transform: scale(1.05); */
}
.card-title {
    transition: color 0.3s ease;
}
.card:hover .card-title {
    color: #007bff; /* đổi sang màu nổi bật khi hover */
}
a.d-block {
    text-decoration: none;
    color: inherit;
}
</style>
@endsection

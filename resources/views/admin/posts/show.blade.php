@extends('layouts.app_admin')

@section('content')
<div class="container mt-4 mb-4">
    <h2>{{ $post->title }}</h2>
    <p><b>Author:</b> {{ $post->user->name ?? 'N/A' }}</p>
    <p><b>Status:</b> {{ $post->status ? 'Published' : 'Draft' }}</p>

    @if($post->image)
        <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid mb-3" width="400">
    @endif

    <p>{{ $post->description }}</p>
    <div>{!! $post->content !!}</div>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection

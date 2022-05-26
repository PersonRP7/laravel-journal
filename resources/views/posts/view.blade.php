@extends('layouts.app')

@section('content')

    {{-- guest --}}
    @guest
        <div class="container w-75 mt-4">
            <div class="card" style="width: 18rem;">
            <img src="{{ asset($post->name) }}" class="card-img-top" alt="{{ $post->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->text }}</p>
                {{-- Edit post --}}
                {{-- <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit post</a> --}}
                {{-- /Edit post --}}
            </div>
            </div>
        </div
    @endguest
    {{-- /guest --}}

@endsection
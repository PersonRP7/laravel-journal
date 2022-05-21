@extends('layouts.app')

@section('content')
    <div class="container w-75 mt-4">
        <div class="card" style="width: 18rem;">
        <img src="{{ asset($post->name) }}" class="card-img-top" alt="{{ $post->name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->text }}</p>
            {{-- Edit post --}}
            <a href="#" class="btn btn-primary">Edit post</a>
            {{-- /Edit post --}}
        </div>
        </div>
    </div
@endsection
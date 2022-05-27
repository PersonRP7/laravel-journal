@extends('layouts.app')

@section('content')

    {{-- guest --}}
    @guest
        <div class="container text-center w-75 mt-4">
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
        </div>
    @endguest
    {{-- /guest --}}

        {{-- Any logged in user other than the creator of the post --}}

        {{-- /Any logged in user other than the creator of the post --}}
    
        {{-- Current logged in user and the creator of the post. --}}
            @if (Auth::id() == $post->user->id)
                <div class="container w-75 mt-4">
                    <div class="card" style="width: 18rem;">
                    <img src="{{ asset($post->name) }}" class="card-img-top" alt="{{ $post->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->text }}</p>


                        
                        {{-- Edit post --}}
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit post</a>
                        {{-- /Edit post --}}

                        {{-- Delete post --}}
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                        {{-- /Delete post --}}

                    </div>
                    </div>
                </div>
            {{-- /Current logged in user and the creator of the post. --}}

            {{-- Any logged in user --}}
            @elseif (Auth::User())
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
                </div>
                {{-- /Any logged in user --}}
            @endif
@endsection
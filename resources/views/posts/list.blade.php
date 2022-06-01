@extends('layouts.app')

@section('content')
<div class="container w-75">

    {{-- /Alert --}}

    @if ($message = Session::get('success'))
        <x-general-alert type="success" :message="$message" class="mt-4"/>
    @elseif ($message = Session::get('error'))
        <x-general-alert type="warning" :message="$message" class="mt-4"/>
    @endif

    <!-- /Alert -->

    <!-- Create new post if logged in -->

    <!-- /Create new post if logged in -->


    <div class="row">
        
        @foreach ($posts as $post)
        {{-- <div class="col-md-3"> --}}
            <div class="card ms-4 mt-4" style="width: 18rem;">
            {{-- <img src="{{ $post->name }}" class="card-img-top" alt="{{ $post->name }}"> --}}
            <a href="{{ route('posts.show', $post) }}"><img src="{{ $post->name }}" class="card-img-top" alt="{{ $post->name }}"></a>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->text }}</p>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Enter</a>
            </div>
            </div>
        {{-- </div>     --}}
        @endforeach
        
    </div>

</div>
@endsection
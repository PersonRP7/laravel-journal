@props(['posts'])
<div>
        @foreach ($posts as $post)
        
            <div class="card ms-4 mt-4" style="width: 18rem;">
            
            <a href="{{ route('posts.show', $post) }}"><img src="{{ $post->name }}" class="card-img-top" alt="{{ $post->name }}"></a>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->text }}</p>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Enter</a>
            </div>
            </div>
        
        @endforeach
</div>
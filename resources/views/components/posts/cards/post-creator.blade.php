@props(['post'])

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
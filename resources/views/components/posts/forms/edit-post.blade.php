@props(['post'])

<div class="row mt-4 mb-4">
        <div class="col-md-12">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                {{-- title --}}
                <label for="title" class="form-label">Title</label>
                <input type="text" placeholder="{{ $post->title }}" name="title" class="form-control" id="title" aria-describedby="title">
                {{-- /title --}}

                {{-- text --}}
                <label for="text" class="form-label">Text</label>
                <input type="text" placeholder="{{ $post->text }}" name="text" class="form-control" id="text" aria-describedby="text">
                {{-- /text --}}

                {{-- image --}}
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" aria-describedby="image">
                {{-- /image --}}

            <button type="submit" class="btn btn-outline-info mt-4">Update</button>
        </form>
    </div>
</div>
@props(['post'])

<div class="card" style="width: 18rem;">
    <img src="{{ asset($post->name) }}" class="card-img-top" alt="{{ $post->name }}">
        <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
    <p class="card-text">{{ $post->text }}</p>
</div>

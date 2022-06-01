@extends('layouts.app')

@section('content')
{{-- {{ $user }} --}}
{{-- <x-posts.cards.posts-by-user :posts="$posts" /> --}}

@if ($posts->isEmpty())
    <p>There are no posts by this user yet.</p>
@else
    <x-posts.cards.posts-by-user :posts="$posts" />
@endif
@endsection
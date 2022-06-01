@extends('layouts.app')

@section('content')
{{-- {{ $user }} --}}
<x-posts.cards.posts-by-user :posts="$posts" />
@endsection
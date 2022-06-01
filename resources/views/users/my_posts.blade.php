@extends('layouts.app')

@section('content')
<x-posts.cards.my-posts :posts="$posts" />
@endsection
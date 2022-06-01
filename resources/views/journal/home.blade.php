@extends('layouts.app')

@section('content')
<div class="row text-center mt-4">
    <div class="col">
        <a href="{{ route('users.index') }}" class="btn btn-info">Users</a>
    </div>

    <div class="col">
        <a href="{{ route('roles.index') }}" class="btn btn-info">Roles</a>
    </div>

    <div class="col">
        <a href="{{ route('posts.index') }}" class="btn btn-info">Posts</a>
    </div>
</div>
@endsection
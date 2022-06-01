@extends('layouts.app')

@section('content')
    {{-- {{ $user }} --}}
    <!-- main container -->
    <div class="container mt-4 mb-4">
        <!-- first row -->
        <div class="row">
            <!-- User data column -->
            <div class="col-md-2">
                <p>Hello, {{ $user->email }}</p>
                <p>Your role is {{ $user->role }}</p>
            </div>
            <!-- /User data column -->
        </div>
        <!-- /first row -->

        <!-- second row (edit profile) -->
        <div class="row">
            <p>Edit profile</p><hr>
            <div>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
        <!-- /second row (edit profile) -->

        <!-- third row (posts) -->
        <div class="row mt-4">
            <p>My posts</p><hr>
            <div>
                <a href="{{ route('my_posts') }}" class="btn btn-primary">My posts</a>
            </div>
        </div>
        <!-- /third row (posts) -->


    </div>
    <!-- /main container -->

@endsection
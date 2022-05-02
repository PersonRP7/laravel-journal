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
    </div>
    <!-- /main container -->

@endsection
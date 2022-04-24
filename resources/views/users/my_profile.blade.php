@extends('layouts.app')

@section('content')
    <p>My Profile</p>
    <p>{{ $user->name }}</p>
@endsection
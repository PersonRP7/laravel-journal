@extends('layouts.app')

@section('content')
<div class="container w-75">

    <div class="row mt-4 mb-4">
        <div class="col text-center">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Greška!</strong><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>

    {{-- Check if none first --}}
    {{ $current_user }}

    <!-- Form -->
    {{-- <x-users.forms.user-edit-form-admin :user='$user' :roles='$roles' /> --}}
    {{-- @if ($user->role == 'admin') --}}
        {{-- Admin can edit every user --}}
        {{-- <x-users.forms.user-edit-form-admin :user='$user' :roles='$roles' /> --}}
    
    {{-- @else  --}}
    
        {{-- <x-users.forms.user-edit-form-user :user='$user' :roles='$roles' /> --}}
    
    <!-- /Form -->
    {{-- @endif --}}

    {{-- Form --}}
    @guest
        <x-users.guests.profile :user='$user' />
    @endguest
        
    @auth
        <x-users.forms.user-edit-form-admin :user='$user' :roles='$roles' />
    @endauth
    {{-- /Form --}}

</div>
@endsection
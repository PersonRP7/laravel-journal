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

    {{ $current_user }}

    <!-- Form -->
    {{-- <x-users.forms.user-edit-form-admin :user='$user' :roles='$roles' /> --}}
    @if ($user->role == 'admin')
    
        <x-users.forms.user-edit-form-admin :user='$user' :roles='$roles' />
    
    @else 
    
        <x-users.forms.user-edit-form-user :user='$user' :roles='$roles' />
    
    <!-- /Form -->
    @endif

</div>
@endsection
@extends('layouts.app')
{{-- Require admin --}}

@section('content')
<div class="container w-25">

    <!-- Alert / Errors -->
    <div class="row mt-4 mb-4">
        <div class="col text-center">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Error!</strong><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
    <!-- /Alert / Errors -->

    <!-- Form -->
    <x-users.forms.create-user-form :roles='$roles' />
    <!-- /Form -->

</div>
@endsection
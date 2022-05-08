@extends('layouts.app')

@section('content')
<div class="container w-75">

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

    <!-- Form -->
    <x-roles.forms.edit-role :role='$role'/>
    <!-- /Form -->

</div>
@endsection
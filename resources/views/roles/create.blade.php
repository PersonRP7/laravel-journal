@extends('layouts.app')

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
    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <label for="name" class="form-label">Role</label>
                <input type="text" name="role" class="form-control" id="role" aria-describedby="role">
                <button type="submit" class="btn btn-outline-info mt-4">Create</button>
            </form>
        </div>
    </div>
    <!-- /Form -->

</div>
@endsection
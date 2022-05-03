@extends('layouts.app')

@section('content')
<div class="container w-75">

    <!-- Alert -->
    <div class="row mt-4 mb-4">
        <div class="col text-center">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
        </div>
    </div>
    <!-- /Alert -->

    <!-- Create Form  -->
    <div class="row mt-4 mb-4">
        <div class="col text-center">
            <a class="btn btn-outline-info" href="{{ route('roles.create') }}">Create</a>
        </div>
    </div>
    <!-- /Create Form -->

    <!-- Table -->
    <div class="row mt-4 mb-4">
        <div class="col-md-12 text-center">
            <table class="table table-cover">
                <!-- table headings -->
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <!-- /table headings -->
    
                <!-- table body -->
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                             <td>{{ $role->role }}</td>
                            <td><a href="{{ route('roles.show', $role->id) }}">{{ $role->role }}</a></td>
                            <td>{{ $role->created_at }}</td>
                            <td><a class="btn btn-outline-info" href="{{ route('roles.edit', $role->id) }}">Edit</a></td>
                            <td>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <!-- /table body -->
    
            </table>
        </div>
    </div>
    <!-- /Table -->

</div>
@endsection
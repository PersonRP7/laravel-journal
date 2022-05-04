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
            <a class="btn btn-outline-info" href="{{ route('users.create') }}">Create</a>
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
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Email</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <!-- /table headings -->
    
                <!-- table body -->
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->email }}</td>
                            <td><a class="btn btn-outline-info" href="{{ route('users.edit', $user->id) }}">Edit</a></td>
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
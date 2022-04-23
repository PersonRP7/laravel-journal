@extends('layouts.app')

@section('content')
<div class="container w-75">
        <!-- Message -->
        <!-- Add an error message here. -->
        <div class="row mt-4 mb-4">
            <div class="col text-center">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
            </div>
        </div>
        <!-- /Message -->

        <!-- Display all users -->
        <!-- id, name, email, role -->

        <div class="row mt-4 mb-4">
            <!-- column -->
            <div class="col-md-12 text-center">

                <table class="table table-cover">

                    <!-- table headings -->
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                        </tr>
                    </thead>
                    <!-- /table headings -->

                    <!-- table body -->
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <!-- /table body -->

                </table>
                
            </div>
            <!-- /column -->
        </div>

        <!-- /Display all users -->
</div>
@endsection
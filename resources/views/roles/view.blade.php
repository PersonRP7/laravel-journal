@extends('layouts.app')

@section('content')
<div class="container w-75">

    <!-- Back -->
    <div class="row mb-4 mt-4 text-center">
        <div class="col">
            <a class="btn btn-outline-info" href="{{ url('roles') }}"> Back</a>
        </div>
    </div>
    <!-- /Back -->

    <!-- Row -->
    <div class="row mb-4 mt-4 text-center">
        <!-- table -->
        <table class="table table-cover">
            <!-- table headings -->
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Role</th>
                    <th scope="col">Created At</th>
                </tr>
            </thead>
            <!-- /table headings -->

            <!-- table body -->
            <tbody>
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->role }}</td>
                        <td>{{ $role->created_at }}</td>
                    </tr>
            </tbody>
            <!-- /table body -->

        </table>
        <!-- /table -->
    </div>
    <!-- /Row -->

</div>
@endsection
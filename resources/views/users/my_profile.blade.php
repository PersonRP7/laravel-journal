@extends('layouts.app')

@section('content')
    {{-- <p>My Profile</p> --}}
    <div class="row text-center">
        {{-- Alert component --}}
            <div class="row mt-4 mb-4">
                <div class="col text-center">
                    @if ($errors->any())
                        <x-users-alert type="error" :message="$message">
                    @elseif ($success)
                        <x-users-alert type="success" :message="$message">
                    @endif
                </div>
            </div>
        {{-- /Alert component --}}

        {{-- Name and change name component --}}
        {{-- <div class="row mt-4 mb-4">
            <div class="col-md-12">
                <form action="{{ route('bird.store') }}" method="POST">
                    @csrf
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="name">
                    <button type="submit" class="btn btn-outline-info">Change name</button>
                </form>
            </div>
        </div> --}}
        {{-- /Name and change name component --}}

    </div>
@endsection
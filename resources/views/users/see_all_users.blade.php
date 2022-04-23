@extends('layouts.app')

@section('content')
<div class="container w-75">
        <!-- Message -->
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
</div>
@endsection
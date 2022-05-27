@extends('layouts.app')

@section('content')

    {{-- guest --}}
    @guest
        <div class="container text-center w-75 mt-4">
           <x-posts.cards.post-guest :post="$post" />
        </div>
    @endguest
    {{-- /guest --}}

    {{-- Same component for the logged in(non creator) and the guest --}}
    
       
        <div class="container w-75 mt-4">

            {{-- Current logged in user and the creator of the post. --}}
                @if (Auth::id() == $post->user->id)


                    <x-posts.cards.post-creator :post="$post" />

                {{-- /Current logged in user and the creator of the post. --}}

                {{-- Any logged in user --}}
                @elseif (Auth::User())
                
                    <x-posts.cards.post-guest :post="$post" />

                {{-- /Any logged in user --}}
                @endif
        </div>
@endsection
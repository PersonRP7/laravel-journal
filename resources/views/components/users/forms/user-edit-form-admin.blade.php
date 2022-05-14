{{-- This form is used by the admin type user. It allows for complete user editing. --}}
@props(['roles', 'user'])

 <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                {{-- name --}}
                <label for="name" class="form-label">Name</label>
                <input type="text" placeholder="{{ $user->name }}" name="name" class="form-control" id="name" aria-describedby="name">
                {{-- /name --}}

                {{-- password --}}
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" aria-describedby="password">
                {{-- /password --}}

                {{-- password_confirmation --}}
                <label for="password_confirmation" class="form-label">Password confirmation</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" aria-describedby="password_confirmation">
                {{-- /password_confirmation --}}

               {{-- role select --}}
               {{-- Check if role none --}}
                    @if ( $roles->count() )
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-control">
                            @forelse ($roles as $role)
                                <option value="{{ $role->role }}">{{ $role->role }}</option>
                            @empty
                                <option value="Set role later">Set role later</option>
                            @endforelse
                    </select>
                    @else
                            <p>No roles have been created yet.</p>
                            <p>Click here: <a href="{{ route('roles.create') }}">Create Roles</a></p>
                    @endif
               {{-- /role select --}}

               {{-- email --}}
               <label for="email">Email</label>
               <input placeholder="{{ $user->email }}" type="email" name="email" class="form-control" id="email">
               {{-- /email --}}


                <button type="submit" class="btn btn-outline-info mt-4">Edit</button>
            </form>
        </div>
    </div>
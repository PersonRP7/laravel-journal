@props([
    'user'
])
<div class="row mt-4 mb-4">
        <div class="col-md-12">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                {{-- name --}}
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="name">
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
               <label for="role" class="form-label">Role</label>
               <select name="role" id="role" class="form-control">
                    @forelse ($roles as $role)
                        <option value="{{ $role->role }}">{{ $role->role }}</option>
                    @empty
                        <option value="Set role later">Set role later</option>
                    @endforelse
               </select>
               {{-- /role select --}}

               {{-- email --}}
               <label for="email">Email</label>
               <input type="email" name="email" class="form-control" id="email">
               {{-- /email --}}


            <button type="submit" class="btn btn-outline-info mt-4">Create</button>
        </form>
    </div>
</div>
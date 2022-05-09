@props(['role'])

<div>
    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @method('PATCH')
                @csrf
                <label for="role" class="form-label">Modify role</label>
                <input type="text" placeholder="{{ $role->role }}" name="role" class="form-control" id="role" aria-describedby="role">
                <div id="emailHelp" class="form-text">Edit role</div>
                <button type="submit" class="btn btn-outline-info">Modify</button>
            </form>
        </div>
    </div>
</div>
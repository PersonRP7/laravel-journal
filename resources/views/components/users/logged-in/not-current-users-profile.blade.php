@props(['user'])
<div>
    <p>You are logged in but you cannot edit other user's profile.</p>
    <p>Name: {{ $user->name }}</p>
    <p>Role: {{ $user->role }}</p>
</div>
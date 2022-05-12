@props(['user'])
<div>
    <p>Guests are only allowed to browse, not edit.</p>
    <p>Name: {{ $user->name }}</p>
    <p>Role: {{ $user->role }}</p>
</div>
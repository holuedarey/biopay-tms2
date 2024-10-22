@php
    //dd($user);
      $user->isAdmin() ? route('users.edit', $user) : route('users.show', $user);
@endphp
<a href="{{ route('users.show', $user) }}" class="product-names" style="width: 250px">
    <div class="light-product-box rounded-circle">
        <img class="img-fluid rounded-circle" src="{{ $user->avatar }}" alt="Agent avatar">
    </div>
    <p class="mt-1">{{ $user->name }}
        <br />
        <span class="small text-secondary text-truncate">{{ $user->email }} </span>
    </p>
</a>

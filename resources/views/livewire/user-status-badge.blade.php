<div class="btn-group">
    @php($color = statusColor($user->status))
    <button class="btn py-0 px-2 dropdown-toggle bg-light-{{ $color }} text-{{ $color }}" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $user->status }}
    </button>
    @can('update', $user)
        <ul class="dropdown-menu dropdown-block">
            @foreach($statuses as $status)
                @if($status != $user->status)
                    <li><a class="dropdown-item text-{{ statusColor($status) }}" href="#"
                           wire:click="updateStatus('{{$status}}')"
                        >{{ $status }}</a></li>
                @endif
            @endforeach
        </ul>
    @endcan
</div>
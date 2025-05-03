<div class="container mt-6 bg-light p-3">

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center my-2">
        <p class="font-weight-medium text-black py-1">Showing List of {{ ucwords('Terminal Monitoring') }}</p>
    
        <!-- This div will ensure that the input is aligned to the right -->
        <div class="position-relative ml-auto">
            <input type="text" class="form-control" style="width: 250px;" wire:model.debounce.500ms="search" placeholder="Search terminal id..." aria-describedby="Search" aria-label="Search" />
            <span wire:ignore>
                <i class="w-4 h-4 position-absolute top-50 end-0 translate-middle-y" data-lucide="search"></i>
            </span>
        </div>
    </div>
    
    <div class="intro-y overflow-auto mt-3">
        <div class="row g-3">
            @if (count($terminals) > 0)
                @foreach ($terminals as $terminal)
                @php
                    $strength = $terminal['signalStrength'] ?? null;

                    $label = 'N/A';
                    $color = 'text-muted';

                    if ($strength !== null) {
                        if ($strength >= -70) {
                            $label = 'Strong';
                            $color = 'text-success';
                        } elseif ($strength >= -85) {
                            $label = 'Moderate';
                            $color = 'text-warning';
                        } else {
                            $label = 'Weak';
                            $color = 'text-danger';
                        }
                    }
                @endphp
                    <div class="col-12 col-md-3">
                        <div class="card p-3 border border-light">
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <p class="small text-muted">TERMINAL ID</p>
                                    <a href="{{ route('termina.show',  $terminal->terminal->tid) }}" class="tooltip fw-medium" title="{{$terminal->terminal->agent->email}}" style="color: black;">
                                        {{ $terminal->terminal->tid }}
                                    </a>
                                    
                                    
                                    
                                </div>
                                <div>
                                    <livewire:terminal-toggle :terminalId="$terminal->id" />
                                </div>
                            </div>

                            <div class="d-flex align-items-center text-muted mb-1">
                                <img src="{{ 'assets/images/terminal/Path 3680.svg' }}" alt="" class="me-2" />
                                <span class="text-muted small font-weight-medium">Last seen</span>
                            </div>
                            

                            <div class="small font-weight-medium text-dark">
                                {{ $terminal->updated_at->format('M j Y, H:i') }}
                            </div>

                            <hr class="my-2" />

                            <div class="card p-3 shadow-sm mb-2">
                                <div class="d-flex gap-2 align-items-center">
                                    <img src="{{ 'assets/images/terminal/Group 2933.svg' }}" alt="" />
                                    <div>
                                        <p class="small font-weight-medium text-dark text-uppercase">Signal Strength</p>
                                        <p class="text-base font-weight-medium {{ $color }}"> {{ $strength !== null ? $label : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="small font-weight-medium text-muted">Network Type</p>
                                    <p class="text-base font-weight-medium text-primary">{{ $terminal->networkType ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="card p-3 shadow-sm mb-2 min-vh-24 d-flex flex-column align-items-center justify-content-center">
                                <div class="d-flex align-items-center mb-1 gap-2">
                                    <img src="{{ 'assets/images/terminal/printer.png' }}" class="w-6 h-6" alt="" />
                                    <p class="text-base font-weight-medium text-muted text-uppercase">Printer</p>
                                </div>
                                <p class="text-lg font-weight-medium text-warning"> {{ $terminal->printerState ? 'Available' : 'Not Available' }}</p>
                            </div>

                            <div class="card p-3 shadow-sm mb-2 min-vh-28 d-flex flex-column align-items-center">
                                <div class="d-flex align-items-center mb-1 gap-2">
                                    <img src="{{ 'assets/images/terminal/Group 2963.svg' }}" alt="" />
                                    <p class="text-sm font-weight-medium {{ $terminal->batteryLevel > 50  ? "text-success" : "text-danger" }}">{{ $terminal->batteryLevel ?? 'N/A' }}%</p>
                                </div>
                                <div>
                                    <p class="small font-weight-medium text-muted text-uppercase">Battery Level</p>
                                    <p class="text-base font-weight-bold text-dark mb-1">{{ $terminal->batteryLevel > 35 ? "CHARGING" : 'NOT CHARGING' }}</p>
                                </div>
                            </div>

                            <div class="card shadow-sm mb-2 max-vh-28">
                                <iframe width="100%" height="150" frameborder="0" style="border:0" src="https://maps.google.com/maps?q={{ $terminal->requestLat }},{{$terminal->requestLong }}&output=embed"></iframe>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <tr>
                    <td colspan="21" class="text-center">No Terminal data available.</td>
                </tr>
            @endif
        </div>

        <div class="mt-3">
            {{-- {{ $terminals->links() }} --}}
        </div>
    </div>
</div>

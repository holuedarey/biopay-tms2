<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('dashboard') }}">
                <img class="img-fluid for-light" src="{{ asset('assets/images/logo/logo.png') }}" style="width: 60%" alt="">
                <img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo.png') }}" style="width: 60%" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{ route('dashboard') }}">
                <img class="img-fluid" src="{{ asset('assets/images/logo/logo.png') }}" style="width: 40px; height: 20px" alt="">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="{{ route('dashboard') }}">
                            <img class="img-fluid" src="{{ asset('assets/images/logo/logo.png') }}" style="width: 40px; height: 20px" alt="">
                        </a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    @foreach($side_menu as $item)
                        @isset($item['sub_menu'])
                            <li class="sidebar-list">
                                <a href="#" class="sidebar-link sidebar-title">
                                    <span class="me-2"><i class="icofont icofont-{{ $item['icon'] }}"></i></span>
                                    <span>{{ $item['title'] }}</span></a>
                                <ul class="sidebar-submenu">
                                    @foreach($item['sub_menu'] as $sub_item)
                                        <li>
                                            <a href="{{ route($sub_item['route_name'] ?? 'dashboard') }}">{{ $sub_item['title'] }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="sidebar-list">
                                <a href="{{ route($item['route_name'] ?? 'dashboard') }}"
                                   class="sidebar-link sidebar-title link-nav"
                                >
                                    <span class="me-2"><i class="icofont icofont-{{ $item['icon'] }}"></i></span>
                                    <span>{{ $item['title'] }}</span>
                                </a>
                            </li>
                        @endisset
                    @endforeach
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
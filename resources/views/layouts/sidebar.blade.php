<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
      <div class="logo-wrapper">
          <a href="{{ route('dashboard')}}">
              <img class="img-fluid for-light" src="{{ asset('assets/images/logo/logo.png') }}" style="width: 60%" alt="">
{{--              <img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}" style="width: 60%" alt="">--}}
          </a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
      </div>
      <div class="logo-icon-wrapper"><a href="{{ route('dashboard')}}">
              <img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon.png') }}" style="width: 20%; height: 20px" alt=""></a>
      </div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn">
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{ route('dashboard')}}" target="_blank">
                <svg class="stroke-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                </svg><span>Dashboard</span></a></li>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="https://pixelstrap.freshdesk.com/support/home" target="_blank">
                <svg class="stroke-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-social') }}"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#fill-social') }}"></use>
                </svg><span>Raise Support</span></a></li>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="https://docs.pixelstrap.com/cuba/laravel/document/" target="_blank">
                <svg class="stroke-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-form') }}"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#fill-form') }}"></use>
                </svg><span>Documentation </span></a></li>
          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>
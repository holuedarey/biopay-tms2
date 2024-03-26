
<!-- latest jquery-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- scrollbar js-->
<script src="{{asset('assets/js/scrollbar/simplebar.js')}}"></script>
<script src="{{asset('assets/js/scrollbar/custom.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('assets/js/config.js')}}"></script>
<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
<script id="menu" src="{{asset('assets/js/sidebar-menu.js')}}"></script>
{{-- <script src="{{ asset('assets/js/sidebar-pin.js') }}"></script>--}}
<script src="{{ asset('assets/js/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/slick/slick.js') }}"></script>
<script src="{{ asset('assets/js/header-slick.js') }}"></script>
<script src="{{ asset('assets/js/js-datatables/simple-datatables@latest.js') }}"></script>
<script src="{{ asset('assets/js/custom-list-product.js') }}"></script>
<script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/js/ecommerce.js') }}"></script>
@stack('script')
@yield('script')

<script src="{{asset('assets/js/tooltip-init.js')}}"></script>


<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('assets/js/script.js')}}"></script>
{{--<script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script>--}}
<script src="{{ asset('assets/js/custom/form-handler.js') }}"></script>
<script src="{{ asset('assets/js/notify/mine.js') }}"></script>

{{-- @if(Route::current()->getName() == 'index')
	<script src="{{asset('assets/js/layout-change.js')}}"></script>
@endif --}}

@livewireScripts
@if(Route::currentRouteName() == 'index')
 <script>
  new WOW().init();
 </script>
@endif

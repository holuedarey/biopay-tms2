<!-- BEGIN: Notification Content -->
@if(session()->has('status') || session()->has('message'))
    <div id="my-notification" data-type="info" data-msg="{{ session('message') ?? session('status') }}"></div>
@endif

@if(session()->has('success'))
    <div id="my-notification" data-type="success" data-msg="{{ session('success') }}"></div>
@endif

@if(session()->has('error'))
    <div id="my-notification" data-type="error" data-msg="{{ session('error') }}"></div>
@endif

@if(session()->has('pending'))
    <div id="my-notification" data-type="warning" data-msg="{{ session('pending') }}"></div>
@endif

@foreach($errors->all() as $error)
    <div id="my-notification" data-type="error" data-msg="{{ $error }}"></div>
@endforeach
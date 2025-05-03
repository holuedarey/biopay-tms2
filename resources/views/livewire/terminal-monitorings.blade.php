@extends('../layout/'.  config('view.menu-style'))

@section('title', 'Transactions')



@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center">
        <h2 class="text-lg font-medium mr-auto">
            Transactions
        </h2>
    </div>
    <section class="mt-4">
        <livewire:transactions-table />
    </section>
@endsection

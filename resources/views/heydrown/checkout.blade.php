@extends('heydrown.layouts.app')


@section('content')
    <div class="heydrown-banner banner-empty d-flex justify-content-center align-items-center">

    </div>

    <div class="container p-5" style="min-height: 100vh;">
        @livewire('checkout')
    </div>




@endsection

@push('css')
    @livewireStyles()
    <link rel="stylesheet" href="/css/style2.css">
@endpush

@push('scripts')
    @livewireScripts()
@endpush

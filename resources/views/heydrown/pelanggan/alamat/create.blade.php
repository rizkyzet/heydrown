@extends('heydrown.layouts.app')

@section('content')
    <div class="heydrown-banner banner-empty d-flex justify-content-center align-items-center" style="min-height: 20vh;">

    </div>

    @include('heydrown.layouts.offcanvas-member-area')

    <div class="container" style="min-height: 100vh">
        <div class="row heydrown-member-area">
            @include('heydrown.layouts.sidebar-member-area')
            <div class="col content">
                <h3 class="heading pb-2">Create New Address</h3>

                <div class="row">
                    <div class="col">
                        <div class="form-group">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="/css/style2.css">
@endpush


@push('scripts')
    <script>
        $('.btn-canvas').on('click', function() {
            $('.heydrown-offcanvas').toggleClass('slide');

        });
    </script>
@endpush

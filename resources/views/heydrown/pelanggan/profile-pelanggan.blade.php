@extends('heydrown.layouts.app')

@section('content')
    <div class="heydrown-banner banner-empty d-flex justify-content-center align-items-center" style="min-height: 20vh;">

    </div>

    @include('heydrown.layouts.offcanvas-member-area')

    <div class="container" style="min-height: 100vh">
        <div class="row heydrown-member-area">
            @include('heydrown.layouts.sidebar-member-area')
            <div class="ml-5 col content">
                <h3 class="heading pb-2">Profile</h3>
                <form action="{{ route('pelanggan.profile.update', Auth::user()) }}" method="POST" class="mt-4">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                            <div class="form-group heydrown-form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control heydrown-input" name="email" id="email" readonly
                                    disabled value="{{ Auth::user()->email }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group heydrown-form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control heydrown-input" name="name" id="name"
                                    value="{{ Auth::user()->name }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group heydrown-form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control heydrown-input" name="password" id="password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @else
                                    <small class="text-white">*isi jika ingin diganti</small>
                                @enderror
                            </div>
                            <div class="form-group heydrown-form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control heydrown-input" name="password_confirmation">
                            </div>
                            <button class="btn btn-sm btn-heydrown-black-hover" type="submit">Update Profile</button>
                        </div>
                    </div>
                </form>
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

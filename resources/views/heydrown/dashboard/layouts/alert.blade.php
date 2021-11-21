@if (session()->has('success'))
    <div class="alert alert-success col" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (session()->has('failed'))
    <div class="alert alert-danger col" role="alert">
        {{ session('failed') }}
    </div>
@endif

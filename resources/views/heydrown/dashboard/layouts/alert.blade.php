@if (session()->has('success'))
    <div class="alert alert-success col" role="alert">
        {{ session('success') }}
    </div>
@endif

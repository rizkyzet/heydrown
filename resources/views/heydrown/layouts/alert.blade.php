@if (session()->has('alert'))
    <div class="alert alert-dark alert-dismissible fade show my-3" role="alert">
        <strong>{{ session('alert') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

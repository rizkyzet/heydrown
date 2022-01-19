<div class="row login-offcanvas mx-2 mb-3">
    <div class="col">
        <h5 class="heading">LOGIN</h5>
        <form wire:submit.prevent="login" class="form p-3 mt-3">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" class="form-control" id="email" wire:model="email">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" wire:model="password">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-heydrown-black text-white btn-sm px-4" wire:loading.attr="disabled">LOG
                IN</button>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            background: 'black',
            iconColor: 'white',

        })


        window.addEventListener('login-alert', event => {
            Toast.fire({
                icon: event.detail.type == 'error' ? 'error' : 'success',
                title: '<h5 style="color:white;text-align:center;">' + event.detail.message + '</h5>'
            })
        })
    </script>
@endpush

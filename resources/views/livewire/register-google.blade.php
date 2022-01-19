<div class="container text-white p-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-0 mb-4" style="border-bottom: 2px solid white;">
            <h5 class="font-weight-bold text-center lsp-5">REGISTER NEW MEMBER</h5>
        </div>
    </div>

    <form action="{{ route('register.google.store') }}" method="POST" wire:submit.prevent="register">
        @csrf
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-4 heydrown-form">
                <div class="form-group heydrown-form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control heydrown-input" wire:model="users.email" disabled readonly>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group heydrown-form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control heydrown-input" wire:model="users.nama">
                            @error('users.nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group heydrown-form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control heydrown-input" wire:model="users.phone">
                            @error('users.phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group heydrown-form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control heydrown-input" wire:model="users.password">
                            @error('users.password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group heydrown-form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" class="form-control heydrown-input"
                                wire:model="users.password_confirmation">
                            @error('users.password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col">
                        <div class="form-group heydrown-form-group">
                            <label for="alamat['provinsi_id']">Provinsi</label>
                            <select class="form-control heydrown-input" wire:model="alamat.provinsi_id"
                                id="alamat['provinsi_id']">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinsi as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('alamat.provinsi_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group heydrown-form-group">
                            <label for="alamat['kota_id']">Kota/Kabupaten</label>
                            <select class="form-control heydrown-input" wire:model="alamat.kota_id"
                                id="alamat['kota_id']" wire:loading.attr='disabled' wire:target='alamat.provinsi_id'>
                                <option value="">Pilih Kota</option>
                                @foreach ($kota as $k)
                                    <option value="{{ $k->id }}">{{ $k->type . ' ' }}{{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('alamat.kota_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <div class="form-group heydrown-form-group">
                            <label for="alamat['kecamatan_id']">Kecamatan</label>
                            <select class="form-control heydrown-input" disabled wire:model="alamat.kecamata_id"
                                id="alamat['kecamatan_id']">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            <small class="text-white">*Untuk sementara tidak diisi</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group heydrown-form-group">
                            <label for="alamat['kode_pos']">Kode Pos</label>
                            <input type="text" class="form-control heydrown-input" wire:model="alamat.kode_pos">
                            @error('alamat.detail_alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="form-group heydrown-form-group">
                    <label for="alamat['detail_alamat']">Alamat</label>
                    <textarea id="alamat['detail_alamat']" cols="30" rows="8" class="form-control heydrown-input"
                        wire:model="alamat.detail_alamat"></textarea>
                    @error('alamat.detail_alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button class="btn btn-heydrown-hover float-right" type="submit">Register</button>
            </div>

        </div>

        <div class="text-center mt-4">
            <a class="text-white" href="/">Back to home</a>
        </div>

    </form>
</div>

@push('scripts')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            background: 'black',
            iconColor: 'white',
            customClass: {
                loader: 'loader-sweetalert',
                footer: 'footer-sweetalert'
            }

        })


        window.addEventListener('register-alert', event => {
            Toast.fire({
                icon: event.detail.type == 'error' ? 'error' : 'success',
                title: '<h5 style="color:white;text-align:center;">' + event.detail.message + '</h5>',
                willClose: () => {
                    document.location.href = '/';
                },
            })
        })
    </script>
@endpush

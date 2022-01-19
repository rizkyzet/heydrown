@extends('heydrown.dashboard.layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Transaksi</h1>
    </div>
    <a href="{{ route('dashboard.pesanan.expired') }}" class="btn btn-primary mb-3">Cek Expired</a>
    <div class="row">
        <div class="col">

            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Created</th>
                        <th>Expired</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->kode }}</td>
                            <td>{{ $p->user->name }}</td>
                            <td>{{ $p->grand_total }}</td>
                            <td>{{ $p->created_at->isoFormat('LLLL') }}</td>
                            <td>{{ $p->expired_at->isoFormat('LLLL') }}</td>
                            <td>{{ $p->status }}</td>
                            <td>
                                @if ($p->status == 'expired')
                                    <a class="btn btn-primary btn-sm d-inline disabled"
                                        href="">Detail</a>
                                @else
                                    <a class="btn btn-primary btn-sm d-inline"
                                        href="{{ route('dashboard.pesanan.show', $p) }}">Detail</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        })
    </script>
@endpush

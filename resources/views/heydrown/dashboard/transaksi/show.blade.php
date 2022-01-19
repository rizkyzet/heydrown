@extends('heydrown.dashboard.layouts.app')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pesanan {{ $pesanan->kode }} ({{ucfirst($pesanan->status)}})</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-lg-cols-2 mt-3">
        <div class="col">
            <h5 class="lsp-5">Order</h5>
            <table class="table-sm table table-borderless">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <td>{{ $pesanan->kode }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $pesanan->status }}</td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td>{{ $pesanan->created_at->isoFormat('LLLL') }}</td>
                    </tr>
                    <tr>
                        <th>Expired</th>
                        <td>{{ $pesanan->expired_at->isoFormat('LLLL') }}</td>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col">
            <h5 class="lsp-5">Shipment</h5>
            <table class="table-sm table table-borderless">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $pesanan->pengiriman->nama }}</td>
                    </tr>
                    <tr>
                        <th class="align-middle">Alamat</th>
                        <td>{{ $pesanan->pengiriman->detail_alamat }} <br>
                            {{ 'Provinsi ' . $pesanan->pengiriman->provinsi->nama . ' - ' . $pesanan->pengiriman->kota->type . ' ' . $pesanan->pengiriman->kota->nama . ' ' . $pesanan->pengiriman->kota->kode_pos }}
                        </td>
                    </tr>
                    <tr>
                        <th>Kurir</th>
                        <td>{{ strtoupper($pesanan->pengiriman->kurir) . ' ' . $pesanan->pengiriman->servis . ' (' . $pesanan->pengiriman->etd . ')' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $pesanan->pengiriman->phone }}</td>
                    </tr>

                </thead>
            </table>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <h5 class="lsp-5">Detail Order</h5>
            <table class="table table-sm mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Qty</th>
                        <th>Harga Satuan</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanan->detailPesanan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $p->produk->foto) }}" alt="foto produk" width="50"
                                    height="50">
                            </td>
                            <td>
                                {{ $p->produk->nama }}
                                @if ($p->diskon)
                                    <small
                                        class="heydrown-bg-black text-white px-2 py-1 ml-2">{{ '-' . $p->diskon . ' OFF' }}</small>
                                @endif
                            </td>
                            <td>{{ $p->qty }}</td>
                            <td>{{ $p->diskon ? rupiah($p->harga_diskon) : rupiah($p->harga) }}</td>
                            <td>{{ rupiah($p->total_harga) }}</td>
                        </tr>
                    @endforeach
                    <tr class="table-borderless">
                        <td colspan="5" class="text-right">Total</td>
                        <td class="text-right">{{ rupiah($pesanan->total) }}</td>
                    </tr>
                    <tr class="table-borderless">
                        <td colspan="5" class="text-right">Shipping</td>
                        <td class="text-right">{{ rupiah($pesanan->pengiriman->biaya) }}</td>
                    </tr>
                    <tr class="table-borderless">
                        <td colspan="5" class="text-right">Grand Total</td>
                        <td class="text-right">{{ rupiah($pesanan->grand_total) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-6">
            <h5 class="lsp-5">Informasi Pesanan</h5>
            <table class="table table-sm table-bordered">
                @foreach ($pesanan->logPesanan as $log)
                    <tr>
                        <td>{{ $log->created_at }}</td>
                        <td>{{ $log->info }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="row mt-5 mb-5">
        <div class="col">
            <h5 class="lsp-5">Bukti Pembayaran</h5>

            @if ($pesanan->buktiTransfer->count() > 0)
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th colspan="2" class="text-center">Catatan</th>
                            <th>Bukti</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan->buktiTransfer as $b)
                            <tr>
                                <td>{{ $b->created_at->isoFormat('LLLL') }}</td>
                                <td>{{ $b->status }}</td>
                                <td>{{ $b->catatan ? $b->catatan : 'tidak ada catatan untuk admin' }}</td>
                                <td>{{ $b->catatan_admin ? $b->catatan_admin : 'belum ada balasan dari admin' }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $b->image) }}" target="_blank">Open Image</a>
                                </td>
                                <td>
                                    @if ($b->status=='waiting')    
                                    <button type="button" class="btn btn-primary btn-sm modal-edit-bukti"
                                        data-toggle="modal" data-target="#editBuktiTransfer"
                                        data-idBuktiTransfer="{{ $b->id }}">
                                        Update
                                    </button>
                                    @else
                                    <a href="" class="btn btn-primary btn-sm disabled">update</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="d-flex justify-content-center">
                    <small>Bukti Kosong</small>
                </div>
            @endif

        </div>
    </div>

    @if ($pesanan->status == 'settlement' || $pesanan->status=='delivered')
        <div class="row mt-5 mb-5">
            <div class="col-6">
                <h5 class="lsp-5">Resi</h5>
                <form action="{{route('dashboard.pesanan.resi',$pesanan)}}" class="form-inline" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <input type="text" name="no_resi" id="noResi" class="form-control" placeholder="nomor resi" value="{{$pesanan->pengiriman->no_resi}}">
                        <button class="btn btn-sm btn-primary ml-2">input resi</button>
                    </div>
                </form>
            </div>
        </div>
    @endif


    <div class="modal fade" id="editBuktiTransfer" tabindex="-1" aria-labelledby="editBuktiTransferLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBuktiTransferLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('dashboard.pesanan.update', $pesanan) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('patch')
                        <input type="hidden" id="idBuktiTransfer" name="id_bukti">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="rejected">Rejected</option>
                                <option value="accept">Accept</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Catatan untuk customer (opsional)</label>
                            <input type="text" name="catatan_admin" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();

            $('.modal-edit-bukti').on('click', function() {
                const idBukti = $(this).data('idbuktitransfer')
                $('#idBuktiTransfer').val(idBukti)
            })
        })
    </script>
@endpush

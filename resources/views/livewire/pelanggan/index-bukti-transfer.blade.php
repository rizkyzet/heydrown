<div>


    @if ($bukti->count() > 0)
        <table class="table table-sm text-white">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th class="text-center">Catatan untuk admin</th>
                    <th class="text-center">Catatan dari admin</th>
                    <th>Bukti</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bukti as $b)
                    <tr>
                        <td>{{ $b->created_at->isoFormat('LLLL') }}</td>
                        <td>{{ $b->status }}</td>
                        <td>{{ $b->catatan ? $b->catatan : 'tidak ada catatan untuk admin' }}</td>
                        <td>{{ $b->catatan_admin ? $b->catatan_admin : 'belum ada balasan dari admin' }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $b->image) }}" target="_blank">Open Image</a>
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

    @if ($pesanan->status == 'pending')
        <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-heydrown-black text-white" data-toggle="modal"
                data-target="#modalCreateBuktiTransfer">Upload Bukti</button>
        </div>
    @endif


</div>

@component('mail::message')
# Tagihan {{ $pesanan->kode }}
<br>

### Kode Pesanan <br><span style="font-weight: normal;">{{ $pesanan->kode }}</span>

### No. Rekening <br><span style="font-weight: normal;">2321321421</span>

### Batas Waktu Pembayaran <br><span style="font-weight: normal;">{{ $pesanan->expired_at }}</span>



@component('mail::table')
| Produk      | Qty | Harga Satuan | Total  |
|:------------- |:-------------:|:-------------:| --------:|
@foreach ($pesanan->detailPesanan as $d)
| {{ $d->produk->nama }} {{ $d->diskon ? "-$d->diskon% OFF":""; }}      | {{ $d->qty }} | {{$d->diskon ? 'Rp. '.rupiah($d->harga_diskon) :'Rp. '.rupiah($d->total_harga) }}      | {{ 'Rp. '.rupiah($d->total_harga) }}      |
@endforeach
<hr>


@endcomponent

<table cellpadding=10 style="width: 100%">
    <tr>
        <th align="right" style="width: 70%">Sub Total</th>
        <td align="right">{{'Rp. '.rupiah($pesanan->total) }} </td>
    </tr>
    <tr>
        <th align="right" style="width: 70%">Shipping {{ '('. strtoupper($pesanan->pengiriman->kurir).' '.$pesanan->pengiriman->servis.')' }}</th>
        <td align="right">{{'Rp. '.rupiah($pesanan->pengiriman->biaya) }}</td>
    </tr>
    <tr>
        <th align="right" style="width: 70%">Sub Total</th>
        <td align="right">{{ 'Rp. '.rupiah($pesanan->grand_total) }}</td>
    </tr>
</table>


@component('mail::button', ['url' => ''])
Detail Pesanan
@endcomponent



Thanks,<br>
{{ config('app.name') }}
@endcomponent

<?php

namespace App\Http\Controllers;

use App\Models\BuktiTransfer;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::orderBy('created_at', 'DESC')->get();
        return view('heydrown.dashboard.transaksi.index', compact('pesanan'));
    }

    public function show(Pesanan $pesanan)
    {
        return view('heydrown.dashboard.transaksi.show', compact('pesanan'));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $dataBukti = BuktiTransfer::find($request->id_bukti);


        if ($request->status == 'accept') {
            DB::transaction(function () use ($dataBukti, $request, $pesanan) {
                $dataBukti->update(['status' => $request->status, 'catatan_admin' => $request->catatan_admin]);
                $pesanan->update(['status' => 'settlement']);
            });
            return redirect()->route('dashboard.pesanan.show', $pesanan)->with('success', 'Bukti transfer diupdate');
        } else {
            $dataBukti->update(['status' => $request->status, 'catatan_admin' => $request->catatan_admin]);
            return redirect()->route('dashboard.pesanan.show', $pesanan)->with('success', 'Bukti transfer diupdate');
        }
    }

    public function resi(Request $request, Pesanan $pesanan)
    {
        DB::transaction(function () use ($request, $pesanan) {
            $pesanan->pengiriman->update(['no_resi' => $request->no_resi]);
            $pesanan->update(['status' => 'delivered']);
        });
        return redirect()->route('dashboard.pesanan.show', $pesanan)->with('success', 'Resi telah di input!');
    }

    public function expired()
    {
        $pesanan = Pesanan::all();

        foreach ($pesanan as $p) {
            if(strtolower($p->status) == 'pending'){
                $p->update(['status'=>'expired']);
            }
        }

        return redirect()->route('dashboard.pesanan.index')->with('success', 'status telah di update!');
    }
}

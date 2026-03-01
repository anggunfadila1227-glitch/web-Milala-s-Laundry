<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with([
            'user',
            'details.layanan' 
            ])
            ->withCount('details')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('dashboard', [
            'transaksis'     => $transaksis,
            'countMenunggu'  => $transaksis->where('status', 'menunggu')->count(),
            'countProses'    => $transaksis->where('status', 'proses')->count(),
            'countSelesai'   => $transaksis->where('status', 'selesai')->count(),
            'countBatal'     => $transaksis->where('status', 'batal')->count(),
        ]);
    }
}

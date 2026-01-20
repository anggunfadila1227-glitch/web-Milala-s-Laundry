<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard customer.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    
    {
        $user = Auth::user();

        // =====================
        // JIKA ADMIN
        // =====================
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }



        // Ambil semua transaksi milik user yang login, beserta detail & layanan
        $transaksis = Transaksi::with('details.layanan')
                        ->where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Kirim data ke view customer.dashboard
        return view('customer.dashboard', compact('transaksis'));
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\User;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // total seluruh pesanan
        $totalPesanan = Pesanan::count();

        // pesanan masih proses
        $proses = Pesanan::where('status','proses')->count();

        // pesanan selesai
        $selesai = Pesanan::where('status','selesai')->count();

        // total customer
        $customer = User::where('role','customer')->count();

        return view('admin.dashboard', compact(
            'totalPesanan',
            'proses',
            'selesai',
            'customer'
        ));
    }
}
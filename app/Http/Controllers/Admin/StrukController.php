<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Barryvdh\DomPDF\Facade\Pdf; // ⬅️ WAJIB INI

class StrukController extends Controller
{
    public function pdf($id)
    {
        $pesanan = Pesanan::with('user')->findOrFail($id);

        $pdf = Pdf::loadView('admin.struk', compact('pesanan'))
                  ->setPaper([0, 0, 300, 500]);

        return $pdf->download('struk-'.$pesanan->no_struk.'.pdf');
    }
}

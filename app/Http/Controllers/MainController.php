<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function getTotalByDate($date)
    {
        $penjualan = Penjualan::select(
                                    DB::raw('SUM(penjualan.total_harga - penjualan.total_diskon) AS total'),
                                    DB::raw('SUM(penjualan.total_ppn) AS total_ppn')
                                )
                                ->whereBetween('penjualan.waktu', [$date.' 00:00:00', $date.' 23:59:59'])  
                                ->where('penjualan.status_bayar', 'Sudah Bayar')
                                ->get()[0];

        return json_encode($penjualan);
    }
}

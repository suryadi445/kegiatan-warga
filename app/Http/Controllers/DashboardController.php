<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Keuangan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        // query untuk dashboard keuangan masuk dan keuangan keluar
        $in = [];
        $out = [];
        $result = 0;
        for ($i = 1; $i <= 12; $i++) {
            $data = Keuangan::where('tipe', 'in')
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->get();

            if ($data != null) {
                $result = $data->sum(function ($data) {
                    return $data->nominal;
                });
            }

            $in[] = $result;
            $result_in = implode(',', $in);
        }


        for ($i = 1; $i <= 12; $i++) {
            $data = Keuangan::where('tipe', 'out')
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->get();

            if ($data != null) {
                $result = $data->sum(function ($data) {
                    return $data->nominal;
                });
            }

            $out[] = $result;
            $result_out = implode(',', $out);
        }

        // query for dahsboard kegiatan warga dan pesertanya
        $thisMonth = date('m');
        $lastMonth = $thisMonth - 3;
        $activity = Activity::whereMonth('created_at', '<=', $thisMonth)
            ->whereMonth('created_at', '>=', $lastMonth)
            ->get();

        $kegiatans = [];
        $pesertas  = [];

        foreach ($activity as $key => $value) {
            $kegiatans[] = '"' . $value->judul . '"';
            $pesertas[] = $value->peserta ?? 0;
        }

        $kegiatan = implode(',', $kegiatans);
        $peserta = implode(',', $pesertas);

        return view('dashboard.index', compact('result_in', 'result_out', 'kegiatan', 'peserta'));
    }
}

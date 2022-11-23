<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

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

        // echo json_decode($result_in);
        // die;



        return view('dashboard.index', compact('result_in', 'result_out'));
    }
}

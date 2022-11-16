<?php

use Carbon\Carbon;

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('tgl_status')) {
    function tgl_status($tgl)
    {
        if ($tgl < date('Y-m-d')) {
            $status = 'Selesai';
        } else {
            $status = 'Akan datang';
        }

        return $status;
    }
}

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('convertMdyToYmd')) {
    function convertMdyToYmd($date)
    {
        return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }
}

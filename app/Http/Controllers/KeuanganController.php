<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KeuanganExport;




class KeuanganController extends Controller
{

    public function fileExport()
    {
        return Excel::download(new KeuanganExport, 'users-collection.xlsx');
    }

    public function createPDF()
    {
        // retreive all records from db
        $data = Keuangan::all();
        $saldo_in = Keuangan::where('tipe', 'in')->sum('nominal');
        $saldo_out = Keuangan::where('tipe', 'out')->sum('nominal');
        $saldo = $saldo_in - $saldo_out;

        $pdf = PDF::loadView('keuangan.table-export', compact('data', 'saldo'));
        return $pdf->download('pdf_file.pdf');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $saldo_in = Keuangan::where('tipe', 'in')->sum('nominal');
        $saldo_out = Keuangan::where('tipe', 'out')->sum('nominal');
        $saldo = $saldo_in - $saldo_out;

        if (request()->ajax()) {

            $data = Keuangan::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-warning btn-sm" onclick="btn_edit(' . $row->id . ')">Edit</a> <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm btn_delete">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('keuangan.index', compact('saldo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'nominal' => 'required|numeric',
            'deskripsi' => 'required',
            'tanggal' => 'required',
        ]);

        if ($request->saldo == 'out') {
            $validated['tipe'] = 'out';
            $keterangan = 'Reduce';
        } else {
            $keterangan = 'Added';
        }

        Keuangan::create($validated);

        return redirect('/keuangan')->with('success', "Balance Successfully $keterangan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function show(Keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Keuangan $keuangan)
    {
        $keuangan = Keuangan::find($keuangan->id);
        return response()->json($keuangan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keuangan $keuangan)
    {
        $validated = $request->validate([
            'nominal' => 'required|numeric',
            'deskripsi' => 'required',
            'tanggal' => 'required',
        ]);


        Keuangan::where('id', $keuangan->id)
            ->update($validated);

        return redirect('/keuangan')->with('success', 'Balance Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keuangan $keuangan)
    {
        $keuangan = Keuangan::find($keuangan->id);
        $keuangan->delete();
    }
}

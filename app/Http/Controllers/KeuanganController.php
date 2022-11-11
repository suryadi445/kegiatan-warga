<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) {
            // $data = Keuangan::latest()->get();
            // return DataTables::of(Keuangan::query())->toJson();


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

        return view('keuangan.index');
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

        Keuangan::create($validated);

        return redirect('/keuangan')->with('success', 'Balance Successfully Added');
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

        return redirect('/keuangan')->with('success', 'Balance Successfully Added');
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

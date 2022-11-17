<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Activity::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-warning btn-sm d-block" onclick="btn_edit(' . $row->id . ')">Edit</a> <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm d-block mt-2 btn_delete">Delete</a>';
                    return $actionBtn;
                })
                ->editColumn('tgl_status', function ($row) {
                    $span = '<span class="badge text-bg-primary">' . tgl_status($row->tgl) . '</span>';
                    return $span;
                })
                ->rawColumns(['action', 'tgl_status'])
                ->make(true);
        }
        return view('activity.index');
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
            'tgl' => 'required',
            'time' => 'required',
            'tuan_rumah' => 'required',
            'judul' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
        ]);

        Activity::create($validated);

        return redirect('/activity')->with('success', "Activity Successfully Added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $data = Activity::find($activity->id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'peserta' => 'numeric',
            'tgl' => 'required|date',
            'time' => 'required',
            'tuan_rumah' => 'required',
            'judul' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
        ]);

        Activity::where('id', $activity->id)
            ->update($validated);

        return redirect('/activity')->with('success', "Activity Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity = Activity::find($activity->id);
        $activity->delete();
    }
}

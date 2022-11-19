<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $structure = Structure::all();

        return view('structure.index', compact('structure'));
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
            'foto' => 'mimes:jpg,png,jpeg|max:2048',
            'nama' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'no_hp' => 'required',
        ]);

        if ($validated) {
            $file       = $request->file('foto');
            if ($file) {
                $name       = $file->getClientOriginalName();
                $fileName   = time() . $name . '.' . $request->foto->extension();
                $foto      = '\images/uploads/' . $fileName;
                $request->foto->move(public_path('images\uploads'), $fileName);
            }

            $insert = Structure::create([
                'foto' => $foto ?? '',
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'jabatan' => $request->jabatan,
                'no_hp' => $request->no_hp,
            ]);
        }


        if ($insert) {
            return redirect()->back()->with('success', 'Profile Successfully Added');
        } else {
            return redirect()->back()->with('failed', 'Profile Failed To Add');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function show(Structure $structure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function edit(Structure $structure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Structure $structure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Structure $structure)
    {
        //
    }
}

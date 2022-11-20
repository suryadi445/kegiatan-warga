<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan_warga = Activity::all();
        $gallery = Gallery::all();
        return view('gallery.index', compact('kegiatan_warga', 'gallery'));
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
        $request->validate([
            'image' => 'required',
            'image.*' => 'mimes:jpg,png,jpeg|max:2048'
        ]);

        $files = [];
        $insert = [];

        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {
                $name = time() . $file->getClientOriginalName() . '.' . $file->extension();
                if ($file->move(public_path('images\uploads'), $name)) {
                    $files[] = $name;
                    $insert = Gallery::create([
                        "image" => '\images/uploads/' . $name,
                        "id_kegiatan_warga" => $request->id_kegiatan_warga
                    ]);
                }
            }
        }

        if ($insert) {
            return back()->with('success', 'Success! file uploaded');
        } else {
            return back()->with('failed', 'Alert! file not uploaded');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}

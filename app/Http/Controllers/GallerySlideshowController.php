<?php

namespace App\Http\Controllers;

use App\Models\GallerySlideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class GallerySlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = GallerySlideshow::all();
        return view('gallery_slideshow.index', compact('gallery'));
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
                    $insert = GallerySlideshow::create([
                        "image" => '\images/uploads/' . $name,
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
     * @param  \App\Models\GallerySlideshow  $gallerySlideshow
     * @return \Illuminate\Http\Response
     */
    public function show(GallerySlideshow $gallerySlideshow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GallerySlideshow  $gallerySlideshow
     * @return \Illuminate\Http\Response
     */
    public function edit(GallerySlideshow $gallerySlideshow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GallerySlideshow  $gallerySlideshow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GallerySlideshow $gallerySlideshow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GallerySlideshow  $gallerySlideshow
     * @return \Illuminate\Http\Response
     */
    public function destroy(GallerySlideshow $gallerySlideshow)
    {
        $gallerySlideshow = GallerySlideshow::find($gallerySlideshow->id);
        $gallerySlideshow->delete();

        Session::flash('success', 'Images Successfully Deleted');
    }
}

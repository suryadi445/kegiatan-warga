<?php

namespace App\Http\Controllers;

use App\Models\Identity;
use Illuminate\Http\Request;

class IdentityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $identity = Identity::find(1);
        return view('identity.index', compact('identity'));
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

        $identity = Identity::where('id', 1)->get();

        if ($identity) {
            $update = Identity::where('id', 1)
                ->update([
                    'logo' => $request->logo,
                    'nama_profile' => $request->nama_profile,
                    'alamat' => $request->alamat,
                    'telepon' => $request->telepon,
                    'whatsapp' => $request->whatsapp,
                    'slogan' => $request->slogan,
                ]);
        } else {
            $insert = Identity::create([
                'logo' => $request->logo,
                'nama_profile' => $request->nama_profile,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'whatsapp' => $request->whatsapp,
                'slogan' => $request->slogan,
            ]);
        }

        return redirect('/identity')->with('success', 'Profile Successfully Change');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Identity  $identity
     * @return \Illuminate\Http\Response
     */
    public function show(Identity $identity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Identity  $identity
     * @return \Illuminate\Http\Response
     */
    public function edit(Identity $identity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Identity  $identity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Identity $identity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Identity  $identity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Identity $identity)
    {
        //
    }
}

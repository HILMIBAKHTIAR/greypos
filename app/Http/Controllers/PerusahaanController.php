<?php

namespace App\Http\Controllers;

use App\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Perusahaan::all();
        return view('perusahaan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required',
            'pic' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'kota' => 'required'
        ]);

        $perusahaan = Perusahaan::create([
            'nama' => $request->nama,
            'pic' => $request->pic,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'kota' => $request->kota
        ]);

        $perusahaan->save();
        return redirect()->route('perusahaan.index')->with('message', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $perusahaan = Perusahaan::find($id);
        return view('perusahaan.edit', compact('perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate(
            [
                'nama' => 'required',
                'pic' => 'required',
                'email' => 'required',
                'no_telp' => 'required',
                'alamat' => 'required',
                'kota' => 'required'
            ]
        );

        $perusahaan = Perusahaan::find($id);

        $perusahaan->nama = $request->nama;
        $perusahaan->pic = $request->pic;
        $perusahaan->email = $request->email;
        $perusahaan->no_telp = $request->no_telp;
        $perusahaan->alamat = $request->alamat;
        $perusahaan->kota = $request->kota;
        $perusahaan->save();
        return redirect()->route('perusahaan.index')->with('message', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $perusahaan = Perusahaan::find($id);
        $perusahaan->delete();
        return redirect()->route('perusahaan.index')->with('deleted', 'Data berhasil dihapus');
    }
}

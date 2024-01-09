<?php

namespace App\Http\Controllers;

use App\Lembur;
use App\User;
use Illuminate\Http\Request;

class LemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Lembur::all();
        $karyawan = User::all();
        return view('lembur.index', compact('data', 'karyawan'));
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
        //
        $request->validate([
            'karyawan_id' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'tanggal_lembur' => 'required',
            'hasil_lembur' => 'required'
        ]);

        $lembur = Lembur::create([
            'karyawan_id' => $request->karyawan_id,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tanggal_lembur' => $request->tanggal_lembur,
            'harsil_lembur' => $request->harsil_lembur
        ]);

        $lembur->save();

        return redirect('/lembur')->with('message', 'Data Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lembur  $lembur
     * @return \Illuminate\Http\Response
     */
    public function show(Lembur $lembur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lembur  $lembur
     * @return \Illuminate\Http\Response
     */
    public function edit(Lembur $lembur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lembur  $lembur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lembur $lembur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lembur  $lembur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lembur $lembur)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Bahan;
use App\BahanProduk;
use App\Produk;
use App\Kategori;
use App\Stock;
use Dotenv\Validator;
use Exception;
use finfo;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;
use Prophecy\Doubler\ClassPatch\ThrowablePatch;
use Throwable;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        $kategori = Kategori::all();
        $stock = Stock::all();
        return view('produk.index', compact('produk', 'kategori', 'stock'));
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
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            // 'stock_id' => 'required',
            'keterangan' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasSession()) {
            $input = $request->all();
            $stock_id = $request->stock_id;
            unset($input['bahan_qty']);
            unset($input['stock_id']);
            unset($input['_token']); // dihapus karena insertGetId tidak dapat menerima _token
            $input['photo'] = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('photo'), $input['photo']);
            try {
                $id = Produk::insertGetId($input);
                $data_bahan = [];
                foreach ($stock_id as $key => $value) {
                    array_push($data_bahan, [
                        'produk_id' => $id,
                        'stock_id' => $stock_id[$key],
                        'qty' => $request->bahan_qty[$key],
                    ]);
                }

                Bahan::insert($data_bahan);
            } catch (\Illuminate\Database\QueryException  $irr) {
                return redirect('/produk')->with('erorr', 'kesalah input silahkan hubungi tim developer');
            }
            return redirect('/produk')->with('message', 'Data berhasil ditambahkan');
        }

        return response()->json(['error' => $request->errors()->all()]);
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
        $produk = Produk::find($id);
        $kategori = Kategori::all();
        return view('produk.edit', compact('produk', 'kategori'));
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
        $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
        ]);

        $produk = Produk::find($id);

        $produk->nama_produk = $request->get('kode_produk');
        $produk->nama_produk = $request->get('nama_produk');
        $produk->kategori_id = $request->get('kategori_id');
        $produk->harga = $request->get('harga');
        $produk->keterangan = $request->get('keterangan');
        $produk->save();

        return redirect('/produk')->with('message', 'Data berhasil diubah');
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
        $data_produk = Produk::findOrFail($id);
        $data_produk->delete();
        return redirect('/produk')->with('status', 'Data produk berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Acces;
use Barryvdh\DomPDF\Facade\PDF;
use Session;
use App\Access;
use App\Activity;
use App\DetailTransaksi;
use App\Produk;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class TransactionManageController extends Controller
{
    //fungsi menampilkan halaman transaksi
    public function viewTransaction()
    {
        //
        $id_account = Auth::id();
        $data_produk = Produk::all();
        $check_access = Acces::where('user', $id_account)->first();
        // $check_access = Access::where('id_user', $id_account)->first();
        if ($check_access->transaksi == 1) {
            $data_produk = Produk::all();
            return view('transaction.index', compact('data_produk'));
        } else {
            return back();
        }
    }

    // Take Transaction Product 
    public function transactionProduct($id)
    {
        $data_produk = Produk::all();
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
            ->first();
        if ($check_access->transaksi == 1) {
            $product = Product::where('kode_barang', '=', $id)
                ->first();
            return response()->json([
                'nama_produk' => $data_produk->nama_produk,
            ]);
        } else {
            return back();
        }
    }


    //fungsi proses transaksi

    public function prosesTransaction(Request $req)
    {
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
            ->first();
    }

    // fungsi proses transaksi
    public function transactionProcess(Request $req)
    {
        //
        // return json_encode($req->all());
        $id_account = Auth::id();
        $check_access = Acces::where('user', $id_account)
            ->first();
        if ($check_access->transaksi == 1) {
            // $jml_produk = count($req->kode_produk);

            if ((int)$req->bayar < (int)$req->total) {
                return json_encode([
                    'type' => 'warning',
                    'message' => 'Pembayaran kurang',
                    'data' => [],
                ]);
            }
            $transaction = [
                'kode_transaksi' => $req->kode_transaksi,
                'total_produk' => $req->total_produk,
                'subtotal' => $req->subtotal,
                'diskon' => $req->diskon ?? 0,
                'total' => $req->total,
                'bayar' => $req->bayar,
                'pembeli' => $req->pembeli,
                'no_meja' => $req->no_meja,
                'kembali' => $req->bayar - $req->total,
                'id_kasir' => Auth::id(),
                'kasir' => Auth::user()->name,
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()

            ];
            $id_transaction = Transaction::insertGetId($transaction);
            $detail_transaksi = [];
            foreach ($req->list_pesanan as $key => $value) {
                array_push($detail_transaksi, [
                    'produk_id' => $value['id'],
                    'transaction_id' => $id_transaction,
                    'jumlah' => $value['jumlah_produk'],
                    'harga' => $value['harga_produk'],
                    'total_harga' => $value['jumlah_produk'] * $value['harga_produk'],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            DetailTransaksi::insert($detail_transaksi);
            $transaction['list_pesanan'] = $detail_transaksi;
            return json_encode([
                'type' => 'success',
                'message' => 'Transaksi berhasil dilakukan',
                'data' => $transaction,
            ]);
        } else {
            return json_encode([
                'type' => 'error',
                'message' => 'Anda tidak memiliki akses untuk melakukan transaksi',
                'data' => [],
            ]);
        }
    }

    //fungsi cetak struk transaksi
    public function receiptTransaction()
    {
        return view('transaction.receipt_transaction');
    }
}

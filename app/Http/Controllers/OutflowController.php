<?php

namespace App\Http\Controllers;

use App\Outflow;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutflowController extends Controller
{
    //

    public function viewOutflow()
    {
        $data_outflow = Outflow::all();
        $data_outflow = DB::table('outflows')->latest()->paginate(10);
        return view('outflow.index_outflow', ['outflows' => $data_outflow], compact('data_outflow'));
    }

    public function storeOutflow(Request $request)
    {

        $this->validate($request, [
            'tanggal_pembelian' => 'required',
            'keterangan' => 'required',
            'jumlah_pembelian' => 'required',
            'invoice'=>'required'
        ]);

        $data_outflow = new Outflow();
        $data_outflow['invoice'] = time() . '.' . $request->invoice->getClientOriginalExtension();
        $request->invoice->move(public_path('invoice'), $data_outflow['invoice']);
        $data_outflow->tanggal_pembelian           = $request->tanggal_pembelian;
        $data_outflow->keterangan                       = $request->keterangan;
        $data_outflow->jumlah_pembelian            = $request->jumlah_pembelian;
        $data_outflow->save();


        return redirect('/outflow')->with('message', 'Data berhasil ditambahkan');
    }

    //edit outflow
    public function edit($id)
    {
        $data_outflow = Outflow::find($id);
        return view('outflow.edit', compact('data_outflow'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'tanggal_pembelian' => 'required',
            'keterangan' => 'required',
            'jumlah_pembelian' => 'required',

        ]);

        $data_outflow = Outflow::find($id);
        $data_outflow->tanggal_pembelian = $request->get('tanggal_pembelian');
        $data_outflow->keterangan = $request->get('keterangan');
        $data_outflow->jumlah_pembelian = $request->get('jumlah_pembelian');
        $data_outflow->save();
        return redirect('/outflow')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $data_outflow = Outflow::findOrFail($id);
        $data_outflow->delete();

        return redirect('/outflow')->with('success', 'Data berhasil dihapus');
    }

    public function cetakOutflow()
    {
        return view('outflow.formcetak');
    }

    public function cetakoutflowrange($start_date, $end_date)
    {
        dd($start_date, $end_date);
        // $cetakotflow = Outflow::whereBetween('tanggal_pembelian', [$start_date, $end_date])->get();
        // return view('outflow.cetakoutflow', compact('cetakotflow'));

    }
}

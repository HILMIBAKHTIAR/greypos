@extends('layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/transaction/style.css') }}">
<style>
    /* .kd-transaction{
        background-color: grey;
        color: white;
        padding: 5px;
        border-radius: 5px;
        padding: 0.5rem 0.75rem;
        rounded: 0.25rem;
    } */

</style>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="min-height:85vh">  
                    <div class="card-body">
                        <div class="row">
                            @foreach ($data_produk as $produk)
                            <div style="width: 25%;" class="mb-2 shadow p-3">
                                <div class="productCard">
                                    <div class="view overlay">
                                        <img class="card-img-top gambar" src="{{ asset('photo/' . $produk->photo) }}"
                                            width="40px" height="130px" alt="Card image cap" style="cursor: pointer"
                                            onclick="this.closest('form').submit();return false;">
                                    </div>
                                    <div class="card-body" data-id="{{ $produk->id }}">
                                        <label class="card-text text-center font-weight-bold nama_produk"
                                            style="text-transform: capitalize;"
                                        >{{ $produk->nama_produk }}</label>
                                        <p 
                                            class="card-text text-center harga_produk"
                                            data-harga="{{ $produk->harga }}"
                                        >Rp.{{ number_format($produk->harga) }}</p>
                                        <button class="btn btn-primary tambah_data">tambah</button>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- @if ($message = Session::get('transaction_success')) --}}
            {{-- modal success --}}
            <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body bg-grey">
                            <div class="row">
                                <div class="col-12 text-center mb-4">
                                    <img src="{{ asset('assets/img/gif/successtr.gif') }}">
                                    <h4 class="transaction-success-text">Transaksi Berhasil</h4>
                                </div>
                                <div class="col-12">
                                    <table class="table-receipt">
                                        <tr>
                                            <td>
                                                <span class="d-block little-td">Kode Transaksi</span>
                                                <span class="d-block font-weight-bold" id="kdtransaksi" >T1020120102131</span>
                                            </td>
                                            <td>
                                                <span class="d-block little-td">Tanggal</span>
                                                <span
                                                    class="d-block font-weight-bold" id="tanggal">17 agustus 1945</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="d-block little-td">Kasir</span>
                                                <span class="d-block font-weight-bold" id="casir">hilmi</span>
                                            </td>
                                            <td>
                                                <span class="d-block little-td">Total</span>
                                                <span class="d-block font-weight-bold text-success" id="total_trk"></span>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table-summary mt-3">
                                        <tr>
                                            <td class="line-td" colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="little-td big-td" >Bayar</td>
                                            <td id="money">Rp 80.000</td>
                                        </tr>
                                        <tr>
                                            <td class="little-td big-td">Kembali</td>
                                            <td id="back">Rp.2000</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-close-modal" data-bs-dismiss="modal" onclick="document.location.reload()" >Tutup</button>
                            {{-- <a href="{{ route('transaction.cetak') }}" target="_blank"
                                class="btn btn-sm btn-cetak-pdf">Cetak Struk</a> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Transaction --}}
            {{-- @endif --}}
            <div class="col-md-4">
                <form method="POST" name="" id="transaction_form"
                    {{-- action="{{ route('transaction.process') }}"> --}}
                    @csrf
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <table class="table-payment-1">
                                        <tr class="kd-transaction">
                                            <td class="text-left">kode transaksi</td>
                                            <td class="text-right">T{{ date('dmYHis') }}</td>
                                            <input type="text" name="kode_transaksi" value="T{{ date('dmYHis') }}"
                                                hidden="">
                                        </tr>
                                        <tr>
                                            <td class="text-left">Tanggal</td>
                                            <td class="text-right">{{ date('d M Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Waktu</td>
                                            <td class="text-right">{{ date('H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Kasir</td>
                                            <td class="text-right">{{ Auth::user()->name }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-start align-items-center gap-2">
                                    <box-icon name='plus'></box-icon>
                                    <p class="m-0 text-black-50">Daftar Pesanan</p>
                                </div>
                                <div id="list-pesanan">
                                    <p id="default-view-pesanan" class="mt-3 mb-0 text-muted">Belum ada pesanan</p>
                                </div>

                                <!-- // template list produk pesanan untuk dimasukkan ke #list-pesanan -->
                                <div class="data-produk pb-2 my-3 border-bottom d-none">
                                    <div class="d-flex w-100 mb-1 align-items-center">
                                        <div class="flex-grow-1">
                                            <p class="fs-5 m-0"><b class="nama_produk">ice coffe</b></p>
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <button type="button" class="btn btn-success qty-plus p-0 lh-1">
                                                <box-icon name='plus'></box-icon>
                                            </button>
                                            <b class="jumlah_produk">2</b>
                                            <button type="button" class="btn btn-danger qty-min p-0 lh-1">
                                                <box-icon name='minus'></box-icon>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex w-100">
                                        <div class="flex-grow-1">
                                            <small class="harga_produk m-0"></small>
                                        </div>
                                        <div class="d-flex">
                                            <p class="fs-5 m-0"><b class="harga_total_produk"></b></p>
                                        </div>
                                    </div>
                                </div>

                                <div id="info-pembayaran" class="d-none">
                                    <!-- // diskon -->
                                    {{-- <div class="d-flex align-items-center mb-2">
                                        <div class="flex-grow-1">
                                            <p class="fs-5 m-0">Diskon</p>
                                            <a href="javascript:void(0)"><small>Ubah diskon</small></a>
                                        </div>
                                        <div class="">
                                            <p class="m-0 fs-3"><b>33%</b></p>
                                        </div>
                                    </div> --}}

                                    <!-- // subtotal -->
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <p class="fs-5 m-0">Subtotal</p>
                                            <small><span class="jumlah_pesanan_produk"></span> Menu</small>
                                        </div>
                                        <div class="">
                                            <p class="m-0 fs-3"><b class="subtotal">Rp. 36.000</b></p>
                                        </div>
                                    </div>

                                    <div class="input-group my-3">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="bayar" class="form-control"
                                            placeholder="Inputkan nominal uang">
                                    </div>
                                    <div class="alert alert-warning alert-dismissible d-none" id="alertbayar" role="alert">
                                        <span>
                                            {{-- untuk isi message --}}
                                        </span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>

                                    <button class="btn btn-primary w-100" id="bayar" type="button">Bayar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="content-backdrop fade"></div>
            </div>
            @endsection
            @section('script')
            <script src="{{ asset('plugins/js/quagga.min.js') }}"></script>
            <script src="{{ asset('js/transaction/script.js') }}"></script>
            <script type="text/javascript">
                function rupiah(val) {
                    let number = new Intl.NumberFormat('id-ID');
                    
                    return 'Rp' + number.format(val ?? 0);
                }
                function qty(_this, plus_or_minus) {
                    let id = $(_this).closest('.data-produk').data('id')
                    let data_produk = data.list_pesanan.filter(val => val.id == id)[0]
                    
                    if (plus_or_minus == 'plus') {
                        data_produk.jumlah_produk++
                    } else if (plus_or_minus == 'min') {
                        if (data_produk.jumlah_produk > 1) 
                            data_produk.jumlah_produk-- 
                        else
                            data.list_pesanan.splice(data.list_pesanan.indexOf(data_produk), 1)
                    }
                    
                    data.list_pesanan = [...data.list_pesanan]
                }

                function qtyPlusMinus() {
                    $('.qty-plus').unbind("click");
                    $('.qty-plus').on('click', function() {
                        qty(this, 'plus')
                    })
                    $('.qty-min').on('click', function() {
                        qty(this, 'min')
                    })
                }
                
                let default_view_pesanan_element = $('#default-view-pesanan').clone()
                let dynamic_data = {};
                let subtotal = 0
                let data = new Proxy(dynamic_data, {
                    set: function (target, key, value) {
                        target[key] = value;
                        if (dynamic_data.list_pesanan?.length) {
                            subtotal = 0; // perlu set default value agar subtotal bisa dihitung ulang
                            let info_pembayaran = $('#info-pembayaran')

                            $('#list-pesanan').html('')
                            $('#info-pembayaran').removeClass('d-none')

                            dynamic_data.list_pesanan.map(val => {
                                let produk_element = $('.data-produk.d-none').clone().removeClass('d-none');
                                let total_harga = val.harga_produk * val.jumlah_produk;
                                for (let produk in val) {
                                    produk_element.find(`.${produk}`).text(produk == 'harga_produk' ? rupiah(val[produk]) : val[produk])
                                }
                                produk_element.find('.harga_total_produk').text(rupiah(total_harga))
                                produk_element.appendTo('#list-pesanan')
                                produk_element.data('id', val.id)
                                
                                subtotal += total_harga
                            })

                            info_pembayaran.find('.subtotal').text(rupiah(subtotal))
                            info_pembayaran.find('.jumlah_pesanan_produk').text(dynamic_data.list_pesanan.length)

                            qtyPlusMinus()
                        } else {
                            $('#list-pesanan').html('')
                            default_view_pesanan_element.appendTo($('#list-pesanan'))
                            $('#info-pembayaran').addClass('d-none')
                        }
                        return true;
                    }
                });

                
                data.list_pesanan = []
                $('.tambah_data').on('click', function () {
                    let card_body = $(this).closest('.card-body')
                    let data_produk = data.list_pesanan.filter(val => val.id == card_body.data('id'))[0]
                    if (data_produk) {
                        data_produk.jumlah_produk++
                        data.list_pesanan = [...data.list_pesanan] // refresh data agar yg di view berubah
                    } else {
                        let produk = {
                            id: card_body.data('id'),
                            nama_produk: card_body.find('.nama_produk').text(),
                            harga_produk: card_body.find('.harga_produk').data('harga'),
                            jumlah_produk: 1,
                        }
                        let list_pesanan = data.list_pesanan
                        data.list_pesanan = [...list_pesanan, produk]
                    }
                })


                $('#bayar').on('click', function () {
                    
                    let data_transaksi = {}
                    $('#transaction_form').serializeArray().forEach((val, i) => {
                        data_transaksi[val.name] = val.value
                    });
                    let body_data = {
                        ...data,
                        ...data_transaksi,
                        total_produk: data.list_pesanan.length,
                        subtotal: subtotal,
                        total: subtotal,
                    }

                    $.ajax({
                    type : 'POST',
                    url : "{{ route('transaction.process') }}",
                    data : body_data,
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    },
                    dataType : 'json',
                    success : function(response) {
                        console.log(response)
                        if(response.type == 'success') {
                            $('#successModal').modal('show')
                            $('#successModal').find('#kdtransaksi').text(response.data.kode_transaksi)
                            $('#successModal').find('#tanggal').text(response.data.created_at)
                            $('#successModal').find('#casir').text(response.data.kasir)
                            $('#successModal').find('#total_trk').text(rupiah(response.data.total))
                            $('#successModal').find('#money').text(rupiah(response.data.bayar))
                            $('#successModal').find('#back').text(rupiah(response.data.kembali))
                        } else if (response.type == 'warning') {
                            
                            let alertbayar = $('#alertbayar')
                            alertbayar.removeClass('d-none')
                            alertbayar.find('span').text(response.message)
                        }
                    }
                }); 
                })
            </script>
            @endsection

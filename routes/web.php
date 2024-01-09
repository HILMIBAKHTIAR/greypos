<?php

use App\Http\Controllers\LemburController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['midleware' => 'auth', 'checkRole:admin,kasir'], function () {
    Route::resource('/kategori', 'KategoriController');
    Route::resource('/perusahaan', 'PerusahaanController');
    Route::resource('/lembur', 'LemburController');
    //kelola supplier
    Route::get('/supplier', 'SupplierController@index')->name('supplier')->middleware('checkRole:admin');
    Route::get('/supplier/create', 'SupplierController@create')->name('supplier.create');
    Route::post('/supplier/store', 'SupplierController@store')->name('supplier.store');
    Route::get('/supplier/{id}/edit', 'SupplierController@edit')->name('supplier.edit');
    Route::patch('/supplier/{data_supplier}', 'SupplierController@update')->name('supplier.update');
    Route::delete('/supplier/{id}/destroy', 'SupplierController@destroy')->name('supplier.destroy');


    //kelola produk
    Route::get('/produk', 'ProdukController@index')->name('produk')->middleware('checkRole:admin');
    Route::get('/produk/edit/{id}', 'ProdukController@edit')->name('produk.edit');
    Route::post('/produk/store', 'ProdukController@store')->name('produk.store');
    Route::patch('/produk/{produk}', 'ProdukController@update')->name('produk.update');
    Route::delete('/produk/destroy/{id}', 'ProdukController@destroy')->name('produk.destroy');


    // transaksi
    Route::get('/transaction', 'TransactionManageController@index')->name('transaction')->middleware('checkRole:admin');
    Route::post('/transaction/process', 'TransactionManageController@transactionProcess')->name('transaction.process');
    Route::get('/transaction/receiptTransaction', 'TransactionManageController@receiptTransaction')->name('transaction.cetak');


    //Kelola User
    Route::get('/user', 'UserManageController@viewAccount')->name('user')->middleware('checkRole:admin');
    Route::post('/user/create', 'UserManageController@createAccount')->name('user.create');
    Route::delete('/user/delete/{id}', 'UserManageController@deleteAccount')->name('user.delete');
    Route::get('/user/edit/{id}', 'UserManageController@editAccount')->name('user.edit');
    Route::patch('/user/{user}', 'UserManageController@update')->name('user.update');
    Route::get('/account/filter/{id}', 'UserManageController@filterTable');

    // Kelola Report Income
    Route::get('/report', 'ReportManageController@viewReport')->name('report')->middleware('checkRole:admin');

    //kelola Outflow
    Route::get('/outflow', 'OutflowController@viewOutflow')->name('outflow');
    Route::get('/outflowcetakview', 'OutflowController@cetakOutflow')->name('outflowcetakview');
    Route::post('/outflow/storeOutflow', 'OutflowController@storeOutflow')->name('outflow.store');
    Route::delete('/outflow/destroy/{id}', 'OutflowController@destroy')->name('outflow.delete');
    Route::get('/outflow/edit/{id}', 'OutflowController@edit')->name('outflow.edit');
    Route::patch('/outflow/{data_outflow}', 'OutflowController@update')->name('outflow.update')->middleware('auth');
    Route::get('/outflow/cetakoutflowrange/{tglawal}/{tglakhir}', 'OutflowController@cetakoutflowrange')->name('cetakoutflow');

    //kelola stock
    Route::get('/stock', 'StockManageController@viewStock')->name('stock');
    Route::get('/stock/edit/{id}', 'StockManageController@edit')->name('stock.edit');
    Route::post('/stock/addstock', 'StockManageController@addstock')->name(('stock.store'));
    Route::patch('/stock/{data_stock}', 'StockManageController@updateStock')->name('stock.update');
    Route::get('/stock/delete/{id}', 'StockManageController@destroy')->name('stock.delete');

    //kelola lembur
    Route::get('/lembur', 'LemburController@index')->name('lembur');
});

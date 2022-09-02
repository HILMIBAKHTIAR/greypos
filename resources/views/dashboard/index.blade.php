@extends('layout.master')

@section('content')
<div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <p class="font-weight-bold"> <strong>Jumlah Customer/Hari</strong></p>
                      </div>
                      <div class="row">
                        <p>{{ $customers_daily }} Orang</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <p class="font-weight-bold"><strong>Pemasukan Harian</strong></p>
                      </div>
                      <div class="row">
                        <p>Rp {{ number_format($incomes_daily,2,',','.') }}</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <p class="font-weight-bold"><strong>Pemasukan Bulan Ini</strong></p>
                      </div>
                      <div class="row">
                        <p>Rp {{ number_format($all_incomes,2,',','.') }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection
@extends('layout.master')

@section('content')

<style>
    .btn-kasir {
      color: #ffaf00;
      background-color: rgba(255, 175, 0, 0.2);
      font-weight: bold;
      font-size: 0.875rem;
      line-height: 1;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      border: 1px solid transparent;
      border-radius: 0.25rem;
      padding: 0.5rem 0.75rem;
    }
    .btn-admin {
      color: #ff6258;
      background-color: rgba(255, 98, 88, 0.2);
      font-weight: bold;
      font-size: 0.875rem;
      line-height: 1;
      font-family: "roboto", sans-serif;
      border: 1px solid transparent;
      border-radius: 0.25rem;
      padding: 0.5rem 0.75rem;
  
    }
  </style>
  
  <div class="content-wrapper">
    <!-- Content -->
    
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mt-2">
            <div class="col-md-12 justify-content-center">
                <div class="card">
                    <h5 class="card-header text-bold">History Penjualan</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th>Kode Transaksi</th>
                            <th>Total</th>
                            <th>Bayar</th>
                            <th>Kembali</th>
                            <th>tanggal</th>
                            <th>Pembeli</th>
                            <th>Kasir</th>
                            {{-- <th>Actions</th> --}}
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($data_report as $i=>$row)
                          <tr>
                            <td>{{ $data_report->firstItem() + $i }}</td>
                            <td>{{ $row->kode_transaksi }}</td>
                            <td>{{ $row->total }}</td>
                            <td>{{ $row->bayar }}</td>
                            <td>{{ $row->kembali }}</td>
                            <td>{{ date('d M Y h:i', strtotime($row->created_at))}}</td>
                            <td>{{ $row->pembeli }} meja {{ $row->no_meja }}</td>
                            <td>
                                @if($row->kasir == 'admin')
                                    <button type="button" class="btn btn-admin">{{ $row->kasir }}</button>

                                @else
                                    <button type="button" class="btn btn-kasir">{{ $row->kasir }}</button>
                                @endif
                            </td>
                            {{-- <td><a href="#" class="btn btn-success">detail</a></td> --}}
                          </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-center mt-2 ml-1">
                        show
                        {{ $data_report->firstItem() }}
                        of
                        {{ $data_report->lastItem() }}
                        of
                        {{ $data_report->total() }}
                        entries
                      </div>                      
                        <div class="d-flex justify-content-end">
                          {{ $data_report->links() }}
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    @endsection
    
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

const labels = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
];
const data = {
  labels: labels,
  datasets: [{
    label: 'My First dataset',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: [0, 10, 5, 2, 20, 30, 45],
  }]
};
      const config = {
        type: 'line',
        data: data,
        options: {}
      };

      const myChart = new Chart(
          document.getElementById('myChart'),
          config
        );

    </script>
@endpush
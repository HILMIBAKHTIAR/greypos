@extends('layout.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->

    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif

    <div class="card">
        <h5 class="card-header">Data Pengeluaran</h5>
        <div class="card-body">
            <div class="row input-daterange">
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalcreate">
                        Input Pengeluaran
                    </button>
                </div>

                @include('outflow.create')
                <div class="table-responsive text-nowrap">
                    <table class="table" id="order_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Pembelian</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>invoice</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($data_outflow as $i=>$row)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ date('d M Y', strtotime($row->tanggal_pembelian)) }}</td>
                                <td>{{ $row->keterangan }}</td>
                                <td>Rp.{{ $row->jumlah_pembelian }}</td>
                                <td ><img class="rounded float-start" src="{{ asset('invoice/' . $row->invoice) }}" width="80px" height="80px"></td>
                                <td>
                                    <form action="{{ route('outflow.delete', $row->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('outflow.edit', $row->id) }}" class="btn btn-success">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $data_outflow->links() }}
                    </div>
                    {{-- {{ $data_outflow->links() }} --}}
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
            <!--/ Responsive Table -->
        </div>
        @endsection


        {{-- @push('scripts') --}}
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script> --}}

        {{-- <script>
    $(document).ready(function(){
     $('.input-daterange').datepicker({
      todayBtn:'linked',
      format:'yyyy-mm-dd',
      autoclose:true
     });
    
     load_data();
    
     function load_data(from_date = '', to_date = '')
     {
      $('#order_table').DataTable({
       processing: true,
       serverSide: true,
       ajax: {
        url:'{{ route("outflow") }}',
        data:{from_date:from_date, to_date:to_date}
        },
        columns: [
        {
        data:'order_id',
        name:'order_id'
        },
        {
        data:'order_customer_name',
        name:'order_customer_name'
        },
        {
        data:'order_item',
        name:'order_item'
        },
        {
        data:'order_value',
        name:'order_value'
        },
        {
        data:'order_date',
        name:'order_date'
        }
        ]
        });
        }

        $('#filter').click(function(){
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if(from_date != '' && to_date != '')
        {
        $('#order_table').DataTable().destroy();
        load_data(from_date, to_date);
        }
        else
        {
        alert('Both Date is required');
        }
        });

        $('#refresh').click(function(){
        $('#from_date').val('');
        $('#to_date').val('');
        $('#order_table').DataTable().destroy();
        load_data();
        });

        });
        </script> --}}
        {{-- @endpush --}}

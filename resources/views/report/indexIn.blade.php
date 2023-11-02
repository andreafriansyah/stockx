@extends('adminlte.layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Report</a></li>
              <li class="breadcrumb-item active">Transaksi Masuk</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            @if ($message = Session::get('errors'))
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Transaksi Masuk</div>
                <div class="card-body">
                    <form method="GET" action="{{ route('reportMasuk') }}" class="form-inline mb-4">
                        <div class="form-group mr-2">
                            <label for="name">Nama Barang : </label>
                            <select name="id_barang" class="form-control" id="list-barang">
                                <option value="">-- Pilih Barang --</option>
                                @forelse($barang as $br)
                                    <option value="{{ $br->id }}">{{ $br->nama }} -
                                        {{ $br->kode_barang }}</option>
                                @empty
                                    <option>Tidak ada data Barang</option>
                                @endforelse
                            </select>
                        </div>
                    
                        <div class="form-group mr-2">
                            <label for="start_date">Tanggal Mulai : </label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                    
                        <div class="form-group mr-2">
                            <label for="end_date">Tanggal Selesai : </label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                    <table class="table table-striped table-bordered">
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <thead>
                            <tr>
                                <th width="5%" class="text-center" scope="col">No</th>
                                <th width="10%" class="text-center" scope="col">Kode Barang</th>
                                <th width="15%" class="text-center" scope="col">Nama Barang </th>
                                <th width="15%" class="text-center" scope="col">Harga Modal</th>
                                <th width="15%" class="text-center" scope="col">Harga Jual</th>
                                <th width="15%" class="text-center" scope="col">Jumlah Stock</th>
                                <th width="15%" class="text-center" scope="col">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksi as $trx)
                                <tr>
                                    <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ $trx->barang->kode_barang }}</td>
                                    <td class="text-center">{{ $trx->barang->nama }}</td>
                                    <td class="text-center">{{ $trx->harga_modal_new }}</td>
                                    <td class="text-center">{{ $trx->harga_jual_new  }}</td>
                                    <td class="text-center">{{ $trx->jumlah }}</td>
                                    <td class="text-center">{{ $trx->tanggal }}</td>
                                </tr>
                            @empty
                                <td colspan="7">
                                    <span class="text-danger">
                                        <strong>No Data Found!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $transaksi->links() }}

                </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

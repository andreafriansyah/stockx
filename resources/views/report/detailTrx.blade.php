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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('transaksiKeluar') }}">Report</a></li>
                            <li class="breadcrumb-item active">Detail Report Transaksi</li>
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
                        <div class="card">
                            <div class="card-header">Detail Report Transaksi</div>
                            <div class="card-body">
                                <form action="{{ route('storeBarang') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div style="text-align: center;">
                                        <img src="{{ $barang->foto }}" id="imagePreview" src="#" alt="Image Preview"
                                            style="max-width: 400px; max-height: 400px;">
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6 col-lg-6">
                                            <label for="kode_barang" class="col-form-label text-md-end text-start">Kode
                                                Barang</label>
                                            <input type="text"
                                                class="form-control @error('kode_barang') is-invalid @enderror"
                                                id="kode_barang" name="kode_barang" value="{{ $barang->kode_barang }}"
                                                readonly>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label for="nama"
                                                class="col-md-4 col-form-label text-md-end text-start">Nama
                                                Barang</label>
                                            <input type="text" class="form-control"
                                                id="nama" name="nama" value="{{ $barang->nama }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6 col-lg-6">
                                            <label for="kode_barang" class="col-form-label text-md-end text-start">Jumlah Barang Keluar</label>
                                            <input type="text"
                                                class="form-control @error('kode_barang') is-invalid @enderror"
                                                id="kode_barang" name="kode_barang" value="{{ $barang->total_barang }}"
                                                readonly>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label for="nama"
                                                class="col-md-4 col-form-label text-md-end text-start">Total Keuntungan</label>
                                            <input type="text" class="form-control"
                                                id="nama" name="nama" value="{{ $barang->profit }}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="card-header">List Transaksi</div>
                                    <table class="table table-striped table-bordered">
                                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center" scope="col">No</th>
                                                <th width="10%" class="text-center" scope="col">Kode Barang</th>
                                                <th width="15%" class="text-center" scope="col"> Nama Barang </a></th>
                                                <th width="15%" class="text-center" scope="col">Harga Modal</th>
                                                <th width="15%" class="text-center" scope="col">Harga Jual</th>
                                                <th width="15%" class="text-center" scope="col">Jumlah Stock</th>
                                                <th width="15%" class="text-center" scope="col">Tanggal</th>
                                                <th width="15%" class="text-center" scope="col">Keuntungan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transaksi as $trx)
                                                <tr>
                                                    <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                                    <td class="text-center">{{ $trx->barang->kode_barang }}</td>
                                                    <td class="text-center"><a href="{{ route('detailReport', $trx->barang->id) }}"> {{ $trx->barang->nama }} </a></td>
                                                    <td class="text-center">{{ $trx->harga_modal_new }}</td>
                                                    <td class="text-center">{{ $trx->harga_jual_new  }}</td>
                                                    <td class="text-center">{{ $trx->jumlah }}</td>
                                                    <td class="text-center">{{ $trx->tanggal }}</td>
                                                    <td class="text-center">{{ $trx->keuntungan }}</td>
                                                </tr>
                                            @empty
                                                <td colspan="8">
                                                    <span class="text-danger">
                                                        <strong>No Data Found!</strong>
                                                    </span>
                                                </td>
                                            @endforelse
                                        </tbody>
                                    </table>
                
                                    {{ $transaksi->links() }}

                                    <div class="mb-3">
                                        <a href="{{ route('reportKeluar') }}" class="col-md-2 offset-md-5 btn btn-danger"> Back </a>
                                    </div>
                                </form>
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

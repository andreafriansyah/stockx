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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Barang</a></li>
                            <li class="breadcrumb-item active">Tambah Barang</li>
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
                            <div class="card-header">Tambah Barang</div>
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
                                        <div class="col-md-6">
                                            <label for="harga_modal" class="col-form-label text-md-end text-start">Harga Modal</label>
                                            <input type="text" class="form-control"
                                                id="harga_modal" value="{{ $barang->harga_modal_new }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="harga_jual" class="col-form-label text-md-end text-start">Harga Jual</label>
                                            <input type="text" class="form-control"
                                                id="harga_jual" value="{{ $barang->harga_jual_new }}" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="jumlah" class="col-form-label text-md-end text-start">Jumlah
                                                Barang</label>
                                            <input type="number" class="form-control"
                                                id="jumlah" name="jumlah" value="{{ $barang->jumlah }}" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="detail" class="col-form-label text-md-end text-start">Detail
                                                Barang</label>
                                            <textarea class="form-control" id="detail" name="detail" readonly>{{ $barang->detail }}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <a href="{{ route('indexBarang') }}" class="col-md-2 offset-md-5 btn btn-danger"> Back </a>
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

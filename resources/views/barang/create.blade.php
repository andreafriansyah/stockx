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
                                        <img src="{{ asset('assets/image/not-found.png') }}" id="imagePreview" src="#" alt="Image Preview"
                                            style="max-width: 400px; max-height: 400px;">
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6 col-lg-6">
                                            <label for="kode_barang" class="col-form-label text-md-end text-start">Kode
                                                Barang</label>
                                            <input type="text"
                                                class="form-control @error('kode_barang') is-invalid @enderror"
                                                id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}"
                                                required>
                                            @if ($errors->has('kode_barang'))
                                                <span class="text-danger">{{ $errors->first('kode_barang') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label for="nama"
                                                class="col-md-4 col-form-label text-md-end text-start">Nama
                                                Barang</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                id="nama" name="nama" value="{{ old('nama') }}" required>
                                            @if ($errors->has('nama'))
                                                <span class="text-danger">{{ $errors->first('nama') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="harga_modal" class="col-form-label text-md-end text-start">Harga Modal</label>
                                            <input type="text" class="form-control @error('harga_modal') is-invalid @enderror"
                                                id="harga_modal" value="{{ old('harga_modal') }}" onkeyup="hargaModalInput()" placeholder="Rp 0" required>
                                                <input type="hidden" name="harga_modal" id="hm_input">
                                            @if ($errors->has('harga_modal'))
                                                <span class="text-danger">{{ $errors->first('harga_modal') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label for="harga_jual" class="col-form-label text-md-end text-start">Harga Jual</label>
                                            <input type="text" class="form-control @error('harga_jual') is-invalid @enderror"
                                                id="harga_jual" value="{{ old('harga_jual') }}" onkeyup="hargaJualInput()" placeholder="Rp 0" required>
                                                <input type="hidden" name="harga_jual" id="hj_input">
                                            @if ($errors->has('harga_jual'))
                                                <span class="text-danger">{{ $errors->first('harga_jual') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="foto" class="col-form-label text-md-end text-start">Foto
                                                Barang</label>
                                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                                id="foto" name="foto" value="{{ old('foto') }}" required>
                                                <input type="hidden" class="form-control" id="image_path" name="image_path">
                                            @if ($errors->has('foto'))
                                                <span class="text-danger">{{ $errors->first('foto') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label for="jumlah" class="col-form-label text-md-end text-start">Jumlah
                                                Barang</label>
                                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                                id="jumlah" name="jumlah" value="{{ old('jumlah') }}" required>
                                            @if ($errors->has('jumlah'))
                                                <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="detail" class="col-form-label text-md-end text-start">Detail
                                                Barang</label>
                                            <textarea class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" required>{{ old('detail') }}</textarea>
                                            @if ($errors->has('detail'))
                                                <span class="text-danger">{{ $errors->first('detail') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-8 offset-md-4">
                                            <input type="submit" class="col-md-3 btn btn-primary" value="Simpan">
                                            <a href="{{ route('indexBarang') }}" class="col-md-2 btn btn-danger"> Back </a>
                                        </div>
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

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
                            <li class="breadcrumb-item active">Transaksi Keluar</li>
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
                            <div class="card-header">Transaksi Keluar</div>
                            <div class="card-body">
                                <form action="{{ route('storeTransaksi') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @if ($message = Session::get('errors'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endif
                                    <div style="text-align: center;">
                                        <img src="{{ asset('assets/image/not-found.png') }}" id="imagePreview"
                                            src="#" alt="Image Preview" style="max-width: 400px; max-height: 400px;">
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6 col-lg-6">
                                            <label for="nama"
                                                class="col-md-4 col-form-label text-md-end text-start">Nama
                                                Barang</label>
                                            <select name="id_barang" class="form-control" id="list-barang">
                                                <option>-- Pilih Barang --</option>
                                                @forelse($barang as $br)
                                                    <option value="{{ $br->id }}">{{ $br->nama }} -
                                                        {{ $br->kode_barang }}</option>
                                                @empty
                                                    <option>Tidak ada data Barang</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="jumlah" class="col-form-label text-md-end text-start">Jumlah
                                                Barang</label>
                                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                                id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="0"
                                                required>
                                            @if ($errors->has('jumlah'))
                                                <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="harga_modal" class="col-form-label text-md-end text-start">Harga
                                                Modal</label>
                                            <input type="text"
                                                class="form-control @error('harga_modal') is-invalid @enderror"
                                                id="harga_modal" value="{{ old('harga_modal') }}"
                                                onkeyup="hargaModalInput()" placeholder="Rp 0" readonly>
                                            <input type="hidden" name="harga_modal" id="hm_input">
                                            @if ($errors->has('harga_modal'))
                                                <span class="text-danger">{{ $errors->first('harga_modal') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label for="harga_jual" class="col-form-label text-md-end text-start">Harga
                                                Jual</label>
                                            <input type="text"
                                                class="form-control @error('harga_jual') is-invalid @enderror"
                                                id="harga_jual" value="{{ old('harga_jual') }}" onkeyup="hargaJualInput()"
                                                placeholder="Rp 0" readonly>
                                            <input type="hidden" name="harga_jual" id="hj_input">
                                            @if ($errors->has('harga_jual'))
                                                <span class="text-danger">{{ $errors->first('harga_jual') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-8 offset-md-4">
                                            <input type="hidden" name="type" value="keluar">
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

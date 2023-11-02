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
              <li class="breadcrumb-item active">Barang</li>
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
                <div class="card-header">List Barang</div>
                <div class="card-body">
                    <a href="{{ route('createBarang') }}" class="btn btn-success btn-sm my-2 mb-2"><i class="bi bi-plus-circle"></i>
                        + Tambah Barang</a>
                    <table class="table table-striped table-bordered">
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <thead>
                            <tr>
                                <th width="5%" class="text-center" scope="col">No</th>
                                <th width="10%" class="text-center" scope="col">Kode Barang</th>
                                <th width="15%" class="text-center" scope="col">Nama Barang</th>
                                <th width="15%" class="text-center" scope="col">Harga Modal</th>
                                <th width="15%" class="text-center" scope="col">Harga Jual</th>
                                <th width="15%" class="text-center" scope="col">Jumlah Stock</th>
                                <th width="15%" class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataBarang as $barang)
                                <tr>
                                    <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ $barang->kode_barang }}</td>
                                    <td class="text-center">{{ $barang->nama }}</td>
                                    <td class="text-center">{{ $barang->harga_modal_new }}</td>
                                    <td class="text-center">{{ $barang->harga_jual_new  }}</td>
                                    <td class="text-center">{{ $barang->jumlah }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('showBarang', $barang->id) }}" class="btn btn-warning btn-md"><i
                                                class="bi bi-eye"></i> Show</a>
                                        <a href="{{ route('editBarang', $barang->id) }}" class="btn btn-primary btn-md"><i
                                                class="bi bi-pencil-square"></i> Edit</a>
                                        <button class="btn btn-danger btn-md" id="delete-barang" onclick="deleteBarang({{$barang->id}})" data-id="{{ $barang->id }}"><i
                                                class="bi bi-trash"></i>Delete</button>
                                    </td>
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

                    {{ $dataBarang->links() }}

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

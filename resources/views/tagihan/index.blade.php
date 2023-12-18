@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Tagihan</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/home">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/tagihan">Tagihan</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Tagihan</h4>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="/tambah-tagihan" type="button" class="btn btn-sm btn-primary float-end">Tambah
                                        Tagihan</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_id" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tagihan</th>
                                            <th>Rincian</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tagihans as $tagihan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $tagihan->nm_tagihan }}</td>
                                                <td>
                                                    @foreach ($tagihan->biayas as $biaya)
                                                        <ul>
                                                            <li>
                                                                Rp.
                                                                {{ number_format($biaya->biaya, 2, ',', '.') }}
                                                                ({{ $biaya->jenis_pembayaran }})
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <form id="{{ $tagihan->id }}" action="/tagihan/{{ $tagihan->id }}"
                                                        method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger swal-confirm mb-2"
                                                            data-form="{{ $tagihan->id }}"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Datatables Jquery -->
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection

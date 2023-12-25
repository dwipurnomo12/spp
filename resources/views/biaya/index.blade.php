@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Jenis Pembayaran & Biaya</h4>
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
                        <a href="/biaya">Biaya</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Data Jenis Pembayaran & Biaya</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="/biaya/create" class="btn btn-sm btn-primary mb-2 float-right"><i
                                            class="fa fa-plus"></i> Tambah
                                        Biaya</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_id" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Pembayaran</th>
                                            <th>Biaya</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($biayas as $biaya)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $biaya->jenis_pembayaran }}</td>
                                                <td>Rp. {{ number_format($biaya->biaya, 2, ',', '.') }}</td>
                                                <td>
                                                    <a href="/biaya/{{ $biaya->id }}/edit"
                                                        class="btn btn-sm btn-warning mb-2"><i class="fa fa-edit"></i></a>

                                                    <form id="{{ $biaya->id }}" action="/biaya/{{ $biaya->id }}"
                                                        method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger swal-confirm mb-2"
                                                            data-form="{{ $biaya->id }}"><i
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

@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pengeluaran</h4>
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
                        <a href="/pengeluaran">Pengeluaran</a>
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
                                    <h4 class="card-title">Data Pengeluaran</h4>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="/pengeluaran/create" type="button"
                                        class="btn btn-sm btn-primary float-end">Tambah
                                        Pengeluaran</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table id="table_id" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nominal</th>
                                                    <th>Aliran Dana</th>
                                                    <th>Keterangan</th>
                                                    <th>Waktu</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kasKeluars as $history)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>Rp. {{ number_format($history->nominal, 2) }}</td>
                                                        <td>{{ $history->status }}</td>
                                                        <td>{{ $history->keterangan }}</td>
                                                        <td>{{ $history->created_at }}</td>
                                                        <td>
                                                            <form id="{{ $history->id }}"
                                                                action="/pengeluaran/{{ $history->id }}" method="POST"
                                                                class="d-inline mt-2">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger swal-confirm "
                                                                    data-form="{{ $history->id }}"><i
                                                                        class="fa fa-trash"></i> Batalkan</button>

                                                            </form>
                                                            <a href="/pengeluaran/buktu-pengeluaran/{{ $history->id }}"
                                                                class="btn btn-sm btn-success">
                                                                <i class="fa fa-reguler fa-file-pdf"></i>
                                                                Print
                                                            </a>
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
        </div>

        <!-- Datatables Jquery -->
        <script>
            $(document).ready(function() {
                $('#table_id').DataTable();
            });
        </script>
    @endsection

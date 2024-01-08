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
                                                    <th>Reference</th>
                                                    <th>Merchant Ref</th>
                                                    <th>Nominal</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayatPembayarans as $riwayatPembayaran)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $riwayatPembayaran->reference }}</td>
                                                        <td>{{ $riwayatPembayaran->merchant_ref }}</td>
                                                        <td>{{ $riwayatPembayaran->total_amount }}</td>
                                                        <td>
                                                            @if ($riwayatPembayaran->status == 'unpaid')
                                                                <span
                                                                    class="badge badge-danger">{{ $riwayatPembayaran->status }}</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-success">{{ $riwayatPembayaran->status }}</span>
                                                            @endif
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

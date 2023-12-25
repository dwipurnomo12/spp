@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Tabungan</h4>
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
                        <a href="/tabungan">Saldo Tabungan</a>
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
                                <div class="col">
                                    <h4 class="card-title">Saldo Saat Ini</h4>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <div class="card-title">Saldo Tabungan Anda</div>
                                        </div>
                                        <div class="card-body pb-0">
                                            <div class="mb-4 mt-2">
                                                <h1>Rp. {{ number_format($tabungan->tabungan, 2) }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <div class="card-title">Setoran Masuk</div>
                                        </div>
                                        <div class="card-body pb-0">
                                            <div class="mb-4 mt-2">
                                                <h1>Rp.
                                                    {{ number_format($tabungan->tabunganHistories->where('status', 'setor')->sum('nominal'), 2) }}
                                                </h1>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <div class="card-title">Penarikan</div>
                                        </div>
                                        <div class="card-body pb-0">
                                            <div class="mb-4 mt-2">
                                                <h1>Rp.
                                                    {{ number_format($tabungan->tabunganHistories->where('status', 'penarikan')->sum('nominal'), 2) }}
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table id="table_id" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nominal</th>
                                                    <th>Aliran Dana</th>
                                                    <th>Waktu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tabungan->tabunganHistories as $history)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>Rp. {{ number_format($history->nominal, 2) }}</td>
                                                        <td>{{ $history->status }}</td>
                                                        <td>{{ $history->created_at }}</td>
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

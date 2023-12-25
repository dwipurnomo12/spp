@extends('layouts.main')
@include('penarikan.menu-penarikan')
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
                        <a href="/penarikan">Penarikan / Pencairan Dana</a>
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
                    @if (session()->has('error'))
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4 class="card-title">Data Penarikan / Pencairan Saldo Tabungan</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <button class="btn btn-sm btn-primary float-right" id="menu-penarikan"> Menu
                                                Penarikan
                                            </button>
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
                                                            <th>Nama Siswa</th>
                                                            <th>Nominal</th>
                                                            <th>Jenis Dana</th>
                                                            <th>Waktu</th>
                                                            <th>Opsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($tabunganOut as $tabungan)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <th>{{ $tabungan->tabungan->user->siswa->nm_siswa }}</th>
                                                                <td>Rp. {{ number_format($tabungan->nominal, 2) }}</td>
                                                                <td><span
                                                                        class="badge badge-danger p-2">{{ $tabungan->status }}</span>
                                                                </td>
                                                                <td>{{ $tabungan->created_at }}</td>
                                                                <td><a href="/penarikan/bukti-penarikan/{{ $tabungan->id }}"
                                                                        class="btn btn-sm btn-success">
                                                                        <i class="fa fa-reguler fa-file-pdf"></i>
                                                                        Print</td>
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
            </div>
        </div>

        <!-- Select2 -->
        <script>
            $(document).ready(function() {
                $('.js-menu-penarikan').select2();

                $('.js-menu-penarikan').change(function() {
                    var siswa_id = $(this).val();

                    $.ajax({
                        url: '/penarikan/get-data/' + siswa_id,
                        type: 'GET',
                        success: function(data) {
                            console.log(data)
                            $('#tabungan').val(data.tabungan);
                            $('#tabungan_id').val(data.id)
                        },
                    });
                });
            });
        </script>

        <!-- Datatables Jquery -->
        <script>
            $(document).ready(function() {
                $('#table_id').DataTable();
            });
        </script>

        <!-- Modal Menu Penarikan -->
        <script>
            $(document).ready(function() {
                $("#menu-penarikan").click(function() {
                    $("#modal-penarikan").modal("show");
                });
            });
        </script>
    @endsection

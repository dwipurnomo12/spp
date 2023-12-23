@extends('layouts.main')
@include('setor-tunai.tambah-setoran')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Setor Tunai</h4>
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
                        <a href="/setor-tunai">Setoran Masuk</a>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4 class="card-title">Data Setoran Tunai</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <button type="button" class="btn btn-primary btn-sm float-right"
                                                data-toggle="modal" data-target="#tambah-setoran">
                                                Tambah Setoran
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
                                                        @foreach ($TabunganIn as $tabungan)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <th>{{ $tabungan->tabungan->siswa->nm_siswa }}</th>
                                                                <td>Rp. {{ number_format($tabungan->nominal, 2) }}</td>
                                                                <td>{{ $tabungan->status }}</td>
                                                                <td>{{ $tabungan->created_at }}</td>
                                                                <td><a href="/setor-tunai/bukti-setoran/{{ $tabungan->id }}"
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
                $('.js-stor-tunai').select2();

                $('.js-stor-tunai').change(function() {
                    var siswa_id = $(this).val();

                    $.ajax({
                        url: '/setor-tunai/get-data/' + siswa_id,
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
    @endsection

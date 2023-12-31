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
                        <a href="/tabungan-siswa">Tabungan Siswa</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title">Informasi Tabungan Siswa</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <form action="/tabungan-siswa/filter-data" method="GET">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="text">Filter Berdasarkan Kelas</label>
                                                <div class="input-group">
                                                    <select class="form-control" aria-label="Default select example"
                                                        name="kelas_id">
                                                        <option value="">Pilih Kelas</option>
                                                        @foreach ($kelases as $kelas)
                                                            <option value="{{ $kelas->id }}"
                                                                {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                                                {{ $kelas->kelas }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="ml-2 mt-1">
                                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                                class="fa-solid fa-magnifying-glass"></i> Filter</button>

                                                        <a href="/tabungan-siswa/" class="btn btn-sm btn-danger ml-1"
                                                            id="refresh_btn"><i class="fa fa-solid fa-rotate-right"></i>
                                                            Refresh</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Saldo Tabungan Siswa</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table_id" class="display table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama</th>
                                                            <th>NIS</th>
                                                            <th>Kelas</th>
                                                            <th>Saldo Tabuhan</th>
                                                            <th>Opsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($users as $user)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $user->siswa->nm_siswa }}</td>
                                                                <td>{{ $user->siswa->nis }}</td>
                                                                <td>{{ $user->siswa->kelas->kelas }}</td>
                                                                <td>Rp.
                                                                    {{ number_format($user->tabungan->tabungan, 2, ',', '.') }}
                                                                </td>
                                                                <td>
                                                                    <a href="/tabungan-siswa/history/{{ $user->tabungan->id }}"
                                                                        class="btn btn-sm btn-primary">Cek History</a>
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

@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pembaharuan Data Siswa</h4>
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
                        <a href="/kelulusan">Pembaharuan Data Siswa</a>
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
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Kelulusan Siswa</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <form action="/kelulusan/filter-data" method="GET">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="text">Tentukan Kelas Yang Akan Di Luluskan</label>
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

                                                        <a href="/kelulusan/" class="btn btn-sm btn-danger ml-1"
                                                            id="refresh_btn"><i class="fa fa-solid fa-rotate-right"></i>
                                                            Refresh</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <form action="{{ route('proses-lulus') }}" method="POST">
                                @csrf

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group ml-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="checkAll">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Pilih Semua Siswa
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success ml-1">
                                                <i class="fas fa-regular fa-graduation-cap"></i> Proses Kelulusan
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                <div class="table-responsive">
                                    <table id="table_id" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Nis</th>
                                                <th>Kelamin</th>
                                                <th>No.HP</th>
                                                <th>Alamat</th>
                                                <th>Kelas</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswas as $siswa)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $siswa->nm_siswa }}</td>
                                                    <td>{{ $siswa->nis }}</td>
                                                    <td>{{ $siswa->j_kelamin }}</td>
                                                    <td>{{ $siswa->no_hp }}</td>
                                                    <td>{{ $siswa->alamat }}</td>
                                                    <td>{{ $siswa->kelas->kelas }}</td>
                                                    <td>
                                                        <input type="checkbox" name="siswa_ids[]"
                                                            id="siswa_{{ $siswa->id }}" class="btn-check"
                                                            value="{{ $siswa->id }}" />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>

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

        $(document).ready(function() {
            $('#checkAll').change(function() {
                $(':checkbox.btn-check').prop('checked', this.checked);
            });

            $(':checkbox.btn-check').change(function() {
                if (!$(':checkbox.btn-check:checked').length) {
                    $('#checkAll').prop('checked', false);
                } else if ($(':checkbox.btn-check:not(:checked)').length === 0) {
                    $('#checkAll').prop('checked', true);
                }
            });
        });
    </script>
@endsection

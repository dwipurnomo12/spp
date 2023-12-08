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
                        <a href="/kenaikan-kelas">Pembaharuan Data Siswa</a>
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
                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Kenaikan Kelas</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card bg-primary">
                                <div class="card-body text-white">
                                    FIlter kelas untuk memudahkan pencarian data siswa berdasarkan kelas. Lalu checklist
                                    data siswa dan pilih kelas baru, kemudian <b>Update !</b>
                                </div>
                            </div>
                            <div class="form-group">
                                <form action="/kenaikan-kelas/filter-data" method="GET">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="text">Tentukan Kelas Yang Akan Di Naikkan</label>
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

                                                        <a href="/kenaikan-kelas/" class="btn btn-sm btn-danger ml-1"
                                                            id="refresh_btn"><i class="fa fa-solid fa-rotate-right"></i>
                                                            Refresh</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="form-group">
                                <form action="/kenaikan-kelas/update" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="kelas_baru">Pilih Kelas Baru</label>
                                                <div class="input-group">
                                                    <select class="form-control" name="kelas_baru">
                                                        <option value="">Pilih Kelas</option>
                                                        @foreach ($kelases as $kelas)
                                                            <option value="{{ $kelas->id }}">{{ $kelas->kelas }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="ml-2 mt-1">
                                                        <button type="submit" class="btn btn-sm btn-success">Update
                                                            Kelas</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row my-3">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="checkbox">Pilih Semua Siswa</label>
                                                <input type="checkbox" id="checkAll" />
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

@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Siswa</h4>
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
                        <a href="/siswa">Siswa</a>
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
                                    <h4 class="card-title">Data Siswa</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="modal fade" id="importDataSiswa" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Import Data Siswa</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('siswa.import') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="file">Pilih file Excel</label>
                                                            <input type="file" name="file" class="form-control"
                                                                accept=".xlsx, .xls">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('download-excel', ['filename' => 'format_excel.xlsx']) }}"
                                                            class="btn btn-sm btn-success float-start"
                                                            download="format_excel.xlsx">
                                                            Unduh Format .xlsx
                                                        </a>

                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary">Import</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix">
                                        <button type="button" class="btn btn-sm btn-success float-right"
                                            data-toggle="modal" data-target="#importDataSiswa">
                                            <i class="fas fa-regular fa-file-import"></i> Import Data Siswa
                                        </button>
                                        <a href="/siswa/create" class="btn btn-sm btn-primary mb-2 float-right mr-2">
                                            <i class="fa fa-plus"></i> Tambah Siswa
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <form action="/siswa/filter-data" method="GET">
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

                                                        <a href="/siswa/" class="btn btn-sm btn-danger ml-1"
                                                            id="refresh_btn"><i class="fa fa-solid fa-rotate-right"></i>
                                                            Refresh</a>

                                                        <a href="/siswa/export?kelas_id={{ request('kelas_id') }}"
                                                            class="btn ml-2 btn-sm btn-warning">
                                                            <i class="fa fa-regular fa-file-excel"></i> Export Data Siswa
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                                            <th>Angkatan</th>
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
                                                <td>{{ $siswa->thn_angkatan }}</td>
                                                <td>
                                                    <a href="/siswa/{{ $siswa->id }}/edit"
                                                        class="btn btn-sm btn-warning mb-2 mt-2"><i
                                                            class="fa fa-edit"></i></a>

                                                    <form id="{{ $siswa->id }}" action="/siswa/{{ $siswa->id }}"
                                                        method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger swal-confirm mb-2"
                                                            data-form="{{ $siswa->id }}"><i
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

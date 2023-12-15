@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Tagihan</h4>
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
                        <a href="/tagihan">Tagihan</a>
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
                                    <h4 class="card-title">Tagihan</h4>
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
                            <div class="table-responsive">
                                <table id="table_id" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tagihan</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tagihans as $tagihan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $tagihan->nm_tagihan }}</td>
                                                <td>
                                                    <a href="/tagihan/detail/{{ $tagihan->id }}"
                                                        class="btn btn-sm btn-primary">Detail</a>
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

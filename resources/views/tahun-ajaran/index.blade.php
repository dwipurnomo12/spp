@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Tahun Ajaran</h4>
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
                        <a href="/tahun-ajaran">Tahun Ajaran</a>
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
                                    <h4 class="card-title">Data Tahun Ajaran</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="/tahun-ajaran/create" class="btn btn-sm btn-primary mb-2 float-right"><i
                                            class="fa fa-plus"></i> Tambah
                                        Tahun Ajaran</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_id" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($thn_ajarans as $thn_ajaran)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $thn_ajaran->thn_ajaran }}</td>
                                                <td>
                                                    @if ($thn_ajaran->status == 'aktif')
                                                        <span
                                                            class="badge badge-success p-2">{{ $thn_ajaran->status }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-danger p-2">{{ $thn_ajaran->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="/tahun-ajaran/{{ $thn_ajaran->id }}/edit"
                                                        class="btn btn-sm btn-warning mb-2"><i class="fa fa-edit"></i></a>

                                                    <form id="{{ $thn_ajaran->id }}"
                                                        action="/tahun-ajaran/{{ $thn_ajaran->id }}" method="POST"
                                                        class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger swal-confirm mb-2"
                                                            data-form="{{ $thn_ajaran->id }}"><i
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

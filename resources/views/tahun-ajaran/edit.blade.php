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
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/tahun-ajaran/{{ $thnAjaran->id }}/edit">Edit Tahun Ajaran</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title">Edit Tahun Ajaran</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/tahun-ajaran/{{ $thnAjaran->id }}" method="POST">
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <label for="text">Tahun Ajaran</label>
                                    <input type="text" class="form-control" name="thn_ajaran"
                                        value="{{ $thnAjaran->thn_ajaran }}">
                                    @error('thn_ajaran')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value=""> -- Pilih Status -- </option>
                                        <option value="aktif"
                                            {{ old('status', $thnAjaran->status) == 'aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="tidak aktif"
                                            {{ old('status', $thnAjaran->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak
                                            Aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary my-3 float-right">Update</button>
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
    </script>
@endsection

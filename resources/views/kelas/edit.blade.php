@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Kelas</h4>
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
                        <a href="/kelas">Kelas</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/kelas/edit">Edit Kelas</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title">Edit Data Kelas</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/kelas/{{ $kelas->id }}" method="POST">
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <label for="text">Kelas</label>
                                    <input type="text" class="form-control" name="kelas" value="{{ $kelas->kelas }}">
                                    @error('kelas')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="text">tingkat <span style="color: red">*</span></label>
                                    <select class="form-control" aria-label="Default select example" name="tingkat_id">
                                        <option value="" selected>Pilih Tingkat</option>
                                        @foreach ($tingkats as $tingkat)
                                            <option value="{{ $tingkat->id }}"
                                                {{ $kelas->tingkat_id == $tingkat->id ? 'selected' : '' }}>
                                                {{ $tingkat->tingkat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tingkat_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" rows="5">{{ $kelas->keterangan }}</textarea>
                                    @error('keterangan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary my-3 float-right">Perbarui</button>
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

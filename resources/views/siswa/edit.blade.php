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
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/siswa/{{ $siswa->id }}/edit">Edit Siswa</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title">Edit Data Siswa</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/siswa/{{ $siswa->id }}" method="POST">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="text">Nama Siswa <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="nm_siswa"
                                                value="{{ $siswa->nm_siswa }}">
                                            @error('nm_siswa')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Nomor Induk Siswa (NIS) <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="nis"
                                                value="{{ $siswa->nis }}">
                                            @error('nis')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Jenis Kelamin <span style="color: red">*</span></label>
                                            <select class="form-control" aria-label="Default select example"
                                                name="j_kelamin">
                                                <option value="laki-laki"
                                                    {{ $siswa->j_kelamin === 'laki-laki' ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="perempuan"
                                                    {{ $siswa->j_kelamin === 'perempuan' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                            @error('j_kelamin')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="text">Kelas <span style="color: red">*</span></label>
                                            <select class="form-control" aria-label="Default select example"
                                                name="kelas_id">
                                                <option value="" selected>Pilih Kelas</option>
                                                @foreach ($kelases as $kelas)
                                                    <option value="{{ $kelas->id }}"
                                                        {{ $siswa->kelas_id == $kelas->id ? 'selected' : '' }}>
                                                        {{ $kelas->kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kelas_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Nomor HP <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="no_hp"
                                                value="{{ $siswa->no_hp }}">
                                            @error('no_hp')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat <span style="color: red">*</span></label>
                                            <textarea class="form-control" name="alamat" rows="5">{{ $siswa->alamat }}</textarea>
                                            @error('alamat')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <span style="color: red" class=" mt-3 float-left">* <i>Wajib diisi !</i></span>
                                <button type="submit" class="btn btn-primary my-3 float-right">Simpan</button>
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

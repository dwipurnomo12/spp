@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pengeluaran</h4>
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
                        <a href="/pengeluaran">Pengeluaran</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/pengeluaran/create">Tambah Pengeluaran</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title">Tambah Pengeluaran</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/pengeluaran" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="status" value="out">
                                        <input type="hidden" name="saldo_id" value="1">
                                        <div class="form-group">
                                            <label for="nonial">Nominal Dana Keluar <span
                                                    style="color: red">*</span></label>
                                            <input type="number" class="form-control" name="nominal">
                                            @error('nominal')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan Dana Keluar <span
                                                    style="color: red">*</span></label>
                                            <textarea class="form-control" name="keterangan" rows="5"></textarea>
                                            @error('keterangan')
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
@endsection

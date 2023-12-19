@extends('layouts.main')
<style>
    #List {
        display: flex;
        flex-wrap: wrap;
    }

    .checkbox {
        width: 25%;
        box-sizing: border-box;
        padding: 0 10px;
        margin-bottom: 10px;
    }
</style>
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pembayaran</h4>
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
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/tambah-tagihan">Tambah Tagihan</a>
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
                                    <h4 class="card-title">Tambah Tagihan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="tambah-tagihan" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="text">Nama Tagihan <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="nm_tagihan" required>
                                    @error('nm_tagihan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="text">Pilih Biaya <span style="color: red">*</span></label>
                                    <div id="List">
                                        @foreach ($biayas as $biaya)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="biaya_id[]" value="{{ $biaya->id }}">
                                                    Rp. {{ number_format($biaya->biaya, 2, ',', '.') }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="text">Pilih Kelas Terkait <span style="color: red">*</span></label>
                                    <div id="List">
                                        @foreach ($kelases as $kelas)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="kelas_id[]" value="{{ $kelas->id }}">
                                                    {{ $kelas->kelas }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-success float-right my-3"><i
                                        class="fa fa-solid fa-money-bill-wave"></i> Tambah Tagihan</button>
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

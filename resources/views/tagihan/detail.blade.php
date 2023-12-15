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
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/tagihan/detail/{{ $tagihan->id }}">Detail Tagihan</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title">Detail Tagihan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Kelas Terkait</td>
                                        <td> : </td>
                                        <td>
                                            @foreach ($tagihan->kelases as $kelas)
                                                - {{ $kelas->kelas }} <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Detail Biaya</td>
                                        <td> : </td>
                                        <td>
                                            @foreach ($tagihan->biayas as $biaya)
                                                - Rp.
                                                {{ number_format($biaya->biaya, 2, ',', '.') }}
                                                ({{ $biaya->jenis_pembayaran }})
                                                <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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

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
                        <a href="/tagihan">Cek Tagihan</a>
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

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_id" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis Tagihan</th>
                                            <th>Status</th>
                                            <th>Rincian</th>
                                            <th>Tagihan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $no = 1; ?>
                                        @foreach ($tagihans as $tagihan)
                                            @foreach ($tagihan->users as $siswa)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $tagihan->nm_tagihan }}</td>
                                                    <td>
                                                        @if ($siswa->pivot->status == 'belum_dibayar')
                                                            <span class="badge badge-warning">{{ $siswa->pivot->status }}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-success">{{ $siswa->pivot->status }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @foreach ($tagihan->biayas as $biaya)
                                                            <ul>
                                                                <li>
                                                                    Rp.
                                                                    {{ number_format($biaya->biaya, 2, ',', '.') }}
                                                                    ({{ $biaya->jenis_pembayaran }})
                                                                </li>
                                                            </ul>
                                                        @endforeach
                                                    </td>

                                                    <td>Rp.
                                                        {{ number_format($siswa->pivot->total_tagihan, 2, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        @if ($siswa->pivot->status == 'belum_dibayar')
                                                            <a href="javascript:void(0)"
                                                                onclick="konfirmasiPembayaran('{{ $siswa->id }}', '{{ $tagihan->id }}')"
                                                                class="btn btn-sm btn-success">
                                                                <i class="fa fa-solid fa-money-bill-wave"></i>
                                                                Bayar
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)"
                                                                onclick="cetakStruk('{{ $siswa->id }}', '{{ $tagihan->id }}')"
                                                                class="btn btn-sm btn-danger">
                                                                <i class="fa fa-reguler fa-file-pdf"></i>
                                                                Struk
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
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

    <!-- Print struk -->
    <script>
        function cetakStruk(userId, tagihanId) {
            fetch('/cek-tagihan/cetak-struk/' + userId + '/' + tagihanId, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection

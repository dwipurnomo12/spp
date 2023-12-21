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
                        <a href="/transaksi">Transaksi</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/transaksi/detail/">Detail</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title">Transaksi Pembayaran</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row mt-4">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            Tagihan Siswa Yang Belum Dibayar
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
                                                            @foreach ($tagihan->siswas as $siswa)
                                                                <tr>
                                                                    <td>{{ $no++ }}</td>
                                                                    <td>{{ $tagihan->nm_tagihan }}</td>
                                                                    <td>
                                                                        @if ($siswa->pivot->status == 'belum_dibayar')
                                                                            <span
                                                                                class="badge badge-warning">{{ $siswa->pivot->status }}
                                                                            </span>
                                                                        @else
                                                                            <span
                                                                                class="badge badge-success">{{ $siswa->pivot->status }}
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
                                                                                <i
                                                                                    class="fa fa-solid fa-money-bill-wave"></i>
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

    <script>
        function konfirmasiPembayaran(siswaId, tagihanId) {
            Swal.fire({
                title: 'Konfirmasi Pembayaran',
                text: 'Anda yakin ingin melakukan pembayaran?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Bayar!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/transaksi/bayar',
                        type: 'POST',
                        data: {
                            siswa_id: siswaId,
                            tagihan_id: tagihanId,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            Swal.fire('Pembayaran Sukses', 'Tagihan telah lunas!', 'success');
                            location.reload();
                        },
                        error: function(error) {
                            console.error(error);
                            Swal.fire('Pembayaran Gagal', 'Terjadi kesalahan, coba lagi nanti!',
                                'error');
                        }
                    });
                }
            });
        }
    </script>

    <script>
        function cetakStruk(siswaId, tagihanId) {
            fetch('/transaksi/cetak-struk/' + siswaId + '/' + tagihanId, {
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

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
                        <a href="/cek-tagihan">Cek Tagihan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/cek-tagihan/{{ $user->id }}/{{ $tagihan->id }}/bayar">Bayar</a>
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
                                    <h4 class="card-title">Detail Tagihan</h4>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Jenis Tagihan</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Rincian</th>
                                            <th class="text-center">Tagihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $detailTagihan->nm_tagihan }}</td>
                                            <td class="text-center">
                                                @foreach ($detailTagihan->users as $siswa)
                                                    @if ($siswa->pivot->status == 'belum_dibayar')
                                                        <span class="badge badge-warning">{{ $siswa->pivot->status }}</span>
                                                    @else
                                                        <span class="badge badge-success">{{ $siswa->pivot->status }}</span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach ($detailTagihan->biayas as $biaya)
                                                        <li>
                                                            Rp. {{ number_format($biaya->biaya, 2, ',', '.') }}
                                                            ({{ $biaya->jenis_pembayaran }})
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="text-center">
                                                @foreach ($detailTagihan->users as $siswa)
                                                    Rp. {{ number_format($siswa->pivot->total_tagihan, 2, ',', '.') }} <br>
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
                                    <h4 class="card-title">Pilih Metode Pembayaran</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5>Virtual Account</h5>
                                </div>
                            </div>

                            <div class="row">
                                @foreach ($channels as $channel)
                                    @if ($channel->active == true && $channel->group == 'Virtual Account')
                                        <div class="col-md-3">
                                            <form action="/cek-tagihan/bayar" method="POST">
                                                @csrf
                                                <input type="hidden" name="tagihan_id" value="{{ $detailTagihan->id }}">
                                                <input type="hidden" name="method" value="{{ $channel->code }}">
                                                <div class="card">
                                                    <button class="btn btn-light">
                                                        <div class="card-body pb-0">
                                                            <img src="{{ $channel->icon_url }}" alt="{{ $channel->name }}"
                                                                class="img-fluid mb-2" width="50">
                                                            <p>{{ $channel->name }}</p>
                                                        </div>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5>E-Wallet</h5>
                                </div>
                            </div>

                            <div class="row">
                                @foreach ($channels as $channel)
                                    @if ($channel->active == true && $channel->group == 'E-Wallet')
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-body pb-0">
                                                    <img src="{{ $channel->icon_url }}" alt="{{ $channel->name }}"
                                                        class="img-fluid mb-2" width="50">
                                                    <p>{{ $channel->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

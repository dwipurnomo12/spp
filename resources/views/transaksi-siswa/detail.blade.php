@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Detail Tagihan</h4>
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
                </ul>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-7">
                                    <h4 class="card-title">Detail Tagihan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card card-custom bg-primary">
                                <div class="card-body bubble-shadow">
                                    <h1 class="text-light">{{ $detail->payment_name }}</h1>
                                    <h2 class="py-4 mb-0 text-light">Rp. {{ number_format($detail->amount, 2, ',', '.') }}
                                    </h2>
                                    <div class="row">
                                        <div class="col-8 pr-0">
                                            <h3 class="fw-bold mb-1 text-light">{{ $detail->reference }}</h3>
                                        </div>
                                        <div class="col-4 pl-0 text-right">
                                            <div class="text-medium text-uppercase fw-bold op-8">
                                                @if ($detail->status == 'UNPAID')
                                                    <span class="badge badge-danger">{{ $detail->status }}</span>
                                                @else
                                                    <span class="badge badge-success">{{ $detail->status }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Instruksi Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-secondary">
                                @foreach ($detail->instructions as $index => $instruction)
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $index }}" data-toggle="collapse"
                                            data-target="#collapse{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $index }}">
                                            <div class="span-icon">
                                                <div class="flaticon-box-1"></div>
                                            </div>
                                            <div class="span-title">
                                                {{ $instruction->title }}
                                            </div>
                                            <div class="span-mode"></div>
                                        </div>

                                        <div id="collapse{{ $index }}"
                                            class="collapse{{ $index === 0 ? ' show' : '' }}"
                                            aria-labelledby="heading{{ $index }}" data-parent="#accordion">
                                            <div class="card-body">
                                                <ul>
                                                    @foreach ($instruction->steps as $step)
                                                        <li class="text-sm"> {!! $step !!}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembayaran SPP</title>
</head>
<style>
    .container {
        border: 1px solid black;
        height: 1000px;
    }

    .header {
        text-align: center;
    }

    .h3 {
        text-align: center;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .column {
        float: left;
        text-align: left;
        width: 33.33%;
        margin-bottom: 15px;
    }

    .detail {
        margin-top: 15px;
        padding-left: 10px;
    }

    .row {
        margin-top: 10px;
        margin-bottom: 20px;
        padding: 30px;
    }

    table {
        width: 100%;
        text-align: center;
        padding: 20px;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
        padding: 15px;
    }

    th {
        background-color: rgb(201, 201, 201);
    }

    tr {
        text-align: left;
    }
</style>

<body>
    <div class="container">
        <div class="header">
            <h2>SMK NEGERI 30 PURWOREJO</h2>
            <p>Desa Karangmulyo, Kecamatan Purwodadi, Kabupaten Purworejo, Jawa Tengah 54173</p>
        </div>

        <hr>

        <div class="row">
            <div class="column" style="float: left">
                Jenis Tagihan : {{ $tagihan->nm_tagihan }}<br>
                Kelas : {{ $siswa->kelas->kelas }}
            </div>
            <div class="column">

            </div>
            <div class="column" style="float: right">
                Nama Siswa: {{ $siswa->nm_siswa }}<br>
                NIS: {{ $siswa->nis }}
            </div>
        </div>

        <div class="detail">
            <table>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Rincian</th>
                        <th>Total Tagihan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tagihan->siswas as $siswa)
                        <tr>
                            <td>
                                {{ $siswa->pivot->status }}
                            </td>
                            <td>
                                @foreach ($tagihan->biayas as $biaya)
                                    <ul>
                                        <li>
                                            <p>Rp.
                                                {{ number_format($biaya->biaya, 2, ',', '.') }}
                                                ({{ $biaya->jenis_pembayaran }})
                                            </p>
                                        </li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>Rp.
                                {{ number_format($siswa->pivot->total_tagihan, 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="column" style="float: left">
                </div>
                <div class="column">

                </div>
                <div class="column" style="float: right">
                    <p>Purworejo, {{ now()->format('d F Y') }}</p>
                    <p>Yang Bertanda Tangan Dibawah Ini,</p><br><br>


                    <p>Mujiyono SPD, MPD</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

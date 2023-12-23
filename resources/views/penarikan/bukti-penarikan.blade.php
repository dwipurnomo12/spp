<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Penarikan Tabungan Siswa</title>
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
                Jenis Surat : Bukti Penarikan Tabungan Siswa<br>
                Dicetak Oleh : Admin {{ auth()->user()->name }}
            </div>
            <div class="column">

            </div>
            <div class="column" style="float: right">
                Catatan : Harap simpan bukti ini !
            </div>
        </div>

        <div class="detail">
            <table>
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Nominal</th>
                        <th>Jenis Dana</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $buktiPenarikan->tabungan->siswa->nm_siswa }}</td>
                        <td>Rp. {{ number_format($buktiPenarikan->nominal, 2) }}</td>
                        <td>{{ $buktiPenarikan->status }}</td>
                        <td>{{ $buktiPenarikan->created_at }}</td>
                    </tr>

                </tbody>
            </table>
            <div class="row">
                <div class="column" style="float: left">
                </div>
                <div class="column">

                </div>
                <div class="column" style="float: right">
                    <p>Purworejo, {{ now()->format('d F Y') }}</p>
                    <p>Mengetahui,</p><br><br>


                    <p>Mujiyono SPD, MPD</p>
                    <p>(Kepala Sekolah SMP Purworejo)</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Kegiatan Magang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 16px;
            text-transform: uppercase;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 14px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            padding: 5px 0;
        }

        table.laporan {
            width: 100%;
            border-collapse: collapse;
        }

        .laporan th,
        .laporan td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .laporan th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Kegiatan Magang UPT TI</h1>
        <h2>Institut Teknologi dan Sains Mandala</h2>
    </div>

    <div class="info">
        <table>
            <tr>
                <td width="30%">Nama</td>
                <td>: {{ $nama ?? 'Muhammad Mauribi' }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>: {{ $nim ?? '23060005' }}</td>
            </tr>
            <tr>
                <td>Fakultas</td>
                <td>: {{ $fakultas ?? 'Sistem dan Teknologi Informasi' }}</td>
            </tr>
            <tr>
                <td>Periode Magang</td>
                <td>
                    : {{ \Carbon\Carbon::parse($dari_tanggal)->translatedFormat('d F Y') }} s/d
                    {{ \Carbon\Carbon::parse($sampai_tanggal)->translatedFormat('d F Y') }}
                </td>
            </tr>
        </table>
    </div>

    <table class="laporan">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="28%">Tanggal</th>
                <th width="30%">Uraian Kegiatan</th>
                <th width="30%">Hasil Kegiatan</th>
                <th width="30%">Kendala</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kegiatans as $index => $kegiatan)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}
                    </td>
                    <td>{{ $kegiatan->uraian_kegiatan }}</td>
                    <td>{{ $kegiatan->hasil_kegiatan }}</td>
                    <td>{{ $kegiatan->kendala ?? 'Tidak ada kendala' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data kegiatan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Jember, {{ now()->translatedFormat('d F Y') }}</p>
        <br><br><br>
        <p>_____________________</p>
    </div>
</body>

</html>

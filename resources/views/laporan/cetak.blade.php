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
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header table {
            width: 100%;
            border: 0;
        }

        .header img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .header td {
            vertical-align: top;
        }

        .header-content {
            padding-left: 20px;
            padding-top: 10px;
        }

        .header-content h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .header-content p {
            margin: 5px 0;
            font-size: 12px;
        }

        /* Style untuk informasi */
        .info {
            margin-bottom: 20px;
        }

        .info table {
            width: 100%;
            margin-top: 10px;
        }

        .info td {
            padding: 5px 0;
        }

        /* Style untuk tabel laporan */
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

        .footer p {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <table>
            <tr>
                <td>
                    <img src="{{ public_path('assets/logo/mandala.png') }}" alt="Logo">
                </td>
                <td class="header-content">
                    <h1>INSTITUT TEKNOLOGI DAN SAINS MANDALA</h1>
                    <p>Kampus: Jl. Sumatera No. 118 - 120 Jember 68121 Telp. (0331) 334 324 Fax. (0331) 330 941</p>
                    <p>e-mail: itsm@itsm.ac.id ; website: www.itsm.ac.id</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="info">
        <table>
            <tr>
                <td width="30%">Nama</td>
                <td>: {{ auth()->user()->name }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>: {{ auth()->user()->nim }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>: {{ auth()->user()->prodi }}</td>
            </tr>
            <tr>
                <td>Tanggal Kegiatan</td>
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Arsip Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header-table, .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table td {
            vertical-align: top;
        }
        .header-table h2 {
            margin: 0;
        }
        .header-table p {
            margin: 2px 0;
        }
        .logo {
            width: 100px;
            height: auto;
        }
        .data-table th, .data-table td {
            border: 1px solid #444;
            padding: 6px 8px;
            text-align: left;
        }
        .data-table th {
            background-color: rgb(175, 174, 172)
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <table class="header-table">
        <tr>
            <td>
                <h2>Jogja Tour & Travel</h2>
                <p>Klajuran, Tanjungharjo, Kec. Nanggulan,Kulon Progo, Yogyakarta 55671</p>
                <p>0822-1916-8068</p>
                <p>JogjaTourTravel@gmail.com</p>
                <p>www.JogjaTourTravel.com</p>
            </td>
            <td style="text-align: right;">
                <img src="{{ public_path('storage/images/JTT_LOGO.png') }}" alt="Jogja Tour & Travel" class="logo" style="width: 30%;">
            </td>
        </tr>
    </table>

    <!-- Judul -->
    <h2 class="text-center">Daftar Arsip Pesanan</h2>

    <!-- Tabel Data -->
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Wisatawan</th>
                <th>Kota Asal</th>
                <th>Jumlah Orang</th>
                <th>Total Biaya</th>
                <th>Destinasi</th>
                <th>Layanan</th>
                <th>Transportasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan as $p)
                <tr>
                    <td>JT-INV-{{ $p->id }}</td>
                    <td>{{ $p->wisatawan }}</td>
                    <td>{{ $p->kota_asal }}</td>
                    <td>{{ $p->jumlah_orang }}</td>
                    <td>Rp{{ number_format($p->total_biaya, 0, ',', '.') }}</td>
                    <td>
                        @foreach($p->destinasi as $d)
                            • {{ $d->nama_destinasi }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($p->layananTambahan as $l)
                            • {{ $l->nama_layanan }}<br>
                        @endforeach
                    </td>
                    <td>
                        {{ $p->transportasi->nama_kendaraan ?? '-' }}
                    </td>
                    <td>
                        @if ($p->pembayaran && $p->pembayaran->bukti_pembayaran)
                            Lunas
                        @else
                            Belum Dibayar
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            padding: 40px;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .header,
        .section,
        .footer {
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: rgb(175, 174, 172);
            color: #fff;
        }

        .total-row td {
            font-weight: bold;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        h2,
        h3,
        p {
            margin: 0;
            padding: 0;
        }

        h3 {
            margin-bottom: 5px;
        }

        p {
            margin: 5px 0;
        }

        img {
            height: 60px;
        }

        /* Tambahan untuk tabel tanpa border */
        .no-border td {
            border: none !important;
            padding: 4px 0;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header flex">
        <table class="no-border">
            <tr>
                <!-- Kolom Info Perusahaan -->
                <td style="vertical-align: top;">
                    <h2 style="margin: 0;">Jogja Tour & Travel</h2>
                    <p>
                        Klajuran, Tanjungharjo, Kec. Nanggulan,<br>
                        Kulon Progo, Yogyakarta 55671<br>
                        082219168068<br>
                        JogjaTourTravel@gmail.com<br>
                        www.JogjaTourTravel.com
                    </p>
                </td>
                <!-- Kolom Logo -->
                <td style="width: 80px; vertical-align: top;">
                    <img src="{{ public_path('storage/images/JTT_LOGO.png') }}" alt="Jogja Tour & Travel">
                </td>
            </tr>
        </table>
    </div>

    <table class="no-border" style="margin-bottom: 30px;">
        <tr>
            <!-- Kolom Kiri: Data Pemesan -->
            <td style="vertical-align: top; width: 50%;">
                <h3 style="margin-bottom: 5px;">Pemesan</h3>
                <p>
                    {{ $pesanan->wisatawan }}<br>
                    Kota Asal : {{ $pesanan->kota_asal }}<br>
                    No. Telefon : {{ $pesanan->telefon }}
                </p>
            </td>

            <!-- Kolom Kanan: Informasi Invoice -->
            <td style="vertical-align: top; text-align: right; width: 50%;">
                <p>
                    <strong>No. Pesanan :</strong> JT-INV-{{ $pesanan->id }}<br>
                    <strong>Invoice Date :</strong> {{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y') }}<br>
                    <strong>Due Date :</strong> {{ \Carbon\Carbon::parse($pesanan->created_at)->addDays(1)->format('d M Y') }}
                </p>
            </td>
        </tr>
    </table>

    <!-- Table -->
    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="right">Harga</th>
                    <th class="right">Satuan</th>
                    <th class="right">Jumlah biaya</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan->destinasi as $d)
                    <tr>
                        <td>{{ $d->nama_destinasi }}</td>
                        <td class="right">Rp{{ number_format($d->harga, 0, ',', '.') }}</td>
                        <td class="right">{{ $pesanan->jumlah_orang }}</td>
                        <td class="right">Rp{{ number_format($d->harga * $jumlahOrang, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                @foreach($pesanan->layananTambahan as $lt)
                    @php
                        $isCatering = str_contains(strtolower($lt->nama_layanan), 'catering');
                        $qty = $isCatering ? $jumlahOrang : 1;
                        $subtotal = $lt->harga_layanan * $qty;
                    @endphp
                    <tr>
                        <td>{{ $lt->nama_layanan }}</td>
                        <td class="right">Rp{{ number_format($lt->harga_layanan, 0, ',', '.') }}</td>
                        <td class="right">{{ $qty }}</td>
                        <td class="right">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td>Transportasi - {{ $pesanan->transportasi->nama_kendaraan ?? '-' }}</td>
                    <td class="right">Rp{{ number_format($hargaTransportasi, 0, ',', '.') }}</td>
                    <td class="right">1</td>
                    <td class="right">Rp{{ number_format($hargaTransportasi, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" class="right">TOTAL</td>
                    <td class="right">Rp{{ number_format($totalAkhir, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Footer -->
    <div class="section">
        <p>
            <strong>Perhatian!</strong><br>
            Sebelum melakukan pembayaran, silahkan melakukan konfirmasi terlebih dahulu<br>
            melalui nomor whatsapp kami yang terdapat pada website atau nomor dibawah ini :<br>
            Eko Budi Ratno : 0812-4829-3513<br>
            Gilang Yoga Pratama : 0813-2500-1074
        </p>
    </div>

    <div class="section">
        <p>
            <strong>Metode Pembayaran</strong><br>
            No.Rekening: 1929319239<br>
            A.N: Eko Budi Ratno<br>
            Bank: Bank Negara Indonesia (BNI)
        </p>
        <p>Terima kasih telah mempercayakan perjalanan Anda kepada kami.</p>
    </div>

</body>
</html>

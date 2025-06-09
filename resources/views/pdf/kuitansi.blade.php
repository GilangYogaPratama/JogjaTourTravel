<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kuitansi Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 40px;
            color: #000;
        }
        .kuitansi-container {
            max-width: 800px;
            margin: auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        .header .info {
            flex: 1;
        }
        .header img {
            width: 100px;
            object-fit: contain;
        }
        h2 {
            text-align: center;
            margin: 30px 0 10px;
            font-size: 20px;
        }
        .details p {
            margin: 4px 0;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 6px;
        }
        th {
            text-align: left;
            font-weight: bold;
            background-color: #f4f4f4;
        }
        td.right, th.right {
            text-align: right;
        }
        .total-row td {
            font-weight: bold;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
        .footer {
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <div class="kuitansi-container">
        <div class="header flex">
        <img src="{{ public_path('storage/images/JTT_LOGO.png') }}" alt="Jogja Tour & Travel" width="100%">
            <p>
                Klajuran, Tanjungharjo, Kec. Nanggulan,<br>
                Kulon Progo, Yogyakarta 55671<br>
                082219168068<br>
                JogjaTourTravel@gmail.com<br>
                www.JogjaTourTravel.com
            </p>
        </div>

        <h2>KUITANSI PEMBAYARAN</h2>

        <table class="details">
            <td>
                <p><strong>No. Kuitansi:</strong> JT-KWT-{{ $pesanan->id }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                <p><strong>Nama:</strong> {{ $pesanan->wisatawan }}</p>
            </td>
            <td>
                <p><strong>Kota Asal:</strong> {{ $pesanan->kota_asal }}</p>
                <p><strong>Jumlah Orang:</strong> {{ $pesanan->jumlah_orang }}</p>
                <p><strong>Total Bayar:</strong> Rp{{ number_format($pesanan->total_biaya, 0, ',', '.') }}</p>
            </td>
        </table>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="right">Harga</th>
                    <th class="right">Qty</th>
                    <th class="right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                {{-- Destinasi --}}
                @foreach($pesanan->destinasi as $d)
                    <tr>
                        <td>{{ $d->nama_destinasi }}</td>
                        <td class="right">Rp{{ number_format($d->harga, 0, ',', '.') }}</td>
                        <td class="right">{{ $pesanan->jumlah_orang }}</td>
                        <td class="right">Rp{{ number_format($d->harga * $pesanan->jumlah_orang, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                {{-- Layanan Tambahan --}}
                @foreach($pesanan->layananTambahan as $lt)
                    @php
                        $isCatering = str_contains(strtolower($lt->nama_layanan), 'catering');
                        $qty = $isCatering ? $pesanan->jumlah_orang : 1;
                        $subtotal = $lt->harga_layanan * $qty;
                    @endphp
                    <tr>
                        <td>{{ $lt->nama_layanan }}</td>
                        <td class="right">Rp{{ number_format($lt->harga_layanan, 0, ',', '.') }}</td>
                        <td class="right">{{ $qty }}</td>
                        <td class="right">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                {{-- Transportasi --}}
                <tr>
                    <td>Transportasi - {{ $pesanan->transportasi->nama_kendaraan ?? '-' }}</td>
                    <td class="right">Rp{{ number_format($pesanan->transportasi->harga_sewa, 0, ',', '.') }}</td>
                    <td class="right">1</td>
                    <td class="right">Rp{{ number_format($pesanan->transportasi->harga_sewa, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" class="right">TOTAL</td>
                    <td class="right">Rp{{ number_format($pesanan->total_biaya, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
        <div class="footer">
            <table>
                <tr>
                    <!-- Kolom Kiri: Status Lunas -->
                    <td style="width: 80%; vertical-align: top;">
                        <div style="display: flex; align-items: center;">
                            <img src="{{ public_path('storage/images/lunas.png') }}" alt="Lunas" style="height: 60px; margin-right: 10px;">
                            <h1 style="font-size: 25px; font-weight: bold; background: linear-gradient(to right, #3b82f6, #1e40af); -webkit-background-clip: text; -webkit-text-fill-color: transparent; color: #1e40af;">
                                Lunas
                            </h1>
                            <p style="margin-top: 20px;">Terima kasih telah menggunakan layanan <strong>Jogja Tour & Travel</strong>.</p>
                        </div>
                    </td>

                    <!-- Kolom Kanan: Tanda Tangan Direktur -->
                    <td style="width: 20%; text-align: center;">
                        <p style="margin-bottom: 60px;">Hormat Kami,<br>Direktur</p>
                        <img src="{{ public_path('storage/images/ttd-direktur.png') }}" alt="Tanda Tangan Direktur" style="height: 60px;"><br>
                        <strong style="text-decoration: underline;">Eko Budi Ratno</strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
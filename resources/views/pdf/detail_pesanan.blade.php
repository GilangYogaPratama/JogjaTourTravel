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
        .header, .footer {
            display: flex;
            justify-content: space-between;
        }
        .section {
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 8px 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #00BFFF;
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
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h2>KakaKiky Media</h2>
            <p>Jl. Perdamaian Raya No. 6<br>
            ☎ 082219168068<br>
            ✉ kakakiky.id@gmail.com<br>
            🌐 https://www.kakakiky.id</p>
        </div>
        <div>
            <h1>INVOICE</h1>
            <p><strong>Invoice #:</strong> INV-{{ $pesanan->id }}<br>
            <strong>Invoice Date:</strong> {{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y') }}<br>
            <strong>Due Date:</strong> {{ \Carbon\Carbon::parse($pesanan->created_at)->addDays(1)->format('d M Y') }}</p>
        </div>
    </div>

    <div class="section">
        <h3>Bill To:</h3>
        <p>{{ $pesanan->wisatawan }}<br>
        Kota Asal: {{ $pesanan->kota_asal }}</p>
    </div>

    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th class="right">Unit Price</th>
                    <th class="right">Qty</th>
                    <th class="right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan->destinasi as $d)
                <tr>
                    <td>{{ $d->nama_destinasi }}</td>
                    <td class="right">Rp{{ number_format($d->harga, 0, ',', '.') }}</td>
                    <td class="right">1</td>
                    <td class="right">Rp{{ number_format($d->harga, 0, ',', '.') }}</td>
                </tr>
                @endforeach

                @foreach($pesanan->layananTambahan as $lt)
                <tr>
                    <td>{{ $lt->nama_layanan }}</td>
                    <td class="right">
                        Rp{{ number_format(str_contains(strtolower($lt->nama_layanan), 'catering') ? $lt->harga_layanan * $jumlahOrang : $lt->harga_layanan, 0, ',', '.') }}
                    </td>
                    <td class="right">1</td>
                    <td class="right">
                        Rp{{ number_format(str_contains(strtolower($lt->nama_layanan), 'catering') ? $lt->harga_layanan * $jumlahOrang : $lt->harga_layanan, 0, ',', '.') }}
                    </td>
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

    <div class="section">
        <p><strong>Payment Method:</strong><br>
        Account: 1929319239<br>
        A/C Name: M. Rizki Riswandi<br>
        Bank Details: Bank Syariah Indonesia</p>

        <p><strong>Terms & Conditions:</strong><br>
        COD</p>

        <p><strong>Notes:</strong><br>
        Terima kasih sudah melakukan pemesanan desain di KakaKiky Media.</p>
    </div>
</body>
</html>
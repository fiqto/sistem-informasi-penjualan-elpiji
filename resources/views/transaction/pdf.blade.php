<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan {{ $transaction_type }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }
    
        p {
            margin: 0pt;
        }
    
        table.items {
            border: 0.1mm solid #e7e7e7;
        }
    
        td {
            vertical-align: top;
        }
    
        .items td {
            border-left: 0.1mm solid #e7e7e7;
            border-right: 0.1mm solid #e7e7e7;
        }
    
        table thead td {
            text-align: center;
            border: 0.1mm solid #e7e7e7;
        }
    
        .items td.blanktotal {
            background-color: #EEEEEE;
            border: 0.1mm solid #e7e7e7;
            background-color: #FFFFFF;
            border: 0mm none #e7e7e7;
            border-top: 0.1mm solid #e7e7e7;
            border-right: 0.1mm solid #e7e7e7;
        }
    
        .items td.totals {
            text-align: right;
            border: 0.1mm solid #e7e7e7;
        }
    
        .items td.cost {
            text-align: "."center;
        }
        </style>
</head>

<body>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="100%" style="text-align: center; font-size: 20px; font-weight: bold; padding: 0px;">
              Laporan {{ $transaction_type }} <br> Pangkalan Elpiji Herman 3Kg
            </td>
        </tr>
        <tr>
          <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="100%" style="border: 0.1mm solid #eee; text-align: left;"><strong>Pangkalan Elpiji Herman</strong><br>Jl. Jenggolo 2B/8,<br> Pucang, Kabupaten Sidoarjo,<br>Jawa Timur 61219<br><br><strong>Telephone:</strong> +62 822-1002-6245<br></td>
        </tr>
    </table>
    <br>
   
    <br>
    <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
        <thead>
            <tr>
                <td style="text-align: center;"><strong>No</strong></td>
                <td style="text-align: center;"><strong>Nama Pelanggan</strong></td>
                <td style="text-align: center;"><strong>Nama Barang</strong></td>
                <td style="text-align: center;"><strong>Tanggal Transaksi</strong></td>
                <td style="text-align: center;"><strong>Status</strong></td>
                <td style="text-align: center;"><strong>Harga Satuan Beli</strong></td>
                @if ( $transaction_type == "Penjualan")
                <td style="text-align: center;"><strong>Harga Satuan Jual</strong></td>
                @endif
                <td style="text-align: center;"><strong>Jumlah</strong></td>
                <td style="text-align: center;"><strong>Total Harga</strong></td>
                @if ( $transaction_type == "Penjualan")
                <td style="text-align: center;"><strong>Total Keuntungan</strong></td>
                @endif
            </tr>
        </thead>
        <tbody>
            <!-- ITEMS HERE -->
            @foreach ($transactions as $transaction)
            <tr>
                <td style="padding: 0px 5px; line-height: 20px; text-align: center;">{{ $loop->iteration }}</td>
                <td style="padding: 0px 5px; line-height: 20px; text-align: center;">{{ $transaction->members->member_name }}</td>
                <td style="padding: 0px 5px; line-height: 20px; text-align: center;">{{ $transaction->stocks->product_name }}</td>
                <td style="padding: 0px 5px; line-height: 20px; text-align: center;">{{ $transaction->transaction_date }}</td>
                <td style="padding: 0px 5px; line-height: 20px; text-align: center;">{{ $transaction->status }}</td>
                @if ( $transaction_type == "Penjualan")
                <td style="padding: 0px 5px; line-height: 20px; text-align: center;">Rp.{{ number_format($transaction->stocks->purchase_price, 0, ',', '.') }}</td>
                @endif
                <td style="padding: 0px 5px; line-height: 20px; text-align: center;">Rp.{{ number_format($transaction->price, 0, ',', '.') }}</td>
                <td style="padding: 0px 5px; line-height: 20px; text-align: center;">{{ $transaction->quantity }}</td>
                <td style="padding: 0px 5px; line-height: 20px; text-align: center;">Rp.{{ number_format($transaction->quantity * $transaction->price, 0, ',', '.') }}</td>
                @if ( $transaction_type == "Penjualan")
                <td style="padding: 0px 5px; line-height: 20px; text-align: center;">Rp.{{ number_format(($transaction->quantity * $transaction->price)-($transaction->quantity * $transaction->stocks->purchase_price), 0, ',', '.') }}</td>
                @endif
                
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                @if ( $transaction_type == "Penjualan")
                <td colspan="8" style="padding: 0px 5px; line-height: 20px; text-align: center;">Total</td>
                @else
                <td colspan="7" style="padding: 0px 5px; line-height: 20px; text-align: center;">Total</td>
                @endif
                <td style="padding: 0px 5px; line-height: 20px; text-align: center;">Rp.{{ number_format($total_transaksi, 0, ',', '.') }}</td>
                @if ( $transaction_type == "Penjualan")
                <td style="padding: 0px 5px; line-height: 20px; text-align: center;">Rp.{{ number_format($total_pendapatan, 0, ',', '.') }}</td>
                @endif
            </tr>
        </tfoot>
    </table>
    <br>

    <br>

</body>
</html>
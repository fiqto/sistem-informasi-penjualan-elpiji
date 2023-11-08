<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Nota Penjualan</title>
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
              Pangkalan Elpiji Herman 3Kg
            </td>
        </tr>
        <tr>
          <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="49%" style="border: 0.1mm solid #eee;">Kode Transaksi : {{ $transaction->transaction_code }}<br>Tanggal Transaksi : {{ $transaction->transaction_date }}<br>Nama : {{ $transaction->members->member_name }}<br>Alamat : {{ $transaction->members->address }}<br>Telepon : {{ $transaction->members->phone_number }}<br></td>
            <td width="2%">&nbsp;</td>
            <td width="49%" style="border: 0.1mm solid #eee; text-align: right;"><strong>Pangkalan Elpiji Herman</strong><br>Jl. Jenggolo 2B/8,<br> Pucang, Kabupaten Sidoarjo,<br>Jawa Timur 61219<br><br><strong>Telepon :</strong> +62 822-1002-6245<br></td>
        </tr>
    </table>
    <br>
   
    <br>
    <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
        <thead>
            <tr>
                <td width="10%" style="text-align: center;"><strong>No</strong></td>
                <td width="30%" style="text-align: center;"><strong>Nama Barang</strong></td>
                <td width="20%" style="text-align: center;"><strong>Jumlah Barang</strong></td>
                <td width="20%" style="text-align: center;"><strong>Harga Satuan</strong></td>
                <td width="20%" style="text-align: center;"><strong>Total Harga</strong></td>
            </tr>
        </thead>
        <tbody>
            @php
                $totalHarga = 0;
                $nomor = 1;
            @endphp
            @foreach($transactiondetails as $detail)
                @if($detail->transaction_id == $transaction->id)
                <tr>
                    <td style="padding: 0px 5px; line-height: 20px; text-align: center;">{{ $nomor++ }}</td>
                    <td style="padding: 0px 5px; line-height: 20px; text-align: center;">{{ $detail->stocks()->first()->product_name }}</td>
                    <td style="padding: 0px 5px; line-height: 20px; text-align: center;">{{ $detail->quantity }}</td>
                    <td style="padding: 0px 5px; line-height: 20px; text-align: center;">Rp.{{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td style="padding: 0px 5px; line-height: 20px; text-align: center;">Rp.{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}</td>
                </tr>
                @php
                    $totalHarga += $detail->quantity * $detail->price;
                @endphp
                @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Total :</strong></td>
                <td style="text-align: center;">Rp.{{ number_format($totalHarga, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    <br>

    <br>

</body>
</html>
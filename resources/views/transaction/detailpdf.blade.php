<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Nota Transaksi</title>
</head>

<body class="bg-gray-100">
  <div class="container px-4 py-8 mx-auto">
    <div class="px-10 py-6 bg-white rounded-lg shadow-md">
      <h2 class="mb-4 text-2xl font-semibold">Nota Transaksi</h2>
      <div class="flex justify-between mb-4">
        <div>
          <p class="font-semibold">Nama Pelanggan:</p>
          <p>
            @foreach($transaction->members()->get() as $member)
            {{ $member->member_name }}
            @endforeach
          </p>
        </div>
        <div>
          <p class="font-semibold">Tanggal:</p>
          <p>
            {{ $transaction->transaction_date }}
          </p>
        </div>
      </div>
      <table class="w-full mb-4">
        <thead>
          <tr>
            <th class="py-2">No.</th>
            <th class="py-2">Produk</th>
            <th class="py-2">Harga</th>
            <th class="py-2">Jumlah</th>
            <th class="py-2">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="py-2">1</td>
            <td class="py-2">Elpiji 3kg</td>
            <td class="py-2">Rp.{{ number_format($transaction->price, 0, ',', '.') }}</td>
            <td class="py-2">{{ $transaction->quantity }}</td>
            <td class="py-2">Rp.{{ number_format($transaction->quantity * $transaction->price, 0, ',', '.') }}</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" class="py-2 font-semibold">Total:</td>
            <td class="py-2 font-semibold">Rp.{{ number_format($transaction->quantity * $transaction->price, 0, ',', '.') }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</body>

</html>

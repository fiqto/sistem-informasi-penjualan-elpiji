<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        /* Tambahkan gaya CSS yang diperlukan untuk PDF */
    </style>
</head>
<body>
    <h1>Laporan Transaksi</h1>
    
    <div class="flex-auto px-6 pt-0 pb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                            No.
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                            Nama Pelanggan
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                            Tanggal Transaksi
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                            Status
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                            Jumlah Barang
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                            Harga Satuan Beli
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                            Harga Satuan Jual
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                            Total Harga
                        </th>
                    </tr>
                </thead>
            
                <tbody class="divide-y divide-gray-100">
                    @foreach($transactions as $transaction)
                    <tr>
                        <td class="p-4 text-left text-gray-900 whitespace-nowrap">
                            {{ $loop->iteration }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                            @foreach($transaction->members()->get() as $member)
                            {{ $member->member_name }}
                            @endforeach
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                            {{ $transaction->transaction_date }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                            @if ($transaction->status == "Lunas")
                            <strong class="bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs">
                                Lunas
                            </strong>
                            @else
                            <strong class="bg-red-100 text-red-700 px-3 py-1.5 rounded-full text-xs">
                                Belum Lunas
                            </strong>
                            @endif
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                            {{ $transaction->quantity }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          @foreach($transaction->stocks()->get() as $stock)
                            Rp.{{ number_format(($stock->purchase_price), 0, ',', '.') }}
                          @endforeach
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                            Rp.{{ number_format($transaction->price, 0, ',', '.') }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                            Rp.{{ number_format($transaction->quantity * $transaction->price, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                  <p class="py-2 ">Total Transaksi : Rp.{{ number_format($total_transaksi, 0, ',', '.') }}</p>
                  {{-- <p class="py-2 ">Total Keuntungan: Rp.{{ number_format($total_untung, 0, ',', '.') }}</p> --}}
            </table>
        </div>          
    </div>
</body>
</html>

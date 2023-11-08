<x-app-layout>
 <div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
       <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2 lg:grid-cols-4">
          <div class="flex items-center justify-center h-24 bg-white rounded dark:bg-gray-800">
            <div class="text-center">
            <p class="mb-0 font-sans text-sm font-semibold leading-normal text-gray-900 uppercase opacity-60">Terjual Hari Ini</p>
            <h5 class="mb-2 text-2xl font-bold text-blue-500">{{ $totalPenjualan }}</h5>
            </div>
          </div>
          <div class="flex items-center justify-center h-24 bg-white rounded dark:bg-gray-800">
            <div class="text-center">
            <p class="mb-0 font-sans text-sm font-semibold leading-normal text-gray-900 uppercase opacity-60">Pendapatan Hari Ini</p>
            <h5 class="mb-2 text-2xl font-bold text-blue-500">Rp.{{ number_format($totalPendapatan, 0, ',', '.') }}</h5>
            </div>
          </div>
          <div class="flex items-center justify-center h-24 bg-white rounded dark:bg-gray-800">
            <div class="text-center">
            <p class="mb-0 font-sans text-sm font-semibold leading-normal text-gray-900 uppercase opacity-60">Jumlah Pelanggan</p>
            <h5 class="mb-2 text-2xl font-bold text-blue-500">{{ $members }}</h5>
            </div>
          </div>
          <div class="flex items-center justify-center h-24 bg-white rounded dark:bg-gray-800">
            <div class="text-center">
            <p class="mb-0 font-sans text-sm font-semibold leading-normal text-gray-900 uppercase opacity-60">Jumlah Pegawai</p>
            <h5 class="mb-2 text-2xl font-bold text-blue-500">{{ $users }}</h5>
            </div>
          </div>
       </div>
       <div class="grid grid-cols-1">
         <div class="relative items-center justify-center col-span-2 mb-4 text-center bg-white rounded h-min-48 dark:bg-gray-800">
            <p class="mt-4 font-sans text-sm font-semibold leading-normal text-gray-900 uppercase opacity-60">Bagan Penjualan Bulanan</p>
            <div class="w-4/5 mx-auto my-4 overflow-hidden">
              <canvas
                data-te-chart="bar"
                data-te-dataset-label="Jumlah Elpiji Terjual"
                data-te-labels="['{{ $elevenMonthsAgo }}', '{{ $tenMonthsAgo }}', '{{ $nineMonthsAgo }}', '{{ $eightMonthsAgo }}', '{{ $sevenMonthsAgo }}', '{{ $sixMonthsAgo }}', '{{ $fiveMonthsAgo }}' , '{{ $fourMonthsAgo }}' , '{{ $threeMonthsAgo }}' , '{{ $twoMonthsAgo }}' , '{{ $lastMonth }}' , '{{ $thisMonth }}']"
                data-te-dataset-data="[{{ $totalElevenMonthsAgo }}, {{ $totalTenMonthsAgo }}, {{ $totalNineMonthsAgo }}, {{ $totalEightMonthsAgo }}, {{ $totalSevenMonthsAgo }}, {{ $totalSixMonthsAgo }}, {{ $totalFiveMonthsAgo }} , {{ $totalFourMonthsAgo }} , {{ $totalThreeMonthsAgo }} , {{ $totalTwoMonthsAgo }} , {{ $totalLastMonth }} , {{ $totalThisMonth }}]">
              </canvas>
            </div>
         </div>
         
       </div>
       <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
          <div class="relative items-center justify-center col-span-1 mb-4 text-center bg-white rounded item-center h-min-48 dark:bg-gray-800">
            <p class="mt-4 font-sans text-sm font-semibold leading-normal text-gray-900 uppercase opacity-60">Daftar Stok Barang</p>
            <div class="flex-auto px-6 pt-4 pb-6">
            <div class="overflow-x-auto">
              <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead>
                    <tr>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        No.
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Nama Barang
                        </div>
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Jumlah Stok
                        </div>
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Harga Beli
                        </div>
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Harga Jual
                        </div>
                      </th>
                    </tr>
                </thead>
              
                <tbody class="divide-y divide-gray-100">
                  @foreach($stocks as $stock)
                    <tr>
                      <td class="p-4 text-left text-gray-900 whitespace-nowrap">
                        {{ $loop->iteration }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        {{ $stock->product_name }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        {{ $stock->stock }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        Rp.{{ number_format($stock->purchase_price, 0, ',', '.') }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        Rp.{{ number_format($stock->selling_price, 0, ',', '.') }}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>          
            </div>
          </div>
          <div class="relative items-center justify-center text-center bg-white rounded item-center h-min-28 dark:bg-gray-800">
             <p class="mt-4 font-sans text-sm font-semibold leading-normal text-gray-900 uppercase opacity-60">Daftar Transaksi Pinjam Tabung</p>
             <div class="flex-auto px-6 pt-4 pb-6">
              <div class="overflow-x-auto">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                  <thead>
                      <tr>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          No.
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Kode Transaksi
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Tanggal Transaksi
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Nama Barang
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Jumlah Barang
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Pinjam Barang
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Keterangan Transaksi
                          </div>
                        </th>
                      </tr>
                  </thead>
                
                  <tbody class="divide-y divide-gray-100">
                    @foreach($statusHutang as $transaction)
                      <tr>
                        <td class="p-4 text-left text-gray-900 whitespace-nowrap">
                          {{ $loop->iteration }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->transactions()->first()->transaction_code }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->transactions()->first()->transaction_date }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->stocks()->first()->product_name }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->quantity }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->debt_quantity }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->transactions()->first()->order_notes }}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>          
            </div>
          </div>
       </div>
    </div>
 </div>
</x-app-layout>

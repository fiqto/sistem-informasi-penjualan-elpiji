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
       <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
         <div class="relative items-center justify-center col-span-2 mb-4 text-center bg-white rounded h-min-48 dark:bg-gray-800">
            <p class="mt-4 font-sans text-sm font-semibold leading-normal text-gray-900 uppercase opacity-60">Bagan Penjualan Perharian</p>
            <div class="w-4/5 mx-auto my-4 overflow-hidden">
              <canvas
                data-te-chart="bar"
                data-te-dataset-label="Jumlah Elpiji Terjual"
                data-te-labels="['{{ $sixDaysAgo }}', '{{ $fiveDaysAgo }}' , '{{ $fourDaysAgo }}' , '{{ $threeDaysAgo }}' , '{{ $twoDaysAgo }}' , '{{ $yesterday }}' , '{{ $currentDate }}']"
                data-te-dataset-data="[{{ $totalSixDaysAgo }}, {{ $totalFiveDaysAgo }} , {{ $totalFourDaysAgo }} , {{ $totalThreeDaysAgo }} , {{ $totalTwoDaysAgo }} , {{ $totalYesterday }} , {{ $totalPenjualan }}]">
              </canvas>
            </div>
         </div>
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
       </div>
       <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
          <div class="relative items-center justify-center text-center bg-white rounded item-center h-min-28 dark:bg-gray-800">
             <p class="mt-4 font-sans text-sm font-semibold leading-normal text-gray-900 uppercase opacity-60">Daftar Transaksi Lunas</p>
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
                            Tipe Transaksi
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Nama Pelanggan
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Nama Barang
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Tanggal Transaksi
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Status
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Total Item
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Harga Satuan
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Total Harga
                          </div>
                        </th>
                      </tr>
                  </thead>
                
                  <tbody class="divide-y divide-gray-100">
                    @foreach($statusLunas as $transaction)
                      <tr>
                        <td class="p-4 text-left text-gray-900 whitespace-nowrap">
                          {{ $loop->iteration }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->transaction_type }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          @foreach($transaction->members()->get() as $member)
                          {{ $member->member_name }}
                          @endforeach
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->stocks()->first()->product_name }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->transaction_date }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          @if ($transaction->status == "Lunas")
                          <strong
                          class="bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs"
                          >
                          Lunas
                          </strong>
                          @else
                          <strong
                          class="bg-red-100 text-red-700 px-3 py-1.5 rounded-full text-xs"
                          >
                          Belum Lunas
                          </strong>
                          @endif
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->quantity }}
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
                </table>
              </div>          
            </div>
          </div>
          <div class="relative items-center justify-center text-center bg-white rounded item-center h-min-28 dark:bg-gray-800">
             <p class="mt-4 font-sans text-sm font-semibold leading-normal text-gray-900 uppercase opacity-60">Daftar Transaksi Belum Lunas</p>
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
                            Tipe Transaksi
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Nama Pelanggan
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Nama Barang
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Tanggal Transaksi
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Status
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Total Item
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Harga Satuan
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Total Harga
                          </div>
                        </th>
                      </tr>
                  </thead>
                
                  <tbody class="divide-y divide-gray-100">
                    @foreach($statusBelum as $transaction)
                      <tr>
                        <td class="p-4 text-left text-gray-900 whitespace-nowrap">
                          {{ $loop->iteration }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->transaction_type }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          @foreach($transaction->members()->get() as $member)
                          {{ $member->member_name }}
                          @endforeach
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->stocks()->first()->product_name }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->transaction_date }}
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          @if ($transaction->status == "Lunas")
                          <strong
                          class="bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs"
                          >
                          Lunas
                          </strong>
                          @else
                          <strong
                          class="bg-red-100 text-red-700 px-3 py-1.5 rounded-full text-xs"
                          >
                          Belum Lunas
                          </strong>
                          @endif
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          {{ $transaction->quantity }}
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
                </table>
              </div>          
            </div>
          </div>
       </div>
    </div>
 </div>
</x-app-layout>

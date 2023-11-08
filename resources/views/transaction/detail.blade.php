<x-app-layout>
    <div class="p-4 sm:ml-64">
      <div class="p-4 mt-14">
        <div class="relative items-center justify-center p-8 mb-4 bg-white rounded min-h-48 dark:bg-gray-800">
          <div class="px-6 pt-4">
            <p class="mb-4 text-2xl text-gray-900 dark:text-gray-500">Detail Transaksi</p>
          </div>
          <form class="space-y-6" action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 gap-3 mb-4 md:grid-cols-2 lg:grid-cols-3">
                  <div class="mb-6">
                    <label for="member_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Transaksi</label>
                    <input disabled id="transaction_code" name="transaction_code" value="{{ old('transaction_code', $transaction->transaction_code) }}" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                  </div>
                  <div class="mb-6">
                    <label for="member_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Pelanggan</label>
                    <select disabled required id="member_id" name="member_id" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                      <option selected value="{{ old('member_id', $transaction->member_id) }}">
                        @foreach($transaction->members()->get() as $member)
                        {{ $member->member_name }}
                        @endforeach
                      </option>
                      @foreach ($members as $member)
                        @if ( old('member_id', $transaction->member_id) !=  $member->id )
                          <option value={{ $member->id }}>{{ $member->member_name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-6">
                    <label for="transaction_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tanggal Transaksi</label>
                        <div class="relative max-w-sm">
                          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                          </div>
                          <input disabled datepicker datepicker-format="yyyy/mm/dd" type="text" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', $transaction->transaction_date) }}" required class="border border-gray-200 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih Tanggal">
                        </div>
                  </div>
                  <div class="mb-6">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                    <select id="status" name="status" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                      <option selected value="{{ old('status', $transaction->status) }}">{{ old('status', $transaction->status) }}</option>
                      @if ( old('status', $transaction->status) =="Lunas")
                        <option  value="Batal">Batal</option>
                      @else
                        <option  value="Lunas">Lunas</option>
                      @endif
                    </select>
                  </div>
                  <div class="mb-6">
                    <label for="order_notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan Pesanan</label>
                    <textarea id="order_notes" name="order_notes" rows="4" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Catatan ...">{{ old('order_notes', $transaction->order_notes) }}</textarea>
                  </div>
                </div>
                <div class="text-left">
                  <button type="submit" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Simpan Transaksi</button>
                </div>
            </div>
          </form>
          
          <div class="px-6 pt-4">
            <p class="mb-4 text-2xl text-gray-900 dark:text-gray-500">Daftar Barang</p>
          </div>
          <div class="flex-auto px-6 pt-0 pb-6">
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
                          Harga Satuan
                        </div>
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Total Harga
                        </div>
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Aksi
                        </div>
                      </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="transactionTableBody">
                  @php
                    $totalHarga = 0;
                  @endphp
                  @foreach($transactiondetails as $detail)
                    @if($detail->transaction_id == $transaction->id)
                    <tr>
                      <td class="p-4 text-left text-gray-900 whitespace-nowrap">
                        {{ $loop->iteration }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        {{ $detail->stocks()->first()->product_name }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        {{ $detail->quantity }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        {{ $detail->debt_quantity }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        Rp.{{ number_format($detail->price, 0, ',', '.') }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        Rp.{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}
                        @php
                            $totalHarga += $detail->quantity * $detail->price;
                        @endphp
                      </td>
                      <td class="p-4 text-sm text-gray-700 whitespace-nowrap">                                
                        <div class="inline-flex rounded-md" role="group">
                          <button type="button" data-modal-target="editModal{{ $detail->id }}" data-modal-toggle="editModal{{ $detail->id }}" class="text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-4 focus:ring-yellow-400 font-medium rounded-full text-sm px-2.5 py-2.5 text-center mr-1 my-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                          </button>
                        </div>
                      </td>
                    </tr>
                    @endif
                  @endforeach
                </tbody>
              </table>
              <div class="mt-4 text-right">
                <p class="text-gray-900">Total: Rp.{{ number_format($totalHarga, 0, ',', '.') }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
  @foreach($transactiondetails as $detail)
  {{-- Modal Edit --}}
  <div id="editModal{{ $detail->id }}" data-modal-placement="center-center" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="editModal{{ $detail->id }}">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
              <form class="space-y-6" action="{{ route('transaction-detail.update', $detail->id) }}" method="POST">
                @csrf
                @method('PUT')
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Barang</h3>
                <div class="mb-6">
                  <label for="debt_quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pinjam Barang</label>
                  <input type="number" id="debt_quantity" name="debt_quantity" value="{{ old('debt_quantity', $detail->debt_quantity) }}" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Pinjam Barang">
                </div>
                <div class="text-left">
                  <button type="submit" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Simpan</button>
                  <button type="button" data-modal-hide="editModal{{ $detail->id }}" class="text-blue-500 bg-blue-50 hover:bg-blue-100 hover:text-blue-600 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Batal</button>
                </div>  
              </form>
            </div>
        </div>
    </div>
  </div>
  @endforeach

</x-app-layout>
  
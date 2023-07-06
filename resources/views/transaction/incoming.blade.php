<x-app-layout>
  <div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
      <div class="relative items-center justify-center p-8 mb-4 bg-white rounded min-h-48 dark:bg-gray-800">
        <div class="px-6 py-4">
          <p class="mb-4 text-2xl text-gray-900 dark:text-gray-500">Daftar Pembelian LPG</p>
          <a href="{{ route('transactions.create') }}" type="button" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
            </svg>
            Tambah Transaksi
          </a>
          <button data-modal-target="print-modal" data-modal-toggle="print-modal" type="button" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 mr-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-2 text-gray-500">
              <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z" clip-rule="evenodd" />
            </svg>
            Cetak Laporan
          </button>
        </div>

          <p class="px-6 pt-4 text-sm text-left text-gray-900">Filter</p>
          
          {{-- Search --}}
          <form action="{{ route('transactions.purchase') }}" class="form" method="GET">
            <div class="flex px-5 w-full pt-2 pb-4">
                <div class="relative w-full">
                    <input type="text" name="search" id="search" value="{{ old('search') }}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border-gray-300 dark:placeholder-gray-400" placeholder="Search">
                    <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-[#4285F4] hover:bg-[#4285F4]/90 rounded-r-lg border border-blue-700">
                        <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
          </form>
          
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
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Catatan Pesanan
                        </div>
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Aksi
                        </div>
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
                        {{ $transaction->members()->first()->member_name }}
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
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        {{ $transaction->order_notes }}
                      </td>
                      <td class="p-4 text-sm text-gray-700 whitespace-nowrap">                                
                        <div class="inline-flex rounded-md" role="group">
                          <button type="button" data-modal-target="#deleteModal{{ $transaction->id }}" data-modal-toggle="deleteModal{{ $transaction->id }}" class="text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-4 focus:ring-red-400 font-medium rounded-full text-sm px-2.5 py-2.5 text-center mr-1 my-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                          </button>
                          <button type="button" data-modal-target="#editModal{{ $transaction->id }}" data-modal-toggle="editModal{{ $transaction->id }}" class="text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-4 focus:ring-yellow-400 font-medium rounded-full text-sm px-2.5 py-2.5 text-center mr-1 my-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                          </button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{-- Pagination --}}
            {{ $transactions->links() }}  
                    
          </div>

      </div>
    </div>
  </div>

  {{-- Modal Print --}}
  <div id="print-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="print-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Cetak Laporan</h3>
                <form action="{{ route('print') }}" target="_blank" method="POST">
                  @csrf
                  {{-- Tipe Transaksi Hidden --}}
                  <input type="hidden" id="transaction_type" name="transaction_type" value="Pembelian" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                  {{-- <div class="mb-6">
                    <label for="stock_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Barang</label>
                    <select id="stock_id" name="stock_id" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                      <option selected value="0">Semua Barang</option>
                      @foreach ($stocks as $stock)
                      <option value={{ $stock->id }}>{{ $stock->product_name }} - {{ $stock->stock }}</option>
                      @endforeach
                    </select>
                  </div> --}}
                  <div class="mb-6">
                    <label for="transaction_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tanggal Transaksi</label>
                    <div date-rangepicker class="flex items-center mb-6">
                      <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input name="start" type="text" class="border border-gray-200 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                      </div>
                      <span class="mx-4 text-gray-500">to</span>
                      <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input name="end" type="text" class="border border-gray-200 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                      </div>
                    </div>
                  </div>
                  
                  <div class="text-left">
                    <button type="submit" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Cetak Laporan</button>
                    <button type="button" data-modal-hide="print-modal" class="text-blue-500 bg-blue-50 hover:bg-blue-100 hover:text-blue-600 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Batal</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </div>

  @foreach($transactions as $transaction)
  {{-- Modal Delete --}}
  <div id="deleteModal{{ $transaction->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="deleteModal{{ $transaction->id }}">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah kamu yakin menghapus data ini?</h3>
                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="inline-block">
                  @csrf
                  @method('delete')
                  <button data-modal-hide="deleteModal{{ $transaction->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                      Iya, Saya Yakin
                  </button>
                  </form>
                <button data-modal-hide="deleteModal{{ $transaction->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak, Batalkan</button>
            </div>
        </div>
    </div>
  </div>

  {{-- Modal Edit --}}
  <div id="editModal{{ $transaction->id }}" data-modal-placement="top-center" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="editModal{{ $transaction->id }}">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Akun</h3>
                <form class="space-y-6" action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="transaction_type" name="transaction_type" value="{{ old('transaction_type', $transaction->transaction_type) }}" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                <div class="mb-6">
                  <label for="member_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                  <select required id="member_id" name="member_id" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
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
                  <label for="stock_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Barang</label>
                  <select required id="stock_id" name="stock_id" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                    <option selected value="{{ old('stock_id', $transaction->stock_id) }}">
                      @foreach($transaction->stocks()->get() as $stock)
                      {{ $stock->product_name }}
                      @endforeach
                    </option>
                    @foreach ($stocks as $stock)
                      @if ( old('stock_id', $transaction->stock_id) !=  $stock->id )
                        <option value={{ $stock->id }}>{{ $stock->product_name }}</option>
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
                        <input datepicker datepicker-format="yyyy/mm/dd" type="text" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', $transaction->transaction_date) }}" required class="border border-gray-200 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih Tanggal">
                      </div>
                </div>
                <div class="mb-6">
                  <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total Barang</label>
                  <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $transaction->quantity) }}" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Total Barang">
                </div>
                <div class="mb-6">
                  <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Harga Satuan</label>
                  <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                      Rp. 
                    </span>
                    <input type="number" id="price" name="price" value="{{ old('price', $transaction->price) }}" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-none rounded-r-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Harga Satuan">
                  </div>
                </div>
                <div class="mb-6">
                  <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                  <select id="status" name="status" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                    <option selected value="{{ old('status', $transaction->status) }}">{{ old('status', $transaction->status) }}</option>
                    @if ( old('status', $transaction->status) =="Lunas")
                      <option  value="Belum Lunas">Belum Lunas</option>
                    @else
                      <option  value="Lunas">Lunas</option>
                    @endif
                  </select>
                </div>
                <div class="mb-6">
                  <label for="order_notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan Pesanan</label>
                  <textarea id="order_notes" name="order_notes" rows="4" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Catatan ...">{{ old('order_notes', $transaction->order_notes) }}</textarea>
                </div>
                <div class="text-left">
                  <button type="submit" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Simpan</button>
                  <button type="button" data-modal-hide="editModal{{ $transaction->id }}" class="text-blue-500 bg-blue-50 hover:bg-blue-100 hover:text-blue-600 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
  </div> 
  @endforeach
</x-app-layout>

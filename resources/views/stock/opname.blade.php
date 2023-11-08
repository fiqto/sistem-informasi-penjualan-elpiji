<x-app-layout>
  <div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
      <div class="relative items-center justify-center pt-4 mb-4 bg-white rounded sm:p-2 md:p-4 lg:p-6 xl:p-8 min-h-48 dark:bg-gray-800">
        <div class="px-6 py-4">
          <p class="mb-4 text-2xl text-gray-900 dark:text-gray-500">Penyesuaian Stok</p>
          @if(Auth::user()->is_admin == 1)
          <button data-modal-target="add-modal" data-modal-toggle="add-modal" type="button" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
            </svg>
            Tambah Penyesuaian
          </button>
          @endif
        </div>

          <p class="px-6 pt-4 text-sm text-left text-gray-900">Filter</p>
          
          {{-- Search --}}
        <form action="{{ route('stock-opname.index') }}" class="form" method="GET">
          <div class="flex w-full px-5 pt-2 pb-4">
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
                          Kode Penyesuaian
                        </div>
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Nama Barang
                        </div>
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Tanggal Penyesuaian
                        </div>
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Jumlah Stok Sebelum
                        </div>
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Jumlah Stok Sesudah
                        </div>
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Jumlah Stok Penyesuaian
                        </div>
                      </th>
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Catatan Penyesuaian
                        </div>
                      </th>
                      @if(Auth::user()->is_admin == 1)
                      <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                          Aksi
                        </div>
                      </th>
                      @endif
                    </tr>
                </thead>
              
                <tbody class="divide-y divide-gray-100">
                  @foreach($stockOpname as $opname)
                    <tr>
                      <td class="p-4 text-left text-gray-900 whitespace-nowrap">
                        {{ $loop->iteration }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        {{ $opname->opname_code }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        {{ $opname->stocks()->first()->product_name }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        {{ $opname->opname_date }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        {{ $opname->quantity_before }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        {{ $opname->quantity_after }}
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        @if ($opname->quantity_before >= $opname->quantity_after)
                          - {{ $opname->quantity_change }}
                        @else
                          + {{ $opname->quantity_change }}
                        @endif
                      </td>
                      <td class="p-4 text-gray-900 whitespace-nowrap">
                        {{ $opname->opname_note }}
                      </td>
                      @if(Auth::user()->is_admin == 1)
                      <td class="p-4 text-sm text-gray-700 whitespace-nowrap">                                
                        <div class="inline-flex rounded-md" role="group">
                          {{-- <button type="button" data-modal-target="deleteModal{{ $opname->id }}" data-modal-toggle="deleteModal{{ $opname->id }}" class="text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-4 focus:ring-red-400 font-medium rounded-full text-sm px-2.5 py-2.5 text-center mr-1 my-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                          </button>  --}}
                          <button type="button" data-modal-target="editModal{{ $opname->id }}" data-modal-toggle="editModal{{ $opname->id }}" class="text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-4 focus:ring-yellow-400 font-medium rounded-full text-sm px-2.5 py-2.5 text-center mr-1 my-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                          </button>
                        </div>
                      </td>
                      @endif
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{-- Pagination --}}
            {{ $stockOpname->links() }}
                      
          </div>

      </div>
    </div>
  </div>

  {{-- Modal Add --}}
  <div id="add-modal" data-modal-placement="top-center" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="add-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Tambah Penyesuaian</h3>
                <form action="{{ route('stock-opname.store') }}" method="POST">
                  @csrf
                  @method('POST')
                  <div class="mb-6">
                    <label for="opname_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Penyesuaian</label>
                    <input required readonly type="text" id="opname_code" name="opname_code" rows="4" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Kode Penyesuaian">
                  </div>
                  <div class="mb-6">
                    <label for="stock_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Barang</label>
                    <select required id="stock_id" name="stock_id" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                      <option selected value="">Pilih Barang</option>
                      @foreach ($stocks as $stock)
                      <option value={{ $stock->id }}>{{ $stock->product_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-6">
                    <label for="opname_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tanggal Transaksi</label>
                      <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                          <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input readonly type="text" id="opname_date" name="opname_date" required value="{{ date('Y-m-d') }}" class="pl-10 p-2.5 block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Pilih Tanggal">
                      </div>
                  </div>
                  <div class="mb-6">
                    <label for="quantity_after" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Jumlah Stok Gudang</label>
                    <div class="flex">
                      <input type="number" id="quantity_after" name="quantity_after" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-none rounded-r-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Jumlah Stok Gudang">
                      @error('quantity_after')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="mb-6">
                    <label for="opname_note" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan Penyesuaian</label>
                    <textarea id="opname_note" name="opname_note" rows="4" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Catatan ..."></textarea>
                  </div>
                  <div class="text-left">
                    <button type="submit" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Simpan</button>
                    <button type="button" data-modal-hide="add-modal" class="text-blue-500 bg-blue-50 hover:bg-blue-100 hover:text-blue-600 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Batal</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </div>

  @foreach($stockOpname as $opname)
  {{-- Modal Delete --}}
  <div id="deleteModal{{ $opname->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="deleteModal{{ $opname->id }}">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah kamu yakin menghapus data ini?</h3>
                <form action="{{ route('stock-opname.destroy', $opname->id) }}" method="POST" class="inline-block">
                  @csrf
                  @method('delete')
                  <button data-modal-hide="deleteModal{{ $opname->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                      Iya, Saya Yakin
                  </button>
                  </form>
                <button data-modal-hide="deleteModal{{ $opname->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak, Batalkan</button>
            </div>
        </div>
    </div>
  </div>

  {{-- Modal Edit --}}
  <div id="editModal{{ $opname->id }}" data-modal-placement="top-center" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="editModal{{ $opname->id }}">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Barang</h3>
                <form class="space-y-6" action="{{ route('stock-opname.update', $opname->id) }}" method="POST">
                @csrf
                @method('PUT')
                  <div class="mb-6">
                    <label for="opname_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Penyesuaian</label>
                    <input required readonly type="text" id="opname_code" value="{{ old('opname_code', $opname->opname_code) }}" name="opname_code" rows="4" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Kode Penyesuaian">
                  </div>
                  <div class="mb-6">
                    <label for="stock_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Barang</label>
                    <select required id="stock_id" name="stock_id" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                      <option selected value={{ old('stock_id', $opname->stock_id) }}>{{ old('stock_id', $opname->stocks()->first()->product_name) }}</option>
                    </select>
                  </div>
                  <div class="mb-6">
                    <label for="opname_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tanggal Transaksi</label>
                      <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                          <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input readonly type="text" id="opname_date" name="opname_date" required value="{{ old('opname_date', $opname->opname_date) }}" class="pl-10 p-2.5 block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Pilih Tanggal">
                      </div>
                  </div>
                  <div class="mb-6">
                    <label for="quantity_after" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Jumlah Stok Gudang</label>
                    <div class="flex">
                      <input type="number" id="quantity_after" name="quantity_after" required value="{{ old('quantity_after', $opname->quantity_after) }}" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-none rounded-r-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Jumlah Stok Gudang">
                      @error('quantity_after')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="mb-6">
                    <label for="opname_note" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan Penyesuaian</label>
                    <textarea id="opname_note" name="opname_note" rows="4" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Catatan ...">{{ old('opname_note', $opname->opname_note) }}</textarea>
                  </div>
                  <div class="text-left">
                    <button type="submit" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Simpan</button>
                    <button type="button" data-modal-hide="add-modal" class="text-blue-500 bg-blue-50 hover:bg-blue-100 hover:text-blue-600 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Batal</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </div> 
  @endforeach

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      updateTransactionCode(); // Call the function when the page loads
    });
  
    function updateTransactionCode() {
      const transactionCodeInput = document.getElementById("opname_code");
      transactionCodeInput.value = "STO-" + generateRandomNumber();
    }
  
    function generateRandomNumber() {
      return Math.floor(Math.random() * 10000); // Adjust as needed for the random number range
    }
  </script>
</x-app-layout>

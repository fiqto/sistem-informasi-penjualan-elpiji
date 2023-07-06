<x-app-layout>
    <div class="p-4 sm:ml-64">
      <div class="p-4 mt-14">
        <div class="relative items-center justify-center p-8 mb-4 bg-white rounded min-h-48 dark:bg-gray-800">
          <div class="px-6 pt-4">
            <p class="mb-4 text-2xl text-gray-900 dark:text-gray-500">Tambah Transaksi</p>
          </div>
          <div class="px-6 py-4">
            <form action="{{ route('transactions.store') }}" method="POST">
              @csrf
              @method('POST')
              <div class="mb-6">
                <label for="transaction_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Tipe Transaksi</label>
                <select required id="transaction_type" name="transaction_type" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                  <option selected value="">Pilih Tipe Transaksi</option>
                  <option value="Pembelian">Pembelian</option>
                  <option value="Penjualan">Penjualan</option>
                </select>
              </div>
              <div class="mb-6">
                  <label for="member_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Pelanggan</label>
                  <select required id="member_id" name="member_id" class="block w-full select2 px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                    <option selected value="">Pilih Pelanggan</option>
                    @foreach ($members as $member)
                    <option value={{ $member->id }}>{{ $member->member_name }}</option>
                    @endforeach
                  </select>
              </div>
              <div class="mb-6">
                <label for="stock_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Barang</label>
                <select required id="stock_id" name="stock_id" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                  <option selected value="">Pilih Barang</option>
                  @foreach ($stocks as $stock)
                  <option value={{ $stock->id }}>{{ $stock->product_name }} - {{ $stock->stock }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-6">
                <label for="transaction_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tanggal Transaksi</label>
                  <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                      <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input datepicker datepicker-format="yyyy/mm/dd" type="text" id="transaction_date" name="transaction_date" required value="{{ date('Y-m-d') }}" class="border border-gray-200 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih Tanggal">
                  </div>
              </div>
              <div class="mb-6">
                <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total Barang</label>
                <input type="number" id="quantity" name="quantity" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Total Barang">
              </div>
              <div class="mb-6">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Harga Satuan</label>
                <div class="flex">
                  <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    Rp. 
                  </span>
                  <input type="number" id="price" name="price" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-none rounded-r-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Harga Satuan">
                </div>
                
              </div>
              <div class="mb-6">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Status</label>
                  <select id="status" name="status" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                    <option selected value="">Pilih Status</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                  </select>
              </div>
              <div class="mb-6">
                <label for="order_notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan Pesanan</label>
                <textarea id="order_notes" name="order_notes" rows="4" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Catatan ..."></textarea>
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
</x-app-layout>
  
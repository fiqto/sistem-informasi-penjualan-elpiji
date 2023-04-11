<x-app-layout>
  <div class="w-full px-6 py-6 mx-auto">
      <div class="overflow-hidden bg-white shadow-xl dark:shadow-dark-xl rounded-2xl">
          <div class="p-4 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h1 class="px-6 pt-6 text-2xl text-gray-900">Daftar Transaksi</h1>

            <div class="px-6 py-4">
              <button data-modal-target="add-modal" data-modal-toggle="add-modal" type="button" class="p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700">
              Tambah Transaksi
              </button>

              {{-- Modal Add --}}
              <div id="add-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                <div class="relative w-full h-full max-w-md md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="add-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="px-6 py-6 lg:px-8">
                            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Tambah Transaksi</h3>
                            <form action="#" method="POST">
                              @csrf
                              @method('POST')
                              <div class="mb-6">
                                  <label for="member_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Jenis Transaksi</label>
                                  <input type="text" id="member_name" name="member_name" placeholder="Nama Lengkap" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              </div>
                              <div class="mb-6">
                                  <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama Pelanggan</label>
                                  <input type="tel" id="phone_number" name="phone_number" placeholder="Nomer Telepon (+62812-3456-7890)" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              </div>
                              <div class="mb-6">
                                  <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tanggal Transaksi</label>
                                  <input type="text" id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Alamat Lengkap">
                              </div>
                              <div class="mb-6">
                                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total Barang</label>
                                <input type="text" id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Alamat Lengkap">
                              </div>
                              <div class="mb-6">
                                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total Harga</label>
                                <input type="text" id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Alamat Lengkap">
                              </div>
                              <div class="mb-6">
                                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Status</label>
                                <input type="text" id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Alamat Lengkap">
                              </div>
                              <div class="mb-6">
                                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Catatan Pesanan</label>
                                <input type="text" id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Alamat Lengkap">
                              </div>
                              <div class="text-right">
                                  <button type="submit" class="text-blue-600 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-4 focus:ring-blue-400 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Simpan</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
              </div> 

            </div>

            <p class="px-6 pt-4 text-sm text-left text-gray-900">Filter</p>

            {{-- Search --}}
            <form class="form" method="get" action="#">
              <div class="flex px-5 pt-2 pb-4">
                  <div class="relative w-full">
                      <input type="text" name="search" id="search" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border-gray-300 dark:placeholder-gray-400" placeholder="Cari Jenis Transaksi, Nama Pelanggan, Status ...">
                      <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700">
                          <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                          <span class="sr-only">Search</span>
                      </button>
                  </div>
              </div>
            </form>

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
                            Jenis Transaksi
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Nama Pelanggan
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Tanggal Transaksi
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Total Item
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Total Harga
                          </div>
                        </th>
                        <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                          <div class="flex items-center">
                            Status
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
                      <tr>
                        <td class="p-4 text-left text-gray-900 whitespace-nowrap">
                          1
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          Penjualan
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          Bu As
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          05-04-2023
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          10
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          Rp. 155.000
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          Lunas
                        </td>
                        <td class="p-4 text-gray-900 whitespace-nowrap">
                          -
                        </td>
                        <td class="p-4 text-sm text-gray-700 whitespace-nowrap">                                
                          <div class="inline-flex rounded-md" role="group">
                            <button type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-4 focus:ring-red-400 font-medium rounded-full text-sm px-2.5 py-2.5 text-center mr-1 my-2">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button> 
                            <button type="button" data-modal-target="edit-modal" data-modal-toggle="edit-modal" class="text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-4 focus:ring-blue-400 font-medium rounded-full text-sm px-2.5 py-2.5 text-center mr-1 my-2">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                            </button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>          
              </div>
          </div>
      </div>
  </div>
  
  {{-- Modal Delete --}}
  <div id="delete-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
      <div class="relative w-full h-full max-w-md md:h-auto">
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  <span class="sr-only">Close modal</span>
              </button>
              <div class="p-6 text-center">
                  <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah kamu yakin menghapus data ini?</h3>
                  <button data-modal-hide="delete-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                      Iya, Saya Yakin
                  </button>
                  <button data-modal-hide="delete-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak, Batalkan</button>
              </div>
          </div>
      </div>
  </div>

  {{-- Modal Edit --}}
  <div id="edit-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
      <div class="relative w-full h-full max-w-md md:h-auto">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="edit-modal">
                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  <span class="sr-only">Close modal</span>
              </button>
              <div class="px-6 py-6 lg:px-8">
                  <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Akun</h3>
                  <form class="space-y-6" action="#">
                      <div>  
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih opsi peran</label>
                        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                          <option selected>Pilih satu peran</option>
                          <option value="Admin">Admin</option>
                          <option value="Pegawai">Pegawai</option>
                        </select>
                      </div>
                      <button data-modal-hide="edit-modal" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                  </form>
              </div>
          </div>
      </div>
  </div> 


</x-app-layout>

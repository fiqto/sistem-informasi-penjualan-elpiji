<x-app-layout>
    <div class="w-full px-6 py-6 mx-auto">
        <div class="overflow-hidden bg-white shadow-xl dark:shadow-dark-xl rounded-2xl">
            <div class="p-4 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
              <h1 class="px-6 pt-6 text-2xl text-gray-900">Daftar Pelanggan</h1>

              <div class="px-6 py-4">
                <button data-modal-target="add-modal" data-modal-toggle="add-modal" type="button" class="p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700">
                Tambah Pelanggan
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
                              <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Tambah Pelanggan</h3>
                              <form action="{{ route('members.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="mb-6">
                                    <label for="member_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama Lengkap</label>
                                    <input type="text" id="member_name" name="member_name" placeholder="Nama Lengkap" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="mb-6">
                                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">No. Telepon</label>
                                    <input type="tel" id="phone_number" name="phone_number" placeholder="Nomer Telepon (+62812-3456-7890)" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="mb-6">
                                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Alamat Lengkap</label>
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
                        <input type="text" name="search" id="search" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border-gray-300 dark:placeholder-gray-400" placeholder="Cari Nama, No. Telepon, Alamat ...">
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
                              Nama Pelanggan
                              <span class="flex pl-4">
                                <form class="form" method="get" action="#">
                                <button type="submit" value="member_name" id="col" name="col" class="ri-arrow-up-s-line"></button>
                                </form>
                                <form class="form" method="get" action="#">
                                <button type="submit" value="member_name" id="col" name="col" class="ri-arrow-down-s-line"></button>
                                </form>
                              </span>
                            </div>
                          </th>
                          <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                              Nomor Telepon
                            </div>
                          </th>
                          <th class="p-4 text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                              Alamat Lengkap
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
                        @foreach($members as $member)
                        <tr>
                          <td class="p-4 text-left text-gray-900 whitespace-nowrap">
                            {{ $loop->iteration }}
                          </td>
                          <td class="p-4 text-gray-900 whitespace-nowrap">
                            {{ $member->member_name }}
                          </td>
                          <td class="p-4 text-gray-900 whitespace-nowrap">
                            {{ $member->phone_number }}
                          </td>
                          <td class="p-4 text-gray-900 whitespace-nowrap">
                            {{ $member->address }}
                          </td>
                          <td class="p-4 text-sm text-gray-700 whitespace-nowrap">                                
                            <div class="inline-flex rounded-md" role="group">
                              <button type="button" data-modal-target="#deleteModal{{ $member->id }}" data-modal-toggle="deleteModal{{ $member->id }}" class="text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-4 focus:ring-red-400 font-medium rounded-full text-sm px-2.5 py-2.5 text-center mr-1 my-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                              </button>

                              {{-- Modal Delete --}}
                              <div id="deleteModal{{ $member->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                <div class="relative w-full h-full max-w-md md:h-auto">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah kamu yakin menghapus data ini?</h3>
                                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('delete')
                                            <button data-modal-hide="deleteModal{{ $member->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                Iya, Saya Yakin
                                            </button>
                                            </form>
                                            <button data-modal-hide="deleteModal{{ $member->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak, Batalkan</button>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <button type="button" data-modal-target="#editModal{{ $member->id }}"  data-modal-toggle="editModal{{ $member->id }}" class="text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-4 focus:ring-blue-400 font-medium rounded-full text-sm px-2.5 py-2.5 text-center mr-1 my-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                              </button>

                              {{-- Modal Edit --}}
                              <div id="editModal{{ $member->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                <div class="relative w-full h-full max-w-md md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="editModal{{ $member->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="px-6 py-6 lg:px-8">
                                            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Pelanggan</h3>
                                            <form action="{{ route('members.update', $member->id) }}" method="POST">
                                              @csrf
                                              @method('PUT')
                                              <div class="mb-6">
                                                  <label for="member_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama Lengkap</label>
                                                  <input type="text" id="member_name" name="member_name" placeholder="Nama Lengkap" required value="{{ old('member_name', $member->member_name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                              </div>
                                              <div class="mb-6">
                                                  <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">No. Telepon</label>
                                                  <input type="tel" id="phone_number" name="phone_number" placeholder="Nomer Telepon (+62812-3456-7890)" required value="{{ old('phone_number', $member->phone_number) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                              </div>
                                              <div class="mb-6">
                                                  <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Alamat Lengkap</label>
                                                  <input type="text" id="address" name="address" placeholder="Alamat Lengkap" required value="{{ old('address', $member->address) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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

</x-app-layout>

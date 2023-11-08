<x-app-layout>
    <div class="p-4 sm:ml-64">
      <div class="p-4 mt-14">
        <div class="relative items-center justify-center p-8 mb-4 bg-white rounded min-h-48 dark:bg-gray-800">
          <div class="px-6 pt-4">
            <p class="mb-4 text-2xl text-gray-900 dark:text-gray-500">Tambah Transaksi</p>
          </div>
          <form action="{{ route('transactions.store') }}" method="POST">
              @csrf
              @method('POST')
          <div class="px-6 py-4">
              <div class="grid grid-cols-1 gap-3 mb-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="mb-6">
                  <label for="transaction_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Tipe Transaksi</label>
                  <select required id="transaction_type" name="transaction_type" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" onchange="updateTransactionCode()">
                    <option selected value="">Pilih Tipe Transaksi</option>
                    <option value="Pembelian">Pembelian</option>
                    <option value="Penjualan">Penjualan</option>
                  </select>
                </div>
                <div class="mb-6">
                  <label for="transaction_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Transaksi</label>
                  <input required readonly type="text" id="transaction_code" name="transaction_code" rows="4" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Kode Transaksi">
                </div>
                <div class="mb-6">
                  <label for="transaction_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tanggal Transaksi</label>
                    <div class="relative w-full">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                      </div>
                      <input readonly type="text" id="transaction_date" name="transaction_date" required value="{{ date('Y-m-d') }}" class="pl-10 p-2.5 block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Pilih Tanggal">
                    </div>
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
                  <label for="order_notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan Pesanan</label>
                  <textarea id="order_notes" name="order_notes" rows="4" class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Catatan ..."></textarea>
                </div>
              </div>
          </div>

          <div class="px-6 pt-4">
            <p class="mb-4 text-2xl text-gray-900 dark:text-gray-500">Daftar Barang</p>
          </div>
          <div class="px-6 py-4">
            <button data-modal-target="add-modal" data-modal-toggle="add-modal" type="button" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Tambah Barang</button>
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

                </tbody>
                  
              </table>
            </div>

            <div class="text-left">
              <button type="submit" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Simpan Data Transaksi</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>

  {{-- Modal Add --}}
  <div id="add-modal" data-modal-placement="center-center" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="add-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Tambah Barang</h3>
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
                    <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Jumlah Barang</label>
                    <input type="number" id="quantity" name="quantity" value="0" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Jumlah Barang">
                  </div>
                  <div class="mb-6">
                    <label for="debt_quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pinjam Barang</label>
                    <input type="number" id="debt_quantity" name="debt_quantity" value="0" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Pinjam Barang">
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
                  <div class="text-left">
                    <button type="button" id="addTransaction" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Simpan</button>
                    <button type="button" data-modal-hide="add-modal" class="text-blue-500 bg-blue-50 hover:bg-blue-100 hover:text-blue-600 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">Batal</button>
                  </div>
            </div>
        </div>
    </div>
  </div>

  <script>
      $(document).ready(function() {
          $('.select2').select2();
      });
  </script>
  
  <script>
    function updateTransactionCode() {
      const transactionType = document.getElementById("transaction_type").value;
      const transactionCodeInput = document.getElementById("transaction_code");
  
      if (transactionType === "Pembelian") {
        transactionCodeInput.value = "PMB-" + generateRandomNumber();
      } else if (transactionType === "Penjualan") {
        transactionCodeInput.value = "PNJ-" + generateRandomNumber();
      } else {
        transactionCodeInput.value = "";
      }
    }
  
    function generateRandomNumber() {
      return Math.floor(Math.random() * 10000); // Adjust as needed for the random number range
    }
  </script>
  
  <script>
      document.addEventListener('DOMContentLoaded', function() {

        const transactionType = document.getElementById('transaction_type');
        const stockId = document.getElementById('stock_id');
        const priceInput = document.getElementById('price');
    
        function updatePriceField() {
          const selectedTransactionType = transactionType.value;
          const selectedStockId = stockId.value;
    
          fetch(`/api/stock/${selectedStockId}`)
            .then(response => response.json())
            .then(data => {
              const { purchase_price, selling_price } = data;
    
              if (selectedTransactionType === 'Pembelian') {
                priceInput.value = purchase_price || '0';
              } else if (selectedTransactionType === 'Penjualan') {
                priceInput.value = selling_price || '0';
              } else {
                priceInput.value = '';
              }
            })
            .catch(error => {
              console.error('Error:', error);
              priceInput.value = '';
            });
          }
    
        transactionType.addEventListener('change', updatePriceField);
        stockId.addEventListener('change', updatePriceField);
    
        updatePriceField();
      });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const addTransaction = document.getElementById("addTransaction");
      const transactionTableBody = document.getElementById("transactionTableBody");
      let transactionCounter = 1; 
      
      addTransaction.addEventListener("click", function() {
        // Ambil data dari input-form yang sesuai, misalnya:
        const productName = document.getElementById("stock_id").selectedOptions[0].textContent;
        const productNameId = document.getElementById("stock_id").value;
        const quantity = document.getElementById("quantity").value;
        const debt_quantity = document.getElementById("debt_quantity").value;
        const price = document.getElementById("price").value;
    
        // Membuat objek transaksi
        const newTransaction = {
          productName,
          productNameId,
          quantity,
          debt_quantity,
          price
        };
        
        const newRow = document.createElement("tr");
        newRow.innerHTML = `
          <td class="p-4 text-left text-gray-900 whitespace-nowrap">${transactionCounter}</td>
          <td class="p-4 text-gray-900 whitespace-nowrap">${newTransaction.productName}</td>
          <input hidden type="number" name="details[${transactionCounter}][stock_id]" required value="${newTransaction.productNameId}">
          <td class="p-4 text-gray-900 whitespace-nowrap">${newTransaction.quantity}</td>
          <input hidden type="number" name="details[${transactionCounter}][quantity]" required value="${newTransaction.quantity}">
          <td class="p-4 text-gray-900 whitespace-nowrap">${newTransaction.debt_quantity}</td>
          <input hidden type="number" name="details[${transactionCounter}][debt_quantity]" required value="${newTransaction.debt_quantity}">
          <td class="p-4 text-gray-900 whitespace-nowrap">${newTransaction.price}</td>
          <input hidden type="number" name="details[${transactionCounter}][price]" required value="${newTransaction.price}">
          <td class="p-4 text-gray-900 whitespace-nowrap">${newTransaction.quantity * newTransaction.price}</td>
          <td class="p-4 text-sm text-gray-700 whitespace-nowrap">
            <div class="inline-flex rounded-md" role="group">
              <button type="button" class="text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-4 focus:ring-red-400 font-medium rounded-full text-sm px-2.5 py-1.5 text-center mr-1 my-2 delete-button">
                Hapus
              </button>
            </div>
          </td>
        `;

        const deleteButton = newRow.querySelector(".delete-button");
        deleteButton.addEventListener("click", function() {
          transactionTableBody.removeChild(newRow);
        });

        transactionTableBody.appendChild(newRow);
        console.log(newTransaction);

        transactionCounter++;
      });
    });
  </script>
</x-app-layout>
  
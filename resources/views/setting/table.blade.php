<x-app-layout>
   <div class="p-4 sm:ml-64">
     <div class="p-4 mt-14">
       <div class="relative items-center justify-center p-8 mb-4 bg-white rounded min-h-48 dark:bg-gray-800">
         <div class="px-6 pt-4">
           <p class="mb-4 text-2xl text-gray-900 dark:text-gray-500">Pengaturan</p>
         </div>
         <div class="px-6 py-4">
           <form action="{{ route('transactions.store') }}" method="PUT">
             @csrf
             @method('PUT')
             <div class="mb-6">
               <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama Perusahaan</label>
               <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $setting->company_name) }}" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Nama Perusahaan">
             </div>
             <div class="mb-6">
               <label for="company_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email Perusahaan</label>
               <input type="text" id="company_email" name="company_email" value="{{ old('company_email', $setting->company_email) }}" required class="block w-full px-4 py-3 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Email Perusahaan">
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
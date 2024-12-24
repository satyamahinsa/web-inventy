<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Laporan Produk') }}
        </h2>
        <div class="flex items-center">
            <div class="mr-6 flex items-center gap-2">
                <i class="fas fa-sun text-yellow-400 text-lg"></i>
                <input type="checkbox" id="toggleMode" class="hidden">
                <label for="toggleMode">
                    <div class="flex items-center w-9 h-5 bg-slate-500 rounded-full p-1 cursor-pointer">
                        <div class="w-4 h-4 bg-white rounded-full toggleCircle"></div>
                    </div>
                </label>
                <i class="fas fa-moon text-white text-lg"></i>
            </div>
            <button class="mr-6">
                <i class="fas fa-bell text-white"></i>
            </button>
            <div class="flex items-center space-x-3">
                <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150" alt="User Avatar">
                <span class="text-white font-medium">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </x-slot>

    <!-- Main Content -->
    <div class="container mx-auto my-5 px-4">
        <div class="flex justify-between items-center">
            <div class="flex space-x-5">
                <input id="searchInput" type="text" placeholder="Cari nama produk" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white placeholder-gray-800 dark:placeholder-white border dark:border-white rounded py-2 px-4 w-40 sm:w-52 md:w-64" onkeyup="filterTable()">
            </div>
            <div class="flex flex-wrap space-x-5 gap-2 items-center">
                <div class="flex items-center space-x-2">
                    <label for="filterCategory" class="text-gray-800 dark:text-white text-lg font-semibold">Kategori</label>
                    <select id="filterCategory" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded py-2 px-4 w-20 sm:w-32 md:w-44" onchange="filterTable()">
                        <option value="">Semua</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    
        <!-- Table Section -->
        <div class="mt-6 bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg mb-6">
            <table id="transactionTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Nama Produk
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Kategori
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Harga
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Stok
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white divide-y divide-gray-200">
                    @foreach($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium">{{ $product->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm">{{ $product->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm">{{ $product->category->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm">Rp. {{ number_format($product->price) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm">{{ $product->stock }}</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="noDataMessage" class="hidden text-center py-4 bg-red-100 text-red-600 font-semibold rounded-lg">
            Tidak ada data produk yang ditemukan.
        </div>
    </div>

    <!-- JavaScript for Searching Functionality -->
    <script>
        function filterTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const category = document.getElementById('filterCategory').value;
            const rows = document.querySelectorAll('#transactionTable tbody tr');
            const noDataMessage = document.getElementById('noDataMessage');
            
            let visibleRowCount = 0;

            rows.forEach(row => {
                const rowTransaction = row.cells[1].textContent.toLowerCase();
                const rowCategory = row.cells[2].textContent.toLowerCase();
                const matchesSearch = searchTerm ? rowTransaction.includes(searchTerm) : true;
                const matchesCategory = category ? rowCategory.includes(category.toLowerCase()) : true;

                if (matchesSearch && matchesCategory) {
                    row.style.display = '';
                    visibleRowCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Tampilkan atau sembunyikan pesan "Tidak ada data"
            if (visibleRowCount === 0) {
                noDataMessage.classList.remove('hidden');
            } else {
                noDataMessage.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>

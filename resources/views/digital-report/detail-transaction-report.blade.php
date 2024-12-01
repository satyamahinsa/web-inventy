<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Laporan Transaksi') }}
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
                <input id="searchInput" type="text" placeholder="Cari nomor transaksi" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white placeholder-gray-800 dark:placeholder-white border dark:border-white rounded py-2 px-4 w-40 sm:w-52 md:w-64" onkeyup="filterTable()">
            </div>
            <div class="flex flex-wrap space-x-5 gap-2 items-center">
                <div class="flex items-center space-x-2">
                    <label for="filterDate" class="text-gray-800 dark:text-white text-lg font-semibold">Tanggal</label>
                    <input id="filterDate" type="date" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded py-2 px-4 w-20 sm:w-32 md:w-44" onchange="filterTable()">
                </div>
            
                <div class="flex items-center space-x-2">
                    <label for="filterStatus" class="text-gray-800 dark:text-white text-lg font-semibold">Status</label>
                    <select id="filterStatus" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded py-2 px-4 w-20 sm:w-32 md:w-44" onchange="filterTable()">
                        <option value="">Semua</option>
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </div>
            </div>
        </div>
    
        <div class="mt-6 bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg mb-6">
            <table id="transactionTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No. Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Total Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Layanan Pengiriman</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white divide-y divide-gray-200">
                    @foreach($transactions as $transaction)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium">{{ $transaction->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm">Email</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm">Rp {{ number_format($transaction->total_price) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm px-3 py-1 rounded-full {{ $transaction->status == 'completed' ? 'bg-green-100 text-green-800' : ($transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ $transaction->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ $transaction->shipping_service }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('transactions.detail', $transaction->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded text-xs">Detail</a>
                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-2 rounded text-xs">Edit</a>
                            <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded text-xs" type="button" onclick="openModal('{{ $transaction->id }}')">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript for Searching Functionality -->
    <script>
        function filterTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const date = document.getElementById('filterDate').value;
            const status = document.getElementById('filterStatus').value.toLowerCase();

            const rows = document.querySelectorAll('#transactionTable tbody tr');
            
            rows.forEach(row => {
                const rowDate = row.cells[1].textContent;
                const rowStatus = row.cells[3].textContent.toLowerCase();
                const rowTransaction = row.cells[0].textContent.toLowerCase();
                
                const matchesSearch = searchTerm ? rowTransaction.includes(searchTerm) : true;
                const matchesDate = date ? rowDate.includes(date) : true;
                const matchesStatus = status ? rowStatus.includes(status) : true;

                if (matchesSearch && matchesDate && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>

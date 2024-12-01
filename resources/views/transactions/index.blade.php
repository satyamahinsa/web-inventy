<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Transaksi') }}
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
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Total Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
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
                            <div class="text-sm">{{ $transaction->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm">{{ $transaction->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm">Rp {{ number_format($transaction->total_amount) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm px-3 py-1 rounded-full {{ $transaction->status == 'completed' ? 'bg-green-100 text-green-800' : ($transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ $transaction->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if(Auth::user()->role === 'admin')  <!-- Menampilkan tombol untuk admin -->
                                <a href="{{ route('transactions.detail', $transaction->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded text-xs">Detail</a>
                                <a href="{{ route('transactions.edit', $transaction->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-2 rounded text-xs">Edit</a>
                                <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded text-xs" type="button" onclick="openModal('{{ $transaction->id }}')">Delete</button>
                            @elseif(Auth::user()->role === 'user')  <!-- Menampilkan tombol hanya untuk user -->
                                <a href="{{ route('transactions.detail', $transaction->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded text-xs">Detail</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Deleting Transaction -->
    <div id="modal-delete" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Hapus Transaksi</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus transaksi ini? Tindakan ini tidak bisa dibatalkan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Hapus
                        </button>
                    </form>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal()">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

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

        function openModal(transactionId) {
            document.getElementById('delete-form').action = '/transactions/' + transactionId;
            document.getElementById('modal-delete').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal-delete').classList.add('hidden');
        }
    </script>
</x-app-layout>

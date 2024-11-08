<x-app-layout>
    <!-- Slot Header jika dibutuhkan -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                {{ __('Riwayat Transaksi') }}
            </h2>
            <div class="flex items-center">
                <button class="mr-6">
                    <i class="fas fa-bell text-gray-500"></i>
                </button>
                <div class="flex items-center space-x-3">
                    <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150" alt="User Avatar">
                    <span class="text-gray-900 font-medium dark:text-white">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Main Content -->
    <div class="container mx-auto my-5 px-4">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-semibold text-gray-900">Riwayat Transaksi</h1>
                <p class="text-gray-600">Kumpulan transaksi yang dilakukan oleh pengguna.</p>
            </div>
            <div class="flex space-x-10">
                <input id="searchInput" type="text" placeholder="Cari berdasarkan nomor transaksi" class="border border-gray-300 rounded-lg py-2 px-4" onkeyup="searchTransaction()">
            </div>
        </div>

        <!-- Tabel Riwayat Transaksi -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table id="transactionTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Transaksi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($userTransactions as $transaction)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->created_at->format('d-m-Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($transaction->total_price) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-sm {{ $transaction->status == 'completed' ? 'bg-green-100 text-green-800' : ($transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ $transaction->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('transactions.detail', $transaction->id) }}" class="bg-blue-500 text-white py-1 px-2 rounded text-xs">Detail</a>
                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="bg-yellow-500 text-white py-1 px-2 rounded text-xs">Edit</a>
                            <button class="bg-red-500 text-white py-1 px-2 rounded text-xs" type="button" onclick="openModal('{{ $transaction->id }}')">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Hapus -->
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
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">Hapus</button>
                        </form>
                        <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function searchTransaction() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let table = document.getElementById('transactionTable');
            let rows = table.getElementsByTagName('tr');
            
            for (let i = 1; i < rows.length; i++) {
                let idCell = rows[i].getElementsByTagName('td')[0];

                if (idCell) {
                    let idText = idCell.textContent.toLowerCase();
                    rows[i].style.display = idText.includes(input) ? '' : 'none';
                }
            }
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

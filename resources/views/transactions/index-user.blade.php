<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100">
    @include('layouts.sidebar')
    
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-semibold text-gray-900">Transaksi</h1>
                <p class="text-gray-600">Temukan semua transaksi yang telah dilakukan dengan mudah.</p>
            </div>
            <div class="flex space-x-5">
                <input id="searchInput" type="text" placeholder="Cari berdasarkan nomor transaksi" class="border border-gray-300 rounded-lg py-2 px-4" onkeyup="searchTransaction()">
                <a href="{{ route('transactions.history') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-history mr-2"></i>
                    Riwayat Transaksi
                </a>
            </div>
        </div>
    
        <div class="mt-6 bg-white shadow rounded-lg">
            <table id="transactionTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No. Transaksi
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total Harga
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Layanan Pengiriman
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($transactions as $transaction)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $transaction->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $transaction->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Rp {{ number_format($transaction->total_price) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm px-3 py-1 rounded-full {{ $transaction->status == 'completed' ? 'bg-green-100 text-green-800' : ($transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ $transaction->status }}
                        </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $transaction->shipping_service }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('transactions.detail', $transaction->id) }}" class="bg-blue-500 text-white py-1 px-2 rounded text-xs">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function searchTransaction() {
            let input = document.getElementById('searchInput').value.toLowerCase()
            let table = document.getElementById('transactionTable')
            let rows = table.getElementsByTagName('tr')
            
            for (let i = 1; i < rows.length; i++) {
                let idCell = rows[i].getElementsByTagName('td')[0]

                if (idCell) {
                    let idText = idCell.textContent.toLowerCase()

                    if (idText.includes(input)) {
                        rows[i].style.display = ''
                    } else {
                        rows[i].style.display = 'none'
                    }
                }
            }
        }

        function openModal(transactionId) {
            document.getElementById('delete-form').action = '/transactions/' + transactionId
            document.getElementById('modal-delete').classList.remove('hidden')
        }

        function closeModal() {
            document.getElementById('modal-delete').classList.add('hidden')
        }
    </script>
</body>
</html>

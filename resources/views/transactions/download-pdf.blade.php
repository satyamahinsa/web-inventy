<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Transaksi</title>
    @vite('resources/css/app.css') <!-- Pastikan Anda menggunakan Vite -->
    <style>
        @media print {
    body {
        background-color: white; /* Hilangkan warna latar */
        color: black; /* Gunakan warna teks yang kontras */
        -webkit-print-color-adjust: exact; /* Untuk Chrome/Edge */
        color-adjust: exact; /* Untuk standar modern */
    }

    .no-print {
        display: none; /* Sembunyikan elemen yang tidak perlu */
    }

    .print-only {
        display: block; /* Tampilkan hanya saat mencetak */
    }

    /* Pastikan tabel atau elemen besar dapat sepenuhnya muat di halaman */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    img, video {
        max-width: 100%; /* Pastikan gambar tidak terpotong */
    }
}
    </style>
</head>

<body class="bg-orange-50">
    <div class="container mx-auto p-6 max-w-4xl bg-white shadow-md rounded-md border border-orange-200">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Invoice Transaksi</h1>
            <p class="text-sm text-gray-600">{{ $transaction->created_at->format('d F Y') }}</p>
        </div>

        <!-- Transaction Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-600">ID Transaksi:</label>
                <p class="bg-orange-100 text-gray-800 p-2 rounded-md">{{ $transaction->id }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Tanggal Pembelian:</label>
                <p class="bg-orange-100 text-gray-800 p-2 rounded-md">{{ $transaction->created_at->format('d F Y') }}
                </p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Nama Lengkap:</label>
                <p class="bg-orange-100 text-gray-800 p-2 rounded-md">{{ $transaction->user->name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Email:</label>
                <p class="bg-orange-100 text-gray-800 p-2 rounded-md">{{ $transaction->user->email }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Total Harga:</label>
                <p class="bg-orange-100 text-gray-800 p-2 rounded-md">Rp.
                    {{ number_format($transaction->total_amount) }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Status:</label>
                <p class="bg-orange-100 text-gray-800 p-2 rounded-md">{{ ucfirst($transaction->status) }}</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-600">Alamat Tujuan:</label>
                <p class="bg-orange-100 text-gray-800 p-2 rounded-md">{{ $transaction->destination_address }}</p>
            </div>
        </div>

        <!-- Product List -->
        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Daftar Produk</h2>
            <table class="table-auto w-full border border-orange-200">
                <thead class="bg-orange-100">
                    <tr>
                        <th class="text-left text-sm font-medium text-gray-600 p-2 border">Nama Produk</th>
                        <th class="text-left text-sm font-medium text-gray-600 p-2 border">Jumlah</th>
                        <th class="text-left text-sm font-medium text-gray-600 p-2 border">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction->products as $product)
                        <tr>
                            <td class="p-2 border">{{ $product->name }}</td>
                            <td class="p-2 border">{{ $product->pivot->quantity }}</td>
                            <td class="p-2 border">Rp. {{ number_format($product->price) }}</td>
                        </tr>
                    @endforeach
                    <tr class="bg-orange-50">
                        <td colspan="2" class="text-right font-bold p-2">Total</td>
                        <td class="p-2 font-bold">Rp. {{ number_format($transaction->total_amount) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">Terima kasih atas transaksi Anda!</p>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Otomatis memunculkan dialog print
            window.print();
        });
    </script>
</body>

</html>

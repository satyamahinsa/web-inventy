<x-app-layout>
    <!-- Slot Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Detail Transaksi') }}
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
    </x-slot>

    <!-- Main Content -->
    <div class="container mx-auto my-5 px-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-semibold text-gray-900">Detail Transaksi</h1>
                <p class="text-gray-600">Informasi transaksi Anda di bawah ini.</p>
            </div>
            <div class="flex space-x-2">
                <button onclick="window.print()" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-print mr-2"></i>
                    Print Invoice
                </button>
            </div>
        </div>

        <div class="mt-6 grid gap-4 lg:grid-cols-3 lg:grid-rows-2">
            <!-- Informasi Umum Transaksi -->
            <div class="relative lg:row-start-1 w-full">
                <div class="rounded-tl-[2rem] rounded-bl-[2rem] bg-white shadow p-6">
                    <h3 class="text-lg font-medium text-gray-950">ID Transaksi</h3>
                    <input type="text" value="{{ $transaction->id }}" class="block mt-2 w-full text-gray-600 bg-gray-200 rounded px-3 py-2" readonly>
                    
                    <h3 class="text-lg font-medium text-gray-950 mt-4">Tanggal Pembelian</h3>
                    <input type="date" value="{{ $transaction->created_at->format('Y-m-d') }}" class="block mt-2 w-full text-gray-600 bg-gray-200 rounded px-3 py-2" readonly>
                    
                    <h3 class="text-lg font-medium text-gray-950 mt-4">Nama Lengkap</h3>
                    <input type="text" value="{{ $transaction->user->name }}" class="block mt-2 w-full text-gray-600 bg-gray-200 rounded px-3 py-2" readonly>
                    
                    <h3 class="text-lg font-medium text-gray-950 mt-4">Alamat Email</h3>
                    <input type="email" value="{{ $transaction->user->email }}" class="block mt-2 w-full text-gray-600 bg-gray-200 rounded px-3 py-2" readonly>
                </div>
            </div>

            <!-- Status dan Alamat Pengiriman -->
            <div class="relative lg:row-start-2 w-full">
                <div class="rounded-lg bg-white shadow p-6">
                    <h3 class="text-lg font-medium text-gray-950">Status</h3>
                    <input type="text" value="{{ ucfirst($transaction->status) }}" class="block mt-2 w-full text-gray-600 bg-gray-200 rounded px-3 py-2" readonly>

                    <h3 class="text-lg font-medium text-gray-950 mt-4">Alamat Tujuan</h3>
                    <textarea rows="4" class="block mt-2 w-full text-gray-600 bg-gray-200 rounded px-3 py-2" readonly>{{ $transaction->destination_address }}</textarea>
                </div>
            </div>

            <!-- Layanan Pengiriman dan Lokasi -->
            <div class="relative lg:row-start-1 lg:col-start-2 lg:col-span-2 w-full">
                <div class="rounded-lg bg-white shadow p-6">
                    <h3 class="text-lg font-medium text-gray-950">Layanan Pengiriman</h3>
                    <input type="text" value="{{ $transaction->shipping_service }}" class="block mt-2 w-full text-gray-600 bg-gray-200 rounded px-3 py-2" readonly>

                    <h3 class="text-lg font-medium text-gray-950 mt-4">Lacak Pengiriman</h3>
                    <div id="map" class="mt-4 h-52"></div>
                </div>
            </div>

            <!-- Harga dan Produk -->
            <div class="relative lg:row-start-2 lg:col-start-2 lg:col-span-2 w-full">
                <div class="rounded-lg bg-white shadow p-6">
                    <h3 class="text-lg font-medium text-gray-950">Total Harga</h3>
                    <input type="text" value="Rp {{ number_format($transaction->total_price) }}" class="block mt-2 w-full text-gray-600 bg-gray-200 rounded px-3 py-2" readonly>

                    <h3 class="text-lg font-medium text-gray-950 mt-4">Daftar Produk</h3>
                    <div class="mt-2 overflow-x-auto flex space-x-4">
                        @foreach ($transaction->products as $product)
                            <div class="bg-white border rounded-lg shadow-md p-4 min-w-[150px]">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full mb-2">
                                <h4 class="font-semibold text-gray-800">{{ $product->name }}</h4>
                                <p class="text-gray-600">Harga: Rp {{ number_format($product->price, 2) }}</p>
                                <p class="text-gray-600">Jumlah: {{ $product->quantity }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([-7.2575, 112.7521], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 15,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        const transaction = @json($transaction);
        const deliveryCoordinates = [transaction.latitude, transaction.longitude];
        L.marker(deliveryCoordinates)
            .addTo(map)
            .bindPopup(`Dalam Perjalanan: ${transaction.destination_address}`)
            .openPopup();
        
        map.setView(deliveryCoordinates, 10);
    </script>
</x-app-layout>

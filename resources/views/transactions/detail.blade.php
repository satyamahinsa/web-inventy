<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Detail Transaksi') }}
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
        <div class="flex justify-end items-center">
            <div class="flex space-x-2">
                <button onclick="window.print()"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-print mr-2"></i>
                    Print Invoice
                </button>
            </div>
        </div>

        <div class="mt-6 grid gap-4 lg:grid-cols-3 lg:grid-rows-2">
            <div class="relative lg:row-start-1 w-full">
                <div
                    class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg rounded-tl-[2rem]">
                    <label for="id_transaksi" class="block text-md font-medium text-gray-800 dark:text-white">ID
                        Transaksi</label>
                    <input type="text" name="id_transaksi" id="id_transaksi" value="{{ $transaction->id }}"
                        class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full"
                        readonly>

                    <label for="tanggal_pembelian"
                        class="block text-md font-medium text-gray-800 dark:text-white mt-4">Tanggal Pembelian</label>
                    <input type="date" name="tanggal_pembelian" id="tanggal_pembelian"
                        value="{{ $transaction->created_at->format('Y-m-d') }}"
                        class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full"
                        readonly>

                    <label for="nama_lengkap" class="block text-md font-medium text-gray-800 dark:text-white mt-4">Nama
                        Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ $transaction->user->name }}"
                        class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full"
                        readonly>

                    <label for="email"
                        class="block text-md font-medium text-gray-800 dark:text-white mt-4">Email</label>
                    <input type="email" name="email" id="email" value="{{ $transaction->user->email }}"
                        class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full"
                        readonly>
                </div>
            </div>

            <!-- Status dan Alamat Pengiriman -->
            <div class="relative lg:row-start-2 w-full">
                <div
                    class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg rounded-bl-[2rem]">
                    <label for="status"
                        class="block text-md font-medium text-gray-800 dark:text-white mt-4">Status</label>
                    <input type="text" name="status" id="status" value="{{ ucfirst($transaction->status) }}"
                        class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full"
                        readonly>

                    <label for="alamat_tujuan"
                        class="block text-md font-medium text-gray-800 dark:text-white mt-4">Alamat Tujuan</label>
                    <textarea rows="4" name="alamat_tujuan" id="alamat_tujuan"
                        class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full"
                        readonly>{{ $transaction->destination_address }}</textarea>
                </div>
            </div>

            <!-- Layanan Pengiriman dan Lokasi -->
            <div class="relative lg:row-start-1 lg:col-start-2 lg:col-span-2 w-full">
                <div
                    class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg rounded-tr-[2rem]">
                    <label for="lacak_pengiriman"
                        class="block text-md font-medium text-gray-800 dark:text-white mt-4">Lacak Pengiriman</label>
                    <div id="map" class="mt-4 h-52"></div>
                </div>
            </div>

            <!-- Harga dan Produk -->
            <div class="relative lg:row-start-2 lg:col-start-2 lg:col-span-2 w-full">
                <div
                    class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg rounded-br-[2rem]">
                    <h3 class="text-lg font-medium text-gray-950">Total Harga</h3>
                    <input type="text" value="Rp. {{ number_format($transaction->total_amount) }}"
                        class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full"
                        readonly>

                    <h3 class="text-lg font-medium text-gray-950 mt-4">Daftar Produk Dibeli</h3>
                    <ul class="list-disc pl-5 mt-2 text-gray-800 dark:text-white">
                        @foreach ($transaction->products as $product)
                            <li>{{ $product->name }} ({{ $product->pivot->quantity }})</li>
                        @endforeach
                    </ul>

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

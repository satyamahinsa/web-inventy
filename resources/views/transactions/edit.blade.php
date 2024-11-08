<x-app-layout>
    <!-- Slot Header jika dibutuhkan -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                {{ __('Edit Transaksi') }}
            </h2>
            <div class="flex items-center space-x-3">
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
        <div class="mx-auto max-w-2xl lg:max-w-7xl">
            <div class="flex justify-between items-center mb-5">
                <div>
                    <h1 class="text-3xl font-semibold text-gray-900">Edit Transaksi</h1>
                    <p class="text-gray-600">Silakan edit informasi transaksi Anda di bawah ini.</p>
                </div>
                <button type="submit" form="editTransactionForm" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan
                </button>
            </div>

            <form id="editTransactionForm" action="/transactions/{{ $transaction->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid gap-4 lg:grid-cols-3 lg:grid-rows-2">
                    <!-- Info Transaksi -->
                    <div class="relative lg:row-start-1 w-full">
                        <div class="absolute inset-px bg-white rounded-tl-2xl rounded-bl-2xl"></div>
                        <div class="relative mt-5 p-4 bg-white rounded-tl-2xl rounded-bl-2xl shadow-md space-y-4">
                            <div>
                                <label class="text-lg font-medium">ID Transaksi</label>
                                <input type="text" name="transaction_id" value="{{ $transaction->id }}" class="block mt-2 w-full bg-gray-200 border rounded px-3 py-2" readonly>
                            </div>
                            <div>
                                <label class="text-lg font-medium">Tanggal Pembelian</label>
                                <input type="date" name="created_at" value="{{ $transaction->created_at->format('Y-m-d') }}" class="block mt-2 w-full bg-gray-200 border rounded px-3 py-2" readonly>
                            </div>
                            <div>
                                <label class="text-lg font-medium">Nama Lengkap</label>
                                <input type="text" name="user_name" value="{{ $transaction->user->name }}" class="block mt-2 w-full bg-gray-200 border rounded px-3 py-2" readonly>
                            </div>
                            <div>
                                <label class="text-lg font-medium">Alamat Email</label>
                                <input type="email" name="user_email" value="{{ $transaction->user->email }}" class="block mt-2 w-full bg-gray-200 border rounded px-3 py-2" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Status & Alamat -->
                    <div class="relative lg:row-start-2 w-full">
                        <div class="absolute inset-px bg-white rounded-lg shadow-md"></div>
                        <div class="relative mt-3 p-4 bg-white rounded-lg shadow-md space-y-4">
                            <div>
                                <label class="text-lg font-medium">Status</label>
                                <select name="status" class="block mt-2 w-full bg-gray-100 border rounded-full px-3 py-1">
                                    <option value="completed" {{ $transaction->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="canceled" {{ $transaction->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-lg font-medium">Alamat Tujuan</label>
                                <textarea name="alamat-tujuan" rows="4" class="block mt-2 w-full bg-white border rounded px-3 py-2">{{ $transaction->destination_address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Layanan Pengiriman & Peta -->
                    <div class="relative lg:col-span-2 lg:row-start-1 w-full">
                        <div class="absolute inset-px bg-white rounded-lg shadow-md"></div>
                        <div class="relative mt-3 p-4 bg-white rounded-lg shadow-md space-y-4">
                            <div>
                                <label class="text-lg font-medium">Layanan Pengiriman</label>
                                <input type="text" name="shipping_service" value="{{ $transaction->shipping_service }}" class="block mt-2 w-full bg-gray-200 border rounded px-3 py-2" readonly>
                            </div>
                            <div>
                                <label class="text-lg font-medium">Lacak Pengiriman</label>
                                <div id="map" class="mt-4 mx-5 h-48"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Harga & Produk -->
                    <div class="relative lg:col-span-2 lg:row-start-2 w-full">
                        <div class="absolute inset-px bg-white rounded-lg shadow-md"></div>
                        <div class="relative mt-3 p-4 bg-white rounded-lg shadow-md space-y-4">
                            <div>
                                <label class="text-lg font-medium">Total Harga</label>
                                <input type="text" name="total_price" value="Rp {{ number_format($transaction->total_price) }}" class="block mt-2 w-full bg-gray-200 border rounded px-3 py-2" readonly>
                            </div>
                            <div>
                                <label class="text-lg font-medium">Daftar Produk</label>
                                <div class="mt-2 flex space-x-4 overflow-x-auto">
                                    @foreach ($transaction->products as $product)
                                        <div class="bg-white border rounded-lg shadow-md p-4 min-w-[150px]">
                                            <img src="https://picsum.photos/id/{{ $product->id }}/100/100" alt="Produk {{ $product->id }}" class="w-full">
                                            <h3 class="font-semibold text-gray-800">{{ $product->name }}</h3>
                                            <p class="text-gray-600">Harga: Rp {{ number_format($product->price) }}</p>
                                            <p class="text-gray-600">Jumlah: {{ $product->pivot->quantity }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
        const marker = L.marker(deliveryCoordinates)
            .addTo(map)
            .bindPopup(`Dalam Perjalanan: ${transaction.destination_address}`)
            .openPopup();

        map.setView(deliveryCoordinates, 10);
    </script>
</x-app-layout>

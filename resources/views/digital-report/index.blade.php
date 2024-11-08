<x-app-layout>
    <!-- Slot Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Digital Report') }}
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
        <!-- Sales Report Section -->
        <div class="mb-12 bg-amber-300 p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold mb-4">Laporan Transaksi</h2>
                <a href="{{ route('digital-report.detail-transaction-report') }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Detail
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Total Penjualan</p>
                        <div class="flex items-center">
                            <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i>
                            <span class="text-green-500 font-semibold text-sm">+4.75%</span>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">Rp {{ number_format($totalSales, 2) }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Total Transaksi</p>
                        <div class="flex items-center">
                            <i class="fas fa-arrow-down text-red-500 mr-1 text-sm"></i>
                            <span class="text-red-500 font-semibold text-sm">-1.39%</span>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalTransactions }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Rata-Rata Nilai</p>
                        <div class="flex items-center">
                            <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i>
                            <span class="text-green-500 font-semibold text-sm">+3.12%</span>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">Rp {{ number_format($averageOrderValue, 2) }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Transaksi Selesai</p>
                        <div class="flex items-center">
                            <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i>
                            <span class="text-green-500 font-semibold text-sm">+2.15%</span>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $completedOrders }}</p>
                </div>
            </div>
        </div>

        <!-- Products Report Section -->
        <div class="mb-12 bg-amber-300 p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold mb-4">Laporan Produk</h2>
                <a href="{{ route('digital-report.detail-product-report') }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Detail
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Produk Terjual</p>
                        <div class="flex items-center">
                            <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i>
                            <span class="text-green-500 font-semibold text-sm">+5.25%</span>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">0</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Produk Terlaris</p>
                        <div class="flex items-center">
                            <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i>
                            <span class="text-green-500 font-semibold text-sm">+5.25%</span>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">0</p>
                </div>
            </div>
        </div>

        <!-- Customers Report Section -->
        <div class="mb-12 bg-amber-300 p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold mb-4">Laporan Pelanggan</h2>
                <a href="{{ route('digital-report.detail-user-report') }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Detail
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Total Pelanggan</p>
                        <div class="flex items-center">
                            <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i>
                            <span class="text-green-500 font-semibold text-sm">+8.43%</span>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalCustomers }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Pembeli Terbanyak</p>
                        <div class="flex items-center">
                            <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i>
                            <span class="text-green-500 font-semibold text-sm">+8.43%</span>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalCustomers }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Laporan Penjualan') }}
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
                {{-- <span class="text-white font-medium">{{ Auth::user()->name }}</span> --}}
            </div>
        </div>
    </x-slot>

    <!-- Main Content -->
    <div class="container mx-auto my-5 px-4">
        <!-- Sales Report Section -->
        <div class="mb-5 bg-amber-500 p-6 rounded-lg shadow-md">
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
                            {{-- <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i> --}}
                            {{-- <span class="text-green-500 font-semibold text-sm">+4.75%</span> --}}
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">Rp {{ number_format($totalSales) }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Total Transaksi</p>
                        <div class="flex items-center">
                            {{-- <i class="fas fa-arrow-down text-red-500 mr-1 text-sm"></i> --}}
                            {{-- <span class="text-red-500 font-semibold text-sm">-1.39%</span> --}}
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalTransactions }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Rata-Rata Nilai</p>
                        <div class="flex items-center">
                            {{-- <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i> --}}
                            {{-- <span class="text-green-500 font-semibold text-sm">+3.12%</span> --}}
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">Rp {{ number_format($averageOrderValue) }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Transaksi Selesai</p>
                        <div class="flex items-center">
                            {{-- <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i> --}}
                            {{-- <span class="text-green-500 font-semibold text-sm">+2.15%</span> --}}
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $completedOrders }}</p>
                </div>
            </div>
        </div>

        <!-- Products Report Section -->
        <div class="mb-5 bg-amber-500 p-6 rounded-lg shadow-md">
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
                        <p class="text-md font-semibold">Total Kategori</p>
                        <div class="flex items-center">
                            {{-- <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i> --}}
                            {{-- <span class="text-green-500 font-semibold text-sm">+5.25%</span> --}}
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalCategory }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Total Produk</p>
                        <div class="flex items-center">
                            {{-- <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i> --}}
                            {{-- <span class="text-green-500 font-semibold text-sm">+5.25%</span> --}}
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalProduct }}</p>
                </div>
            </div>
        </div>

        <!-- Customers Report Section -->
        <div class="mb-5 bg-amber-500 p-6 rounded-lg shadow-md">
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
                            {{-- <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i> --}}
                            {{-- <span class="text-green-500 font-semibold text-sm">+8.43%</span> --}}
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{ $totalCustomers }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <p class="text-md font-semibold">Pembeli Terbanyak</p>
                        <div class="flex items-center">
                            {{-- <i class="fas fa-arrow-up text-green-500 mr-1 text-sm"></i> --}}
                            {{-- <span class="text-green-500 font-semibold text-sm">+8.43%</span> --}}
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-gray-800 mt-2">{{$topSpender->name}}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

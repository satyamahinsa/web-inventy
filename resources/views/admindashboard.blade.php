<x-app-layout>
    <!-- Slot Header jika dibutuhkan -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Dashboard') }}
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
        <!-- Dashboard Summary -->
        <div class="grid grid-cols-4 gap-6 mb-6">
            <div class="bg-green-100 p-4 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Total Profit</h3>
                <p class="text-3xl font-bold">Rp. {{ number_format($totalSales) }}</p>
                <p class="text-green-600">23% vs last quarter</p>
            </div>
            <div class="bg-red-100 p-4 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Total Penjualan</h3>
                <p class="text-3xl font-bold">{{ $totalTransactions }}</p>
                <p class="text-red-600">8% vs last year</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Total Pelanggan</h3>
                <p class="text-3xl font-bold">{{ $totalCustomers }}</p>
                <p class="text-yellow-600">2% vs last month</p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Rata-Rata Penjualan</h3>
                <p class="text-3xl font-bold">Rp. {{ number_format($averageOrderValue) }}</p>
                <p class="text-green-600">5% vs last month</p>
            </div>
        </div>

        <!-- Performance Improvement Plans -->
        <div class="bg-white p-6 rounded-lg shadow mb-6 dark:bg-gray-800">
            <h3 class="text-xl font-semibold mb-4">Performance Improvement Plans</h3>
            <p class="text-sm text-gray-600 mb-6 dark:text-gray-300">The progress and outcomes of Performance Improvement Plans implemented over the last 24 months</p>
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-1 text-center">Jan</div>
                <div class="col-span-1 text-center">Feb</div>
                <div class="col-span-1 text-center">Mar</div>
                <div class="col-span-1 text-center">Apr</div>
                <div class="col-span-1 text-center">May</div>
                <div class="col-span-1 text-center">Jun</div>
                <div class="col-span-1 text-center">Jul</div>
                <div class="col-span-1 text-center">Aug</div>
                <div class="col-span-1 text-center">Sep</div>
                <div class="col-span-1 text-center">Oct</div>
                <div class="col-span-1 text-center">Nov</div>
                <div class="col-span-1 text-center">Dec</div>
            </div>
            <div class="h-32 mt-4 bg-gray-100 rounded-lg dark:bg-gray-700"></div>
        </div>

        <!-- Top Penjualan Produk -->
        <div class="grid grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow dark:bg-gray-800">
                <h3 class="text-xl font-semibold mb-4">Top Penjualan Produk</h3>
                <div class="h-40 w-40 mx-auto bg-gray-200 rounded-full flex items-center justify-center dark:bg-gray-700">
                    <p class="text-lg font-semibold">Chart Placeholder</p>
                </div>
                <div class="mt-4">
                    <ul>
                        <li class="flex justify-between py-1">
                            <span>Elektronik</span>
                            <span class="font-semibold">40%</span>
                        </li>
                        <li class="flex justify-between py-1">
                            <span>Pakaian</span>
                            <span class="font-semibold">35%</span>
                        </li>
                        <li class="flex justify-between py-1">
                            <span>Alat Rumah Tangga</span>
                            <span class="font-semibold">25%</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow dark:bg-gray-800">
                <h3 class="text-xl font-semibold mb-4">Top Products</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span>01. Home Decor Range</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-24 h-3 bg-yellow-300 rounded-full dark:bg-yellow-600"></div>
                            <span class="text-xs font-semibold">46%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>02. Disney Princess Dress</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-16 h-3 bg-green-300 rounded-full dark:bg-green-600"></div>
                            <span class="text-xs font-semibold">17%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>03. Bathroom Essentials</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-20 h-3 bg-blue-300 rounded-full dark:bg-blue-600"></div>
                            <span class="text-xs font-semibold">19%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>04. Apple Smartwatch</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-18 h-3 bg-pink-300 rounded-full dark:bg-pink-600"></div>
                            <span class="text-xs font-semibold">29%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

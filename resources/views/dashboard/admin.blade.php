<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto my-5 px-4">
        <div class="p-6 text-gray-900 bg-white rounded-lg shadow dark:bg-gray-800 mb-6">
            @auth
                <div style="font-size: 1.2rem;">
                    {{ __('Selamat datang Admin, ') }}
                    <span class="welcome-message font-bold uppercase" style="font-size: 1.2rem;">{{ Auth::user()->name }}</span>
                </div>
            @else
                <div>{{ __("You're not logged in!") }}</div>
            @endauth
        </div>

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

        <div class="bg-white p-6 rounded-lg shadow mb-6 dark:bg-gray-800">
            <h3 class="text-xl font-semibold mb-4">Performance Improvement Plans</h3>
            <p class="text-sm text-gray-600 mb-6 dark:text-gray-300">
                The progress and outcomes of Performance Improvement Plans implemented over the last 24 months
            </p>
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
    </div>

    @if (session('loginstatus'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('loginstatus') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
</x-app-layout>

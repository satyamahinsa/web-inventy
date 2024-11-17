<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto my-5 px-4">
        <div class="p-6 text-gray-900 bg-white rounded-lg shadow dark:bg-gray-800 mb-6">
            @auth
                <div style="font-size: 1.2rem;">
                    {{ __('Selamat datang, ') }}
                    <span class="welcome-message font-bold uppercase" style="font-size: 1.2rem;">{{ Auth::user()->name }}</span>
                </div>
            @else
                <div>{{ __("You're not logged in!") }}</div>
            @endauth
        </div>

        <div class="bg-white p-6 rounded-lg shadow mb-6 dark:bg-gray-800">
            <h3 class="text-xl font-semibold mb-4">Performance Improvement Plans</h3>
            <p class="text-sm text-gray-600 mb-6 dark:text-gray-300">Progress over the last 24 months.</p>
            <div class="h-32 mt-4 bg-gray-100 rounded-lg dark:bg-gray-700"></div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow dark:bg-gray-800">
                <h3 class="text-xl font-semibold mb-4">Top Penjualan Produk</h3>
                <div class="h-40 w-40 mx-auto bg-gray-200 rounded-full flex items-center justify-center dark:bg-gray-700">
                    <p class="text-lg font-semibold">Chart Placeholder</p>
                </div>
                <ul class="mt-4">
                    <li class="flex justify-between py-1"><span>Elektronik</span><span class="font-semibold">40%</span></li>
                    <li class="flex justify-between py-1"><span>Pakaian</span><span class="font-semibold">35%</span></li>
                    <li class="flex justify-between py-1"><span>Alat Rumah Tangga</span><span class="font-semibold">25%</span></li>
                </ul>
            </div>
            <div class="bg-white p-6 rounded-lg shadow dark:bg-gray-800">
                <h3 class="text-xl font-semibold mb-4">Top Products</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span>01. Home Decor Range</span>
                        <div class="flex items-center space-x-2"><div class="w-24 h-3 bg-yellow-300 rounded-full dark:bg-yellow-600"></div><span class="text-xs font-semibold">46%</span></div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>02. Disney Princess Dress</span>
                        <div class="flex items-center space-x-2"><div class="w-16 h-3 bg-green-300 rounded-full dark:bg-green-600"></div><span class="text-xs font-semibold">17%</span></div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>03. Bathroom Essentials</span>
                        <div class="flex items-center space-x-2"><div class="w-20 h-3 bg-blue-300 rounded-full dark:bg-blue-600"></div><span class="text-xs font-semibold">19%</span></div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>04. Apple Smartwatch</span>
                        <div class="flex items-center space-x-2"><div class="w-18 h-3 bg-pink-300 rounded-full dark:bg-pink-600"></div><span class="text-xs font-semibold">29%</span></div>
                    </div>
                </div>
            </div>
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

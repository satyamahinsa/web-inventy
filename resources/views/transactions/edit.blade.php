<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Transaksi') }}
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
        <div class="mx-auto max-w-2xl lg:max-w-7xl">
            <div class="flex justify-end items-center">
                <div class="flex space-x-2">
                    <a href="{{ route('transactions.download-pdf', ['id' => $transaction->id]) }}"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg flex items-center">
                        <i class="fas fa-print mr-2"></i>
                        Print Invoice
                    </a>
                </div>
            </div>

            <form id="editTransactionForm" action="/transactions/{{ $transaction->id }}" method="POST" class="flex flex-col h-full">
                @csrf
                @method('PUT')

                <div class="mt-6 grid gap-4 lg:grid-cols-2 lg:grid-rows-2">
                    <div class="relative lg:row-start-1 w-full">
                        <div class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg rounded-tl-[2rem]">
                            <label for="id_transaksi" class="block text-md font-medium text-gray-800 dark:text-white">ID Transaksi</label>
                            <input type="text" name="id_transaksi" id="id_transaksi" value="{{ $transaction->id }}" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full" readonly>
                            
                            <label for="tanggal_pembelian" class="block text-md font-medium text-gray-800 dark:text-white mt-4">Tanggal Pembelian</label>
                            <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" value="{{ $transaction->created_at->format('Y-m-d') }}" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full" readonly>
                            
                            <label for="nama_lengkap" class="block text-md font-medium text-gray-800 dark:text-white mt-4">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ $transaction->user->name }}" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full" readonly>
                            
                            <label for="email" class="block text-md font-medium text-gray-800 dark:text-white mt-4">Email</label>
                            <input type="email" name="email" id="email" value="{{ $transaction->user->email }}" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full" readonly>
                        </div>
                    </div>

                    <!-- Status & Alamat -->
                    <div class="relative lg:row-start-1 w-full">
                        <div class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg rounded-tr-[2rem]">
                            <label for="status"class="block text-md font-medium text-gray-800 dark:text-white">Total Harga</label>
                            <input type="text" value="Rp. {{ number_format($transaction->total_amount) }}"
                                class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full"
                                readonly>
                            <label for="status"
                                class="block text-md font-medium text-gray-800 dark:text-white mt-4">Status</label>
                            <select name="status" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 w-full">
                                <option value="completed" {{ $transaction->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="canceled" {{ $transaction->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                            <label for="alamat_tujuan"
                                class="block text-md font-medium text-gray-800 dark:text-white mt-4">Alamat Tujuan</label>
                                <textarea name="alamat-tujuan" rows="4" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 mt-2 mb-2.5 w-full">{{ $transaction->destination_address }}</textarea>
                        </div>
                    </div>

                    <!-- Total Harga & Produk -->
                    <div class="relative lg:row-start-2 lg:col-start-1 lg:col-span-2 w-full">
                        <div class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg rounded-bl-[2rem] rounded-br-[2rem]">
                            <label for="alamat_tujuan" class="block text-md font-medium text-gray-800 dark:text-white">Daftar Produk</label>
                            <div class="overflow-x-auto mt-2">
                                <div class="flex space-x-4">
                                    @foreach ($transaction->products as $product)
                                        <div class="min-w-max w-1/4 p-2">
                                            <div class="bg-amber-500 border border-gray-200 dark:border-gray-600 p-4 rounded-lg shadow-lg">
                                                <h4 class="text-md font-semibold text-gray-800 dark:text-white">{{ $product->name }}</h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-300">Jumlah: {{ $product->pivot->quantity }}</p>
                                                <p class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100">Rp. {{ number_format($product->price) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-auto text-center mb-4">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Keranjang Belanja') }}
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

    <!-- Main Container -->
    <div class="container mx-auto p-6">
        @if (empty($cart))
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
                <p>Keranjang anda kosong, silahkan memilih produk.</p>
            </div>
        @else
            <table class="min-w-full divide-y divide-gray-200 bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg mb-6">
                <thead class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white">
                    <tr>
                        <th class="border-b-2 px-2 py-1 text-left text-sm">Nama Produk</th>
                        <th class="border-b-2 px-2 py-1 text-left text-sm">Harga</th>
                        <th class="border-b-2 px-2 py-1 text-left text-sm">Kuantitas</th>
                        <th class="border-b-2 px-2 py-1 text-left text-sm">Total</th>
                        <th class="border-b-2 px-2 py-1 text-left text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white divide-y divide-gray-200">
                    @php $grandTotal = 0; @endphp
                    @foreach ($cart as $id => $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity']; 
                            $grandTotal += $subtotal; 
                        @endphp
                        <tr>
                            <td class="px-2 py-1 text-sm">{{ $item['name'] }}</td>
                            <td class="px-2 py-1 text-sm">Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td class="px-2 py-1 text-sm">{{ $item['quantity'] }}</td>
                            <td class="px-2 py-1 text-sm">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td class="px-2 py-1 text-sm">
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg mt-2 w-full mb-4">
                <h2 class="text-lg font-semibold mb-1">Subtotal Pembelian</h2>
                <div class="flex justify-between">
                    <span class="text-sm">Total Keseluruhan:</span>
                    <span class="font-bold">Rp{{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>
            </div>
        @endif

        <div class="mt-2 flex justify-between items-center">
            <a href="{{ route('products.index') }}" class="bg-amber-200 h text-gray-800 py-2 px-4 rounded">Kembali ke Produk</a>
            @if (!empty($cart))
                <a href="{{ route('cart.payment') }}" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Lanjutkan ke Pembayaran</a>
            @endif
        </div>
    </div>

    <!-- SweetAlert2 and jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.delete-form').on('submit', function(event) {
                event.preventDefault(); // Mencegah pengiriman form secepatnya
                const form = $(this); // Mendapatkan form yang di-submit

                // Tampilkan konfirmasi SweetAlert sebelum menghapus
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan menghapus produk ini dari keranjang!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.off('submit').submit(); // Menghapus event handler lalu submit form

                        Swal.fire({
                            title: 'Dihapus!',
                            text: 'Produk telah berhasil dihapus dari keranjang.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>

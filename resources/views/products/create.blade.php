<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Kelola Produk') }}
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

    <div class="container mx-auto my-5 px-4">

        <!-- Form Tambah Produk -->
        <div class="border border-gray-300 rounded-lg p-6 bg-white dark:bg-stone-600 mb-10">
            <h3 class="text-gray-800 dark:text-white text-lg font-semibold mb-4">Tambah Produk</h3>
            <form id="add-product-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-800 dark:text-white">Nama Produk</label>
                    <input type="text" name="name" id="name" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-800 dark:text-white">Deskripsi</label>
                    <textarea name="description" id="description" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-full"></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-800 dark:text-white">Harga</label>
                    <input type="number" name="price" id="price" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-800 dark:text-white">Stok</label>
                    <input type="number" name="stock" id="stock" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-800 dark:text-white">Kategori</label>
                    <select name="category_id" id="category_id" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-full">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-800 dark:text-white">Gambar</label>
                    <input type="file" name="image" id="image" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-full">
                </div>
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Tambah Produk</button>
            </form>
        </div>

        <!-- Tabel Daftar Produk -->
        <div class="border border-gray-300 rounded-lg p-6 bg-white dark:bg-stone-600 ">
            <h3 class="text-gray-800 dark:text-white text-lg font-semibold mb-4">Daftar Produk</h3>
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead class="bg-gray-200 dark:bg-stone-800 text-gray-800 dark:text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Produk</th>
                        <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                        <th class="border border-gray-300 px-4 py-2">Harga</th>
                        <th class="border border-gray-300 px-4 py-2">Stok</th>
                        <th class="border border-gray-300 px-4 py-2">Kategori</th>
                        <th class="border border-gray-300 px-4 py-2">Gambar</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="border border-gray-300 text-gray-800 dark:text-white px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 text-gray-800 dark:text-white px-4 py-2">{{ $product->name }}</td>
                            <td class="border border-gray-300 text-gray-800 dark:text-white px-4 py-2">{{ $product->description }}</td>
                            <td class="border border-gray-300 text-gray-800 dark:text-white px-4 py-2">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 text-gray-800 dark:text-white px-4 py-2">{{ $product->stock }}</td>
                            <td class="border border-gray-300 text-gray-800 dark:text-white px-4 py-2">{{ $product->category->name }}</td>
                            <td class="border border-gray-300 text-gray-800 dark:text-white px-4 py-2">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-30 h-30 object-cover">
                                @else
                                    <span class="text-gray-800 dark:text-white">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center space-x-2"> 
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="bg-amber-500 text-white px-4 py-2 rounded hover:bg-amber-600">
                                        Edit
                                    </a>
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 delete-btn">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $products->links() }} <!-- Menampilkan link untuk pagination -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector('#add-product-form').addEventListener('submit', function(e) {
            e.preventDefault();
    
            const name = document.querySelector('#name').value.trim();
            const description = document.querySelector('#description').value.trim();
            const price = document.querySelector('#price').value.trim();
            const stock = document.querySelector('#stock').value.trim();
            const image = document.querySelector('#image').files.length;
    
            let errorMessages = [];
    
            if (!name) {
                errorMessages.push('Nama produk harus diisi.');
            }
    
            if (!description) {
                errorMessages.push('Deskripsi produk harus diisi.');
            }
    
            if (!price) {
                errorMessages.push('Harga produk harus diisi.');
            } else if (isNaN(price) || price <= 0) {
                errorMessages.push('Harga harus berupa angka yang valid dan lebih besar dari 0.');
            }
    
            if (!stock) {
                errorMessages.push('Stok produk harus diisi.');
            } else if (isNaN(stock) || stock < 0) {
                errorMessages.push('Stok harus berupa angka yang valid dan tidak negatif.');
            }
    
            if (!image) {
                errorMessages.push('Gambar produk harus diunggah.');
            }
    
            if (errorMessages.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: `${errorMessages.map(msg => `${msg}`).join('')}`,
                    confirmButtonText: 'Perbaiki'
                });
            } else {
                Swal.fire({
                    title: 'Yakin ingin menambah produk?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Tambahkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            }
        });
        // SweetAlert untuk pesan sukses
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
</x-app-layout>

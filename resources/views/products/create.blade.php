<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Kelola Produk') }}
        </h2>
    </x-slot>

    <div class="container mx-auto my-5 px-4">

        <!-- Form Tambah Produk -->
        <div class="border border-gray-300 rounded-lg p-6 bg-white mb-10">
            <h3 class="text-lg font-semibold mb-4">Tambah Produk</h3>
            <form id="add-product-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" name="name" id="name" class="border rounded p-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" class="border rounded p-2 w-full"></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="price" id="price" class="border rounded p-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" name="stock" id="stock" class="border rounded p-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category_id" id="category_id" class="border rounded p-2 w-full">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" name="image" id="image" class="border rounded p-2 w-full">
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Tambah Produk</button>
            </form>
        </div>

        <!-- Tabel Daftar Produk -->
        <div class="border border-gray-300 rounded-lg p-6 bg-white">
            <h3 class="text-lg font-semibold mb-4">Daftar Produk</h3>
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
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
                            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->description }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->stock }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->category->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-30 h-30 object-cover">
                                @else
                                    <span class="text-gray-500">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center space-x-2"> 
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert untuk tambah produk
        document.querySelector('#add-product-form').addEventListener('submit', function(e) {
            e.preventDefault();
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
        });

        // SweetAlert untuk hapus produk
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Yakin ingin menghapus produk ini?',
                    text: "Data produk akan hilang secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
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

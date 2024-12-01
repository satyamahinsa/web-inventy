<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Produk') }}
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
        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <h3 class="text-gray-800 dark:text-white text-lg font-semibold mb-4">Edit Produk</h3>

        <!-- Formulir untuk Mengedit Produk -->
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-800 dark:text-white">Nama Produk</label>
                    <input type="text" name="name" id="name" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-full" value="{{ old('name', $product->name) }}" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-800 dark:text-white">Deskripsi</label>
                    <textarea name="description" id="description" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-full" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-800 dark:text-white">Harga</label>
                    <input type="number" name="price" id="price" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-full" value="{{ old('price', $product->price) }}" required>
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-800 dark:text-white">Stok</label>
                    <input type="number" name="stock" id="stock" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-full" value="{{ old('stock', $product->stock) }}" required>
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-800 dark:text-white">Kategori</label>
                    <select name="category_id" id="category_id" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-full" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-800 dark:text-white">Gambar Produk</label>
                    <input type="file" name="image" id="image" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-full">
                    <p class="text-sm text-gray-800 dark:text-white mt-2">Biarkan kosong jika tidak ingin mengganti gambar</p>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="mt-4 w-32 h-32 object-cover">
                    @endif
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Update Produk</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>

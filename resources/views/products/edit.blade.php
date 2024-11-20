<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="container mx-auto my-5 px-4">
        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <h3 class="text-lg font-semibold mb-4">Edit Produk</h3>

        <!-- Formulir untuk Mengedit Produk -->
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label for="name" class="block">Nama Produk</label>
                    <input type="text" name="name" id="name" class="border rounded p-2 w-full" value="{{ old('name', $product->name) }}" required>
                </div>

                <div>
                    <label for="description" class="block">Deskripsi</label>
                    <textarea name="description" id="description" class="border rounded p-2 w-full" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <div>
                    <label for="price" class="block">Harga</label>
                    <input type="number" name="price" id="price" class="border rounded p-2 w-full" value="{{ old('price', $product->price) }}" required>
                </div>

                <div>
                    <label for="stock" class="block">Stok</label>
                    <input type="number" name="stock" id="stock" class="border rounded p-2 w-full" value="{{ old('stock', $product->stock) }}" required>
                </div>

                <div>
                    <label for="category_id" class="block">Kategori</label>
                    <select name="category_id" id="category_id" class="border rounded p-2 w-full" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="image" class="block">Gambar Produk</label>
                    <input type="file" name="image" id="image" class="border rounded p-2 w-full">
                    <p class="text-sm text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengganti gambar</p>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="mt-4 w-32 h-32 object-cover">
                    @endif
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Produk</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>

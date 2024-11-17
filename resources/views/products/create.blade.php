<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <form action="{{ route('products.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        <input type="text" name="name" placeholder="Nama Produk" class="border rounded p-2 w-full">
        <textarea name="description" placeholder="Deskripsi" class="border rounded p-2 w-full mt-4"></textarea>
        <input type="number" name="price" placeholder="Harga" class="border rounded p-2 w-full mt-4">
        <input type="number" name="stock" placeholder="Stok" class="border rounded p-2 w-full mt-4">
        <select name="category" class="border rounded p-2 w-full mt-4">
            <option value="">Pilih Kategori</option>
            @foreach (['Elektronik', 'Pakaian', 'Buku', 'Perabotan', 'Mainan'] as $category)
                <option value="{{ $category }}">{{ $category }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-500 text-white rounded p-2 w-full mt-4">Tambah Produk</button>
    </form>
</div>

</body>
</html>

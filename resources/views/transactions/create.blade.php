<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function calculateTotalPrice() {
            let total = 0;
            document.querySelectorAll('.product-checkbox').forEach(function(checkbox) {
                if (checkbox.checked) {
                    let productId = checkbox.getAttribute('data-product-id');
                    let price = parseFloat(checkbox.getAttribute('data-price'));
                    let quantity = document.querySelector(`#quantity_${productId}`).value;
                    total += price * quantity;
                }
            });
            document.getElementById('total_price').value = total;
        }
    </script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <div class="mx-auto flex flex-col justify-center items-center max-w-2xl px-6 lg:max-w-7xl lg:px-8">
            <div class="mt-3 text-center">
                <h1 class="text-3xl font-semibold text-gray-900">Buat Transaksi</h1>
                <p class="text-gray-600">Lengkapi data transaksi yang mencakup pengguna, harga total, dan layanan pengiriman.</p>
            </div>

            <div class="mt-5 bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl">
                @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="sm:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat Tujuan</label>
                            <textarea name="address" id="address" rows="3" class="mt-1 p-3 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Masukkan alamat tujuan..." required>{{ old('address') }}</textarea>
                        </div>

                        <div>
                            <label for="shipping_service" class="block text-sm font-medium text-gray-700">Layanan Pengiriman</label>
                            <select name="shipping_service" id="shipping_service" class="mt-1 p-3 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                @foreach($shippingServices as $service)
                                    <option value="{{ $service }}">{{ $service }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="products" class="block text-sm font-medium text-gray-700">Pilih Produk</label>
                            <div class="mt-2 bg-white p-4 border border-gray-200 rounded-lg shadow-sm">
                                @foreach ($products as $product)
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="products[]" id="product_{{ $product->id }}" value="{{ $product->id }}"
                                                data-product-id="{{ $product->id }}" data-price="{{ $product->price }}" class="product-checkbox mr-3 h-5 w-5 text-indigo-600"
                                                onchange="calculateTotalPrice()">
                                            <label for="product_{{ $product->id }}" class="text-gray-700 font-medium">{{ $product->name }} - Rp{{ number_format($product->price, 0, ',', '.') }}</label>
                                        </div>
                                        <input type="number" name="quantities[]" id="quantity_{{ $product->id }}" class="w-14 text-center border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="Qty" min="1" value="1" onchange="calculateTotalPrice()">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label for="total_price" class="block text-sm font-medium text-gray-700">Total Price</label>
                            <input type="number" name="total_price" id="total_price" value="0" class="mt-1 p-3 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" readonly>
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Daftar Produk') }}
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
        <form action="{{ route('products.index') }}" method="GET" class="flex items-center mb-4" id="searchForm">
            <input type="text" name="search" placeholder="Cari produk..." class="bg-white dark:bg-gray-500 text-gray-800 dark:placeholder:text-white dark:text-white border dark:border-white rounded py-2 px-4 w-32 sm:w-44 md:w-56" value="{{ request('search') }}">
            <button type="submit" class="ml-2 bg-red-500 text-white rounded p-2">Cari</button>
        </form>

        <div class="flex flex-wrap gap-4 mb-6 border-b-2 pb-4">
            <a href="{{ route('products.index') }}" class="bg-red-500 hover:bg-red-600 dark:bg-amber-200 hover:dark:bg-amber-300 dark:text-gray-800 text-white border border-gray-400 dark:border-white rounded py-2 px-4">
                Semua Kategori ({{ $totalProducts }})
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="bg-red-500 hover:bg-red-600 dark:bg-amber-200 hover:dark:bg-amber-300 dark:text-gray-800 text-white border border-gray-400 dark:border-white rounded py-2 px-4">
                    {{ $category->name }} ({{ $category->products_count }})
                </a>
            @endforeach
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($products->isEmpty())
            <div class="bg-red-500 text-white border border-gray-400 dark:border-white rounded py-2 px-4">
                <p>Maaf, tidak ada produk yang tersedia untuk kategori dan pencarian yang Anda pilih.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="product-card bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg cursor-pointer" data-product-id="{{ $product->id }}">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-60 object-cover rounded mb-4">
                        <h2 class="text-lg font-semibold text-center uppercase">{{ $product->name }}</h2> <!-- Center and Uppercase -->
                    </div>

                    <!-- Pop-up Modal -->
                    <div id="product-modal-{{ $product->id }}" class="product-modal fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
                        <div class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg w-full max-w-2xl relative flex">
                            <div class="w-1/3">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded">
                            </div>

                            <div class="w-2/3 pl-6 max-h-[500px] overflow-y-auto">
                                <button class="absolute top-2 right-2 text-gray-800 dark:text-white text-2xl" id="close-modal-{{ $product->id }}">×</button>
                                <h2 class="text-lg font-bold mb-2">{{ $product->name }}</h2>
                                <p class="text-gray-800 dark:text-white">{{ $product->description }}</p>
                                <p class="text-gray-800 dark:text-white font-bold mt-2">Harga: Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-gray-800 dark:text-white">Stok: {{ $product->stock }}</p>

                                <form action="{{ route('products.addToCart', $product->id) }}" method="POST" class="add-to-cart-form mt-4">
                                    @csrf
                                    <div class="flex items-center mt-4">
                                        <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1" class="bg-white dark:bg-gray-500 text-gray-800 dark:text-white border dark:border-white rounded p-2 w-16">
                                        <button type="submit" class="ml-2 bg-red-500 text-white py-2 px-4 rounded flex items-center">
                                            <i class="fas fa-shopping-cart mr-2"></i>
                                            Tambah
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Controls -->
            <div class="flex justify-center mt-10">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    <!-- Cart Icon -->
    <div class="cart fixed bottom-4 right-4 w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center">
        <a href="{{ route('cart.index') }}" class="text-white flex items-center justify-center w-full h-full relative">
            <i class="fas fa-shopping-cart"></i>
            <span id="cart-count" class="cart-count">{{ $cartCount }}</span>
        </a>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Handle card click to show modal with product details
            $('.product-card').on('click', function() {
                var productId = $(this).data('product-id');
                var modal = $('#product-modal-' + productId);
    
                // Show the modal
                modal.removeClass('hidden').addClass('flex');
            });
    
            // Handle closing the modal
            $('.product-modal button').on('click', function() {
                var modal = $(this).closest('.product-modal');
                modal.addClass('hidden').removeClass('flex');
            });
    
            // Handle form submit (Add to Cart)
            $('.add-to-cart-form').on('submit', function(event) {
                event.preventDefault();
                const form = $(this);
                const quantity = form.find('input[name="quantity"]').val();
                const actionUrl = form.attr('action');
    
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: quantity
                    },
                    success: function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Produk Ditambahkan',
                            text: 'Produk telah berhasil ditambahkan ke keranjang!',
                            showConfirmButton: true,  
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.close();  
                            }
                        });
    
                        // Update cart count
                        const currentCount = parseInt($('#cart-count').text()) || 0;
                        $('#cart-count').text(currentCount + parseInt(quantity));
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat menambahkan produk!',
                        });
                    }
                });
            });
        });
    </script>    
</x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventy - Pemasok Langsung dari Pabrik ke Pelanggan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100">

    <!-- Hero Section -->
    <header class="bg-gradient-to-r from-yellow-400 to-orange-500 p-10 text-white text-center">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">
                INVENTY
            </div>
            <div class="space-x-4">
                @if (Route::has('login'))
                    <nav class="flex space-x-4">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="bg-red-600 px-4 py-2 rounded-full font-semibold text-white transition hover:text-black/70 focus:outline-none focus-visible:ring-2 focus-visible:ring-white"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="bg-red-600 px-4 py-2 rounded-full font-semibold text-white transition hover:text-black/70 focus:outline-none focus-visible:ring-2 focus-visible:ring-white"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="bg-red-600 px-4 py-2 rounded-full font-semibold text-white transition hover:text-black/70 focus:outline-none focus-visible:ring-2 focus-visible:ring-white"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
        <div class="container mx-auto mt-6">
            <h1 class="text-4xl font-bold mb-4">PEMASOK KEBUTUHAN LANGSUNG DARI PABRIK KE PELANGGAN</h1>
            <p class="text-lg mb-6">Kualitas Terbaik Dengan Harga Pabrik, Langsung ke Pintu Rumah Anda</p>
            <button class="bg-red-600 text-white px-6 py-3 rounded-full font-semibold">Promosikan Produk Anda</button>
        </div>
    </header>

    <!-- Keunggulan Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">KEUNGGULAN</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-yellow-100 rounded-lg">
                    <i class="fas fa-tags text-4xl text-yellow-500 mb-4"></i>
                    <h3 class="font-bold text-xl mb-4">Harga Pabrik</h3>
                    <p>Harga langsung dari pabrik tanpa perantara, memastikan harga termurah untuk kebutuhan Anda.</p>
                </div>
                <div class="p-6 bg-yellow-100 rounded-lg">
                    <i class="fas fa-shipping-fast text-4xl text-yellow-500 mb-4"></i>
                    <h3 class="font-bold text-xl mb-4">Pengiriman Cepat</h3>
                    <p>Pengiriman cepat langsung dari gudang kami ke alamat Anda tanpa menunggu lama.</p>
                </div>
                <div class="p-6 bg-yellow-100 rounded-lg">
                    <i class="fas fa-check-circle text-4xl text-yellow-500 mb-4"></i>
                    <h3 class="font-bold text-xl mb-4">Kualitas Terjamin</h3>
                    <p>Kami menjamin produk berkualitas tinggi dengan sertifikasi dan garansi resmi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pengenalan Fitur Section -->
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">PENGENALAN FITUR</h2>
            <div class="flex flex-wrap justify-center gap-12">
                <div class="text-center">
                    <i class="fas fa-chart-bar text-6xl text-yellow-500 mb-4"></i>
                    <h4 class="font-bold text-lg">LAPORAN</h4>
                </div>
                <div class="text-center">
                    <i class="fas fa-box text-6xl text-yellow-500 mb-4"></i>
                    <h4 class="font-bold text-lg">PRODUK</h4>
                </div>
                <div class="text-center">
                    <i class="fas fa-exchange-alt text-6xl text-yellow-500 mb-4"></i>
                    <h4 class="font-bold text-lg">TRANSAKSI</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Perkembangan Kinerja Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">STATISTIK PERKEMBANGAN KINERJA</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6">
                    <i class="fas fa-boxes text-6xl text-yellow-500 mb-4"></i>
                    <h3 class="font-bold text-xl">10.000+</h3>
                    <p>Total Produk Terkirim</p>
                </div>
                <div class="p-6">
                    <i class="fas fa-truck-loading text-6xl text-yellow-500 mb-4"></i>
                    <h3 class="font-bold text-xl">98%</h3>
                    <p>Pengiriman Tepat Waktu</p>
                </div>
                <div class="p-6">
                    <i class="fas fa-star text-6xl text-yellow-500 mb-4"></i>
                    <h3 class="font-bold text-xl">4.9/5</h3>
                    <p>Kualitas Produk</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Pelanggan Section -->
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">TESTIMONI PELANGGAN</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-white rounded-lg shadow">
                    <p>"Saya sangat puas dengan produk yang saya beli, kualitasnya sangat baik dan pengirimannya cepat. Highly recommended!"</p>
                    <h4 class="mt-4 font-bold">- Putri, Bandung</h4>
                </div>
                <div class="p-6 bg-white rounded-lg shadow">
                    <p>"Proses pembelian sangat mudah dan harga sangat terjangkau. Kualitas produk juga sesuai dengan ekspektasi saya."</p>
                    <h4 class="mt-4 font-bold">- Budi, Surabaya</h4>
                </div>
                <div class="p-6 bg-white rounded-lg shadow">
                    <p>"Pelayanan yang sangat baik dan sangat membantu. Pengiriman tepat waktu dan kondisi produk sempurna."</p>
                    <h4 class="mt-4 font-bold">- Sari, Jakarta</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-yellow-400 p-6 text-white">
        <div class="container mx-auto flex flex-wrap justify-between">
            <div class="w-full md:w-1/3 mb-6">
                <h4 class="font-bold text-lg mb-4">INVENTY</h4>
                <p>Pasokan kebutuhan langsung dari pabrik, memberikan harga terbaik dan kualitas unggul kepada pelanggan kami.</p>
            </div>
            <div class="w-full md:w-1/3 mb-6">
                <h4 class="font-bold text-lg mb-4">HUBUNGI KAMI</h4>
                <p>Email: info@inventy.com</p>
                <p>Telepon: +62 21 1234 5678</p>
            </div>
            <div class="w-full md:w-1/3 mb-6">
                <h4 class="font-bold text-lg mb-4">IKUTI KAMI</h4>
                <div class="flex space-x-4">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

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

<!-- Hero Classes -->
<header class="bg-gradient-to-r from-yellow-400 to-gray-400 p-10">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo dan Teks Inventy -->
        <div class="flex items-center gap-4 text-2xl font-bold text-white">
            <img src="/ImplementasiPengujianPL/FinalProject/FP/web-inventy/public/LandingPage/LOGO1.png" alt="Logo Inventy" class="w-8 h-8">
            INVENTY
        </div>
        <!-- Navigasi Sign In dan Sign Up -->
        <div class="flex space-x-4">
            <a
                href="{{ route('login') }}"
                class="text-white font-semibold px-4 py-2 border border-white rounded-full hover:bg-white hover:text-red-600 transition"
            >
                Sign in
            </a>
            <a
                href="{{ route('register') }}"
                class="bg-red-600 text-white font-semibold px-4 py-2 rounded-full hover:bg-white hover:text-red-600 transition"
            >
                Sign Up
            </a>
        </div>
    </div>

    <div class="container mx-auto mt-16 grid grid-cols-2 gap-8">
        <!-- Container 1 (Kiri) -->
        <div class="text-left">
            <h1 class="text-4xl font-bold text-white mb-4">PEMASOK KEBUTUHAN LANGSUNG DARI PABRIK KE PELANGGAN</h1>
            <hr class="border-white mb-4">
            <p class="text-lg text-white mb-6">Kualitas Terbaik Dengan Harga Pabrik, Langsung Di Antar Ke Lokasi Anda</p>
            <button class="bg-red-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-red-600 transition">
                Penawaran Khusus
            </button>
        </div>

        <!-- Container 2 (Kanan) -->
        <div class="flex justify-center items-center">
            <img src="/ImplementasiPengujianPL/FinalProject/FP/web-inventy/public/LandingPage/LOGO2.png" alt="Ilustrasi" class="w-72">
        </div>
    </div>
</header>

<!-- Keunggulan Section -->
<section class="bg-white py-16">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">KEUNGGULAN</h2>
        <h3 class="text-xl font-normal mb-12">Beberapa jenis kriteria penjualan UMKM di Indonesia</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Container 1 -->
            <div class="bg-gray-200 p-8 rounded-lg shadow-lg flex flex-col justify-between">
                <div>
                    <div class="bg-yellow-400 p-4 rounded-lg mb-6 flex items-center justify-center">
                        <h3 class="text-xl font-bold">HARGA PABRIK</h3>
                    </div>
                    <p class="mb-6">Inventy menawarkan produk langsung dari pabrik tanpa adanya perantara atau distributor tambahan, yang memungkinkan pelanggan untuk mendapatkan harga terbaik dan lebih kompetitif. Dengan model bisnis ini, pelanggan dapat menghindari kenaikan harga yang biasanya terjadi ketika produk melewati beberapa tingkat distribusi sebelum sampai ke tangan konsumen akhir.</p>
                </div>
                <div class="flex justify-center mt-6">
                    <img src="{{ asset('/ImplementasiPengujianPL/FinalProject/FP/web-inventy/public/LandingPage/LOGO2.png') }}" alt="Harga Pabrik Logo" class="h-24">
                </div>
            </div>
            <!-- Container 2 -->
            <div class="bg-gray-200 p-8 rounded-lg shadow-lg flex flex-col justify-between">
                <div>
                    <div class="bg-yellow-400 p-4 rounded-lg mb-6 flex items-center justify-center">
                        <h3 class="text-xl font-bold">PENGIRIMAN CEPAT</h3>
                    </div>
                    <p class="mb-6">Inventy bekerja sama dengan mitra logistik yang berpengalaman dan terpercaya untuk memastikan pengiriman yang cepat dan aman. Pilihan pengiriman yang beragam, mulai dari ekspres hingga reguler, memungkinkan pelanggan memilih sesuai kebutuhan dan urgensi.</p>
                </div>
                <div class="flex justify-center mt-6">
                    <img src="{{ asset('/ImplementasiPengujianPL/FinalProject/FP/web-inventy/public/LandingPage/LOGO3b.png') }}" alt="Pengiriman Cepat Logo" class="h-24">
                </div>
            </div>
            <!-- Container 3 -->
            <div class="bg-gray-200 p-8 rounded-lg shadow-lg flex flex-col justify-between">
                <div>
                    <div class="bg-yellow-400 p-4 rounded-lg mb-6 flex items-center justify-center">
                        <h3 class="text-xl font-bold">KUALITAS TERJAMIN</h3>
                    </div>
                    <p class="mb-6">Inventy berkomitmen untuk menyediakan produk dengan standar kualitas tinggi. Setiap produk melalui proses pengecekan kualitas sebelum dikirim ke pelanggan. Selain itu, Inventy juga menawarkan garansi resmi untuk memberikan jaminan tambahan kepada pelanggan bahwa produk yang mereka beli aman dan berkualitas.</p>
                </div>
                <div class="flex justify-center mt-6">
                    <img src="{{ asset('/ImplementasiPengujianPL/FinalProject/FP/web-inventy/public/LandingPage/LOGO3c.png') }}" alt="Kualitas Terjamin Logo" class="h-24">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pengenalan Fitur Section -->
<section class="bg-gradient-to-r from-yellow-400 to-gray-400 py-16">
    <div class="container mx-auto text-center">
        <h2 class="text-5xl font-bold mb-8 text-white">PENGENALAN FITUR</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Container 1 -->
            <div class="flex flex-col items-center">
                <h4 class="font-bold text-2xl text-white mb-4">LAPORAN</h4>
                <img src="{{ asset('/ImplementasiPengujianPL/FinalProject/FP/web-inventy/public/LandingPage/LOGO6a.png') }}" alt="Laporan" class="h-16">
            </div>
            <!-- Container 2 -->
            <div class="flex flex-col items-center">
                <h4 class="font-bold text-2xl text-white mb-4">PRODUK</h4>
                <img src="{{ asset('/ImplementasiPengujianPL/FinalProject/FP/web-inventy/public/LandingPage/LOGO6b.png') }}" alt="Produk" class="h-16">
            </div>
            <!-- Container 3 -->
            <div class="flex flex-col items-center">
                <h4 class="font-bold text-2xl text-white mb-4">TRANSAKSI</h4>
                <img src="{{ asset('/ImplementasiPengujianPL/FinalProject/FP/web-inventy/public/LandingPage/LOGO6c.png') }}" alt="Transaksi" class="h-16">
            </div>
        </div>
    </div>
</section>


<!-- Statistik Perkembangan Kinerja Section -->
<section class="bg-white py-16">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-8 text-yellow-600">STATISTIK PERKEMBANGAN KINERJA</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Container 1 -->
            <div class="bg-gray-100 p-8 rounded-lg shadow-lg flex flex-col items-center">
                <img src="{{ asset('/ImplementasiPengujianPL/FinalProject/FP/web-inventy/public/LandingPage/LOGO5a.png') }}" alt="Total Produk Terjual" class="h-16 mb-4">
                <h3 class="font-bold text-3xl mb-2">10.000+</h3>
                <p class="text-lg">Total Produk Terjual</p>
            </div>
            <!-- Container 2 -->
            <div class="bg-gray-100 p-8 rounded-lg shadow-lg flex flex-col items-center">
                <img src="{{ asset('/ImplementasiPengujianPL/FinalProject/FP/web-inventy/public/LandingPage/LOGO5b.png') }}" alt="Pengiriman Tepat Waktu" class="h-16 mb-4">
                <h3 class="font-bold text-3xl mb-2">98%</h3>
                <p class="text-lg">Pengiriman Tepat Waktu</p>
            </div>
            <!-- Container 3 -->
            <div class="bg-gray-100 p-8 rounded-lg shadow-lg flex flex-col items-center">
                <img src="{{ asset('/ImplementasiPengujianPL/FinalProject/FP/web-inventy/public/LandingPage/LOGO5c.png') }}" alt="Kualitas Produk" class="h-16 mb-4">
                <h3 class="font-bold text-3xl mb-2">4.9/5</h3>
                <p class="text-lg">Kualitas Produk</p>
            </div>
        </div>
    </div>
</section>


<!-- Testimoni Pelanggan Section -->
<section class="bg-gradient-to-r from-yellow-300 to-gray-400 py-16">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-8">TESTIMONI PELANGGAN</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Container -->
            <div class="p-6 bg-white rounded-lg shadow-md">
                <p class="text-gray-800 text-lg italic">"Saya sangat puas dengan kualitas produk dari Inventy. Barang langsung dari pabrik, dan pengirimannya juga cepat! Sangat direkomendasikan untuk perusahaan yang butuh suplai berkelanjutan."</p>
                <h4 class="mt-4 font-bold text-gray-900">Pak Budi Nugroho</h4>
            </div>
            <!-- Middle Container -->
            <div class="p-6 bg-white rounded-lg shadow-md">
                <p class="text-gray-800 text-lg italic">"Saya sangat puas dengan kualitas produk dari Inventy. Barang langsung dari pabrik, dan pengirimannya juga cepat! Sangat direkomendasikan untuk perusahaan yang butuh suplai berkelanjutan."</p>
                <h4 class="mt-4 font-bold text-gray-900">Pak Budi Nugroho</h4>
            </div>
            <!-- Right Container -->
            <div class="p-6 bg-white rounded-lg shadow-md">
                <p class="text-gray-800 text-lg italic">"Saya sangat puas dengan kualitas produk dari Inventy. Barang langsung dari pabrik, dan pengirimannya juga cepat! Sangat direkomendasikan untuk perusahaan yang butuh suplai berkelanjutan."</p>
                <h4 class="mt-4 font-bold text-gray-900">Pak Budi Nugroho</h4>
            </div>
        </div>
    </div>
</section>


<!-- Footer Section -->
<footer class="bg-gradient-to-r from-yellow-300 to-gray-400 py-10">
    <!-- Horizontal Line -->
    <div class="w-full border-t border-gray-400 mb-8"></div>

    <div class="container mx-auto">
        <!-- Email Subscription -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
            <!-- Left Section (Logo & Form) -->
            <div class="col-span-1">
                <div class="flex items-center mb-4">
                    <!-- Logo -->
                    <div class="bg-green-500 rounded-full p-2 mr-3">
                        <img src="/ImplementasiPengujianPL/FinalProject/FP/web-inventy/public/LandingPage/LOGO1.png" alt="Inventy Logo" class="w-8 h-8">
                    </div>
                    <h4 class="text-lg font-bold text-white">INVENTY</h4>
                </div>
                <p class="text-white mb-6">Subscribe to keep up with the latest news</p>
                <form class="flex">
                    <input type="email" placeholder="enter your email..." class="flex-1 px-4 py-2 text-gray-700 rounded-l-lg focus:outline-none">
                    <button class="bg-yellow-400 px-6 py-2 rounded-r-lg text-gray-800 font-bold">→</button>
                </form>
                <p class="text-sm text-white mt-4">by submitting this form, you acknowledge that you have the terms of our Privacy Statement</p>
            </div>

            <!-- Middle Section (Solutions - Column 1) -->
            <div class="col-span-1 text-white">
                <h4 class="font-bold text-lg mb-4">Solutions</h4>
                <ul>
                    <li class="mb-2">MasterCard</li>
                    <li class="mb-2">Louis Vuitton</li>
                    <li class="mb-2">Gillette</li>
                    <li class="mb-2">Apple</li>
                    <li class="mb-2">General Electric</li>
                </ul>
            </div>

            <!-- Right Section (Solutions - Column 2) -->
            <div class="col-span-1 text-white">
                <h4 class="font-bold text-lg mb-4">Solutions</h4>
                <ul>
                    <li class="mb-2">Home</li>
                    <li class="mb-2">About</li>
                    <li class="mb-2">Services</li>
                    <li class="mb-2">Contact</li>
                    <li class="mb-2">Term and conditions</li>
                </ul>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="flex justify-between items-center mt-10 text-white">
            <p class="text-sm">Copyright © Foodhub 2022</p>
            <div class="flex space-x-4">
                <a href="#" class="text-white"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white"><i class="fab fa-linkedin"></i></a>
                <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>

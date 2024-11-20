<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="flex items-center">
            <button class="mr-6">
                <i class="fas fa-bell text-gray-500"></i>
            </button>
            <div class="flex items-center space-x-3">
                <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150" alt="User Avatar">
                <span class="text-gray-900 font-medium dark:text-white">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto my-5 px-4">
        <!-- Hero Section -->
        <div class="bg-green-500 dark:bg-green-800 p-6 rounded-lg shadow mb-6">
            <h1 class="text-2xl font-bold text-white">Selamat Datang, {{ Auth::user()->name }}</h1>
            <p class="text-sm text-white mt-2">Temukan produk terbaik kami untuk memenuhi kebutuhan Anda!</p>
        </div>

        <div class="relative w-full overflow-hidden rounded-lg shadow-lg mb-6">
            <!-- Wrapper untuk carousel -->
            <div class="relative mx-auto flex transition-transform duration-500 ease-in-out" id="carousel-wrapper">
                <!-- Slide 1 -->
                <div class="flex-none w-full bg-purple-200 py-8 px-20 flex items-center justify-between">
                    <div>
                        <h4 class="text-purple-700 font-medium text-lg">Official Store</h4>
                        <h2 class="text-black font-extrabold text-3xl">Pasti Promo Pasti Ori</h2>
                        <a href="#" class="text-purple-900 font-semibold mt-2 inline-block">Lihat Promo Lainnya</a>
                    </div>
                    <img src="path/to/image1.png" alt="Promo Image" class="h-32 object-contain">
                </div>
                <!-- Slide 2 -->
                <div class="flex-none w-full bg-blue-200 py-8 px-20 flex items-center justify-between">
                    <div>
                        <h4 class="text-blue-700 font-medium text-lg">Special Deals</h4>
                        <h2 class="text-black font-extrabold text-3xl">Diskon Hingga 50%</h2>
                        <a href="#" class="text-blue-900 font-semibold mt-2 inline-block">Belanja Sekarang</a>
                    </div>
                    <img src="path/to/image2.png" alt="Promo Image" class="h-32 object-contain">
                </div>
                <!-- Slide 3 -->
                <div class="flex-none w-full bg-green-200 py-8 px-20 flex items-center justify-between">
                    <div>
                        <h4 class="text-green-700 font-medium text-lg">Limited Time</h4>
                        <h2 class="text-black font-extrabold text-3xl">Flash Sale Hari Ini</h2>
                        <a href="#" class="text-green-900 font-semibold mt-2 inline-block">Lihat Sekarang</a>
                    </div>
                    <img src="path/to/image3.png" alt="Promo Image" class="h-32 object-contain">
                </div>
            </div>
        
            <!-- Navigasi -->
            <button id="prevBtn" class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white w-10 h-10 rounded-full shadow-md flex items-center justify-center hover:bg-gray-200">
                <span>&#10094;</span>
            </button>
            <button id="nextBtn" class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white w-10 h-10 rounded-full shadow-md flex items-center justify-center hover:bg-gray-200">
                <span>&#10095;</span>
            </button>
        </div>

        <div class="bg-amber-100 p-6 rounded-lg shadow-lg mb-6 relative">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-amber-800">Flash Sale</h2>
                    <p class="text-gray-600">Berakhir dalam 
                        <span id="countdown" class="bg-red-500 text-white px-2 py-1 rounded-lg font-semibold text-sm">01:00:00</span>
                    </p>
                </div>
                <a href="#" class="text-amber-600 font-medium hover:underline">Lihat Semua</a>
            </div>
        
            <!-- Wrapper untuk Carousel Flash Sale -->
            <div class="mt-4 overflow-hidden relative">
                <div id="flash-sale-wrapper" class="flex gap-4 transition-transform duration-500 ease-in-out">
                    <!-- Kartu Promo -->
                    <div class="flex-none w-48 bg-amber-300 rounded-lg p-4 flex flex-col items-center justify-center shadow">
                        <h4 class="text-amber-700 font-bold text-lg">FLASH SALE</h4>
                        <p class="text-amber-900 text-center text-2xl font-extrabold mt-2">Serba Diskon</p>
                        <button class="bg-green-500 text-white font-medium px-4 py-2 rounded mt-4 hover:bg-green-600">
                            Cek Promo
                        </button>
                        <p class="text-xs text-gray-700 mt-2">*S&K Berlaku</p>
                    </div>
        
                    <!-- Produk Flash Sale -->
                    @foreach ($flashSaleProducts as $product)
                        <div class="flex-none w-52 bg-white rounded-lg shadow p-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-32 w-full object-cover rounded-md">
                            <div class="mt-2">
                                <h4 class="text-sm font-semibold truncate">{{ $product->name }}</h4>
                                <p class="text-lg font-bold text-red-600 mt-1">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-500 line-through">
                                    Rp{{ number_format($product->original_price, 0, ',', '.') }}
                                </p>
                                <p class="text-sm text-red-500 font-semibold">{{ $product->discount }}% OFF</p>
                                <p class="text-xs text-gray-600 mt-2">Segera Habis</p>
                                <div class="bg-gray-200 h-2 w-full rounded-full mt-1">
                                    <div class="bg-red-500 h-2 rounded-full" style="width: {{ $product->stock_percentage }}%;"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        
            <!-- Navigasi -->
            <button id="flash-sale-prev" class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white w-10 h-10 rounded-full shadow-md flex items-center justify-center hover:bg-gray-200">
                <span>&#10094;</span>
            </button>
            <button id="flash-sale-next" class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white w-10 h-10 rounded-full shadow-md flex items-center justify-center hover:bg-gray-200">
                <span>&#10095;</span>
            </button>
        </div>
    </div>

    <!-- Script untuk Countdown dan Carousel -->
    <script>
        // Flash Sale Countdown
        const endTime = new Date().getTime() + (1 * 60 * 60 * 1000); // 1 jam dari sekarang

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = endTime - now;

            if (distance < 0) {
                document.getElementById("countdown").innerHTML = "EXPIRED";
                clearInterval(countdownInterval);
                return;
            }

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Perbarui countdown
            document.getElementById("countdown").innerHTML = 
                `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        const countdownInterval = setInterval(updateCountdown, 1000);

        // Carousel Logic
        const wrapper = document.getElementById('carousel-wrapper');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        let currentIndex = 0;

        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + wrapper.children.length) % wrapper.children.length;
            updateCarousel();
        });

        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % wrapper.children.length;
            updateCarousel();
        });

        function updateCarousel() {
            const width = wrapper.children[0].offsetWidth;
            wrapper.style.transform = `translateX(-${currentIndex * width}px)`;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const flashSaleWrapper = document.getElementById('flash-sale-wrapper');
            const flashSalePrev = document.getElementById('flash-sale-prev');
            const flashSaleNext = document.getElementById('flash-sale-next');
            let flashSaleIndex = 0;

            function updateFlashSaleCarousel() {
                const width = flashSaleWrapper.children[0].offsetWidth + 20;
                flashSaleWrapper.style.transform = `translateX(-${flashSaleIndex * width}px)`;

                flashSalePrev.disabled = flashSaleIndex === 0;
                flashSaleNext.disabled = flashSaleIndex === flashSaleWrapper.children.length - Math.floor(flashSaleWrapper.parentElement.offsetWidth / width);
                
                flashSalePrev.classList.toggle('opacity-50', flashSalePrev.disabled);
                flashSaleNext.classList.toggle('opacity-50', flashSaleNext.disabled);
            }

            flashSalePrev.addEventListener('click', () => {
                if (flashSaleIndex > 0) {
                    flashSaleIndex--;
                    updateFlashSaleCarousel();
                }
            });

            flashSaleNext.addEventListener('click', () => {
                const maxIndex = flashSaleWrapper.children.length - Math.floor(flashSaleWrapper.parentElement.offsetWidth / (flashSaleWrapper.children[0].offsetWidth + 18));
                if (flashSaleIndex < maxIndex) {
                    flashSaleIndex++;
                    updateFlashSaleCarousel();
                }
            });

            updateFlashSaleCarousel();
        });
    </script>
</x-app-layout>

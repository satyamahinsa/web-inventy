<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
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

    <div class="container mx-auto my-5 px-2 max-w-4x2">
        <!-- Kontainer Selamat Datang -->
        <div class="p-4 text-gray-800 dark:text-white bg-amber-500 dark:bg-red-500 rounded-lg shadow mb-4">
            @auth
                <div class="text-2xl font-bold">
                    {{ __('Selamat Datang, ') }}
                    <span class="welcome-message font-bold uppercase">{{ Auth::user()->name }}</span>
                </div>
                <p class="text-sm mt-2">Temukan produk terbaik kami untuk memenuhi kebutuhan Anda!</p>
            @else
                <div>{{ __("You're not logged in!") }}</div>
            @endauth
        </div>

        <div class="relative w-full overflow-hidden rounded-lg shadow-lg mb-5 max-w-4x2 mx-auto">
            <!-- Wrapper Slide -->
            <div id="auto-carousel-wrapper" class="relative w-full flex transition-transform duration-500 ease-in-out">
                <!-- Slide 1: Tempat Terpercaya -->
                <div class="flex-none w-full bg-purple-200 py-6 px-10 flex items-center justify-between">
                    <div>
                        <h4 class="text-purple-700 font-medium text-lg">Tempat Terpercaya</h4>
                        <h2 class="text-black font-extrabold text-2xl">Kebutuhan Anda, Langsung dari Pabrik</h2>
                        <a href="{{ route('products.index') }}"
                            class="text-purple-900 font-semibold mt-2 inline-block">Lihat Katalog Produk</a>
                    </div>
                </div>
                <!-- Slide 2: Special Deals -->
                <div class="flex-none w-full bg-blue-200 py-6 px-10 flex items-center justify-between">
                    <div>
                        <h4 class="text-blue-700 font-medium text-lg">Special Deals</h4>
                        <h2 class="text-black font-extrabold text-2xl">Diskon Hingga 20%</h2>
                        <a href="{{ route('products.index') }}"
                            class="text-blue-900 font-semibold mt-2 inline-block">Belanja Sekarang</a>
                    </div>
                </div>
                <!-- Slide 3: Limited Time -->
                <div class="flex-none w-full bg-green-200 py-6 px-10 flex items-center justify-between">
                    <div>
                        <h4 class="text-green-700 font-medium text-lg">Limited Time</h4>
                        <h2 class="text-black font-extrabold text-2xl">Flash Sale Hari Ini</h2>
                        <a href="#flashSale" class="text-green-900 font-semibold mt-2 inline-block">Lihat Sekarang</a>
                    </div>
                </div>
            </div>

            <!-- Navigasi -->
            <button id="prevBtn"
                class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white w-8 h-8 rounded-full shadow-md flex items-center justify-center hover:bg-gray-200">
                &#10094;
            </button>
            <button id="nextBtn"
                class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white w-8 h-8 rounded-full shadow-md flex items-center justify-center hover:bg-gray-200">
                &#10095;
            </button>
        </div>

        <!-- Kontainer Flash Sale -->
        <div class="bg-amber-500 p-6 rounded-lg shadow-lg mb-5 relative max-w-4xl mx-auto">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-amber-900">Flash Sale</h2>
                    <p class="text-sm text-gray-600">
                        Berakhir dalam
                        <span id="countdown"
                            class="bg-red-500 text-white px-2 py-1 rounded-lg font-semibold text-sm">01:00:00</span>
                    </p>
                </div>
                <a href="{{ route('products.index') }}" class="text-amber-600 font-medium hover:underline">Lihat
                    Semua</a>
            </div>

            <div id="flashSale" class="mt-4 relative overflow-hidden">
                <div id="flash-sale-wrapper" class="flex gap-4 transition-transform duration-500 ease-in-out">
                    @foreach ($flashSaleProducts as $product)
                        <div class="flex-none w-48 bg-white rounded-lg shadow p-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="h-32 w-full object-cover rounded-md">
                            <div class="mt-2">
                                <h4 class="text-sm font-semibold truncate">{{ $product->name }}</h4>
                                <p class="text-lg font-bold text-red-600 mt-1">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-500 line-through">
                                    Rp{{ number_format($product->original_price, 0, ',', '.') }}</p>
                                <p class="text-sm text-red-500 font-semibold">{{ $product->discount }}% OFF</p>
                                <p class="text-xs text-gray-600 mt-2">Segera Habis</p>
                                <div class="bg-gray-200 h-2 w-full rounded-full mt-1">
                                    <div class="bg-red-500 h-2 rounded-full"
                                        style="width: {{ $product->stock_percentage }}%;"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button id="flash-sale-prev"
                class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white w-8 h-8 rounded-full shadow-md flex items-center justify-center hover:bg-gray-200">
                &#10094;
            </button>
            <button id="flash-sale-next"
                class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white w-8 h-8 rounded-full shadow-md flex items-center justify-center hover:bg-gray-200">
                &#10095;
            </button>
        </div>



        @if (session('loginstatus'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: '{{ session('loginstatus') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif

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
                    flashSaleNext.disabled = flashSaleIndex === flashSaleWrapper.children.length - Math.floor(
                        flashSaleWrapper.parentElement.offsetWidth / width);

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
                    const maxIndex = flashSaleWrapper.children.length - Math.floor(flashSaleWrapper
                        .parentElement.offsetWidth / (flashSaleWrapper.children[0].offsetWidth + 18));
                    if (flashSaleIndex < maxIndex) {
                        flashSaleIndex++;
                        updateFlashSaleCarousel();
                    }
                });

                updateFlashSaleCarousel();
            });

            // Auto-Slide Carousel Logic
            document.addEventListener('DOMContentLoaded', () => {
                const wrapper = document.getElementById('auto-carousel-wrapper');
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');

                let currentIndex = 0;
                const slideCount = wrapper.children.length;
                const slideWidth = wrapper.children[0].offsetWidth;

                function updateCarousel() {
                    wrapper.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
                }

                nextBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex + 1) % slideCount;
                    updateCarousel();
                    resetAutoSlide();
                });

                prevBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex - 1 + slideCount) % slideCount;
                    updateCarousel();
                    resetAutoSlide();
                });

                // Fungsi Auto-Slide
                let autoSlideInterval = setInterval(() => {
                    currentIndex = (currentIndex + 1) % slideCount;
                    updateCarousel();
                }, 3000); 

                function resetAutoSlide() {
                    clearInterval(autoSlideInterval);
                    autoSlideInterval = setInterval(() => {
                        currentIndex = (currentIndex + 1) % slideCount;
                        updateCarousel();
                    }, 5000);
                }
            });
        </script>
</x-app-layout>

<!-- Sidebar -->
<div id="sidebar" class="bg-amber-300 text-gray-800 fixed h-screen p-4 z-10 top-0 left-0 flex flex-col justify-between w-64">
    <!-- Logo dan Tombol Hamburger -->
    <div class="flex flex-col">
        <div id="sidebarHeader" class="ml-3 flex items-center justify-between mb-8">
            <!-- Logo dan tombol hamburger di dalam sidebar -->
            <a href="/" class="font-bold text-2xl flex items-center space-x-2">
                <i id="sidebarLogo" class="fas fa-wave-square"></i>
                <!-- Text INVENTY dengan animasi fade dan slide -->
                <span id="sidebarLogoText" class="ml-3 text-lg transform opacity-100">INVENTY</span>
            </a>
            <!-- Tombol Hamburger dan Ikon Silang -->
            <button id="toggleSidebarButton" onclick="toggleSidebar()" class="text-lg focus:outline-none">
                <i id="hamburgerIcon" class="fas fa-bars hidden"></i>
                <i id="closeIcon" class="fas fa-times"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="space-y-4">
            <a href="{{ route('dashboard') }}" class="group flex items-center space-x-4 p-2 rounded hover:bg-white dark:hover:bg-amber-200">
                <i class="fas fa-home text-lg"></i>
                <span class="menu-text ml-2 opacity-100">Dashboard</span>
            </a>
            <!-- Menampilkan link produk untuk user biasa -->
            @if(auth()->user() && auth()->user()->role === 'user')
                <a href="{{ route('products.index') }}" class="group flex items-center space-x-4 p-2 rounded hover:bg-white dark:hover:bg-amber-200">
                    <i class="fas fa-box text-lg"></i>
                    <span class="menu-text ml-2 opacity-100">Produk</span>
                </a>
            @endif

            <!-- Menampilkan link produk hanya untuk admin -->
            @if(auth()->user() && auth()->user()->role === 'admin')
                <a href="{{ route('products.create') }}" class="group flex items-center space-x-4 p-2 rounded hover:bg-white dark:hover:bg-amber-200">
                    <i class="fas fa-box text-lg"></i>
                    <span class="menu-text ml-2 opacity-100">Tambah Produk</span>
                </a>
            @endif
            <a href="{{ route('transactions.index') }}" class="group flex items-center space-x-4 p-2 rounded hover:bg-white dark:hover:bg-amber-200">
                <i class="fas fa-exchange-alt text-lg"></i>
                <span class="menu-text ml-2 opacity-100">Transaksi</span>
            </a>
            @if(auth()->user() && auth()->user()->role === 'admin')
            <a href="{{ route('digital-report.index') }}" class="group flex items-center space-x-4 p-2 rounded hover:bg-white dark:hover:bg-amber-200">
                <i class="fas fa-chart-line text-lg"></i>
                <span class="menu-text ml-2 opacity-100">Laporan Penjualan</span>
            </a>
            @endif
        </nav>
    </div>

    <!-- Footer dengan Tombol Lain -->
    <div class="mt-auto space-y-4">
        <a href="{{ route('profile.edit') }}" class="group flex items-center space-x-4 p-2 rounded hover:bg-white dark:hover:bg-amber-200">
            <i class="fas fa-cog text-lg"></i>
            <span class="menu-text ml-2 opacity-100">Settings</span>
        </a>
        
        <!-- Log Out Form -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="group flex items-center space-x-4 p-2 rounded hover:bg-white dark:hover:bg-amber-200 w-full focus:outline-none">
                <i class="fas fa-sign-out-alt text-lg"></i>
                <span class="menu-text ml-2 opacity-100">Log Out</span>
            </button>
        </form>
    </div>
</div>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiase">
    <div class="min-h-screen bg-gray-100 flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Konten Utama -->
        <div id="mainContent" class="flex-1 transition-all duration-300 pl-64">
            @isset($header)
                <header class="bg-amber-500 dark:bg-amber-800 shadow">
                    <div class="max-w-7xl mx-auto py-3 px-4 sm:px-3 lg:px-8 flex items-center justify-between">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarLogo = document.getElementById('sidebarLogo');
            const sidebarLogoText = document.getElementById('sidebarLogoText');
            const menuTexts = document.querySelectorAll('.menu-text');
            const hamburgerIcon = document.getElementById('hamburgerIcon');
            const closeIcon = document.getElementById('closeIcon');
            const sidebarHeader = document.getElementById('sidebarHeader');

            // Toggle width sidebar
            sidebar.classList.toggle('w-20');
            sidebar.classList.toggle('w-64');

            // Toggle padding pada mainContent
            if (sidebar.classList.contains('w-20')) {
                mainContent.classList.replace('pl-64', 'pl-20');
                sidebarLogo.classList.add('opacity-0', '-translate-x-4');
                sidebarLogoText.classList.add('opacity-0', '-translate-x-4');
                sidebarHeader.classList.remove('justify-between');
                setTimeout(() => sidebarLogoText.classList.add('hidden'), 100);
                setTimeout(() => sidebarLogo.classList.add('hidden'), 100);

                // Hide menu texts
                menuTexts.forEach(text => {
                    text.classList.add('hidden');
                });

                hamburgerIcon.classList.remove('hidden'); // Tampilkan ikon hamburger
                closeIcon.classList.add('hidden'); // Sembunyikan ikon silang
            } else {
                sidebarLogo.classList.remove('hidden');
                sidebarLogoText.classList.remove('hidden');
                sidebarHeader.classList.add('justify-between');
                setTimeout(() => sidebarLogoText.classList.remove('opacity-0', '-translate-x-4'), 0);
                setTimeout(() => sidebarLogo.classList.remove('opacity-0', '-translate-x-4'), 0);
                mainContent.classList.replace('pl-20', 'pl-64');

                // Show menu texts
                menuTexts.forEach(text => {
                    text.classList.remove('hidden');
                });

                hamburgerIcon.classList.add('hidden'); // Sembunyikan ikon hamburger
                closeIcon.classList.remove('hidden'); // Tampilkan ikon silang
            }
        }
    </script>
</body>
</html>

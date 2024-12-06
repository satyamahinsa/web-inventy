<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('styleProduct/styles.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Inventy') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/tailwindcss">
        #toggleMode:checked ~ label div.toggleCircle {
            @apply translate-x-3;
        }
    </style>
</head>
<body class="font-sans antialiase">
    <div class="min-h-screen bg-amber-50 dark:bg-stone-500 flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Konten Utama -->
        <div id="mainContent" class="flex-1 transition-all duration-300 pl-64">
            @isset($header)
                <header class="bg-stone-800 shadow">
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
        document.addEventListener('DOMContentLoaded', function () {
            const html = document.querySelector('html');
            const checkbox = document.querySelector('#toggleMode');

            // Fungsi untuk mengatur tema
            function setTheme(theme) {
                if (theme === 'dark') {
                    html.classList.add('dark');
                    html.classList.remove('light');
                } else {
                    html.classList.add('light');
                    html.classList.remove('dark');
                }
            }

            // Event listener toggle
            checkbox.addEventListener('change', function () {
                const theme = checkbox.checked ? 'dark' : 'light';
                setTheme(theme);
                localStorage.setItem('theme', theme);
            });

            // Deteksi preferensi awal
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                setTheme(savedTheme);
                checkbox.checked = savedTheme === 'dark';
            } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                setTheme('dark');
                checkbox.checked = true;
            } else {
                setTheme('light');
            }
        });

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
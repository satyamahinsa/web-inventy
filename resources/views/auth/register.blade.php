<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css') <!-- Tailwind CSS CDN atau konfigurasi lainnya -->
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="w-full max-w-sm p-6 sm:p-8 space-y-6 bg-white rounded-lg shadow-lg flex flex-col justify-center items-center">
        <header class="text-2xl sm:text-3xl font-semibold text-center text-gray-700">Daftar Akun</header>

        <!-- Form Register -->
        <form method="POST" action="{{ route('register') }}" class="w-full space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-gray-600 font-medium">{{ __('Nama') }}</label>
                <input id="name" type="text" name="name" required autofocus autocomplete="name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-lg">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-gray-600 font-medium">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" required autocomplete="username"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-lg">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-gray-600 font-medium">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-lg">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-gray-600 font-medium">{{ __('Konfirmasi Password') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-lg">
                @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full py-2 mt-4 bg-amber-500 text-white font-semibold rounded-md hover:bg-amber-600 transition duration-200 sm:text-lg">
                Daftar
            </button>
        </form>

        <div class="text-center text-sm sm:text-base">
            <span>Apakah Sudah Memiliki Akun? 
                <a href="{{ route('login') }}" class="text-amber-500 hover:text-amber-700">Masuk</a>
            </span>
        </div>
    </div>

    @if (session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Sukses!',
                    text: '{{ session('status') }}', 
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

</body>

</html>

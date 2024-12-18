<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css') <!-- Tailwind CSS CDN atau konfigurasi lainnya -->
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div
        class="w-full max-w-sm max-h-sm p-6 sm:p-8 space-y-6 bg-white rounded-lg shadow-lg flex flex-col justify-center items-center">
        <header class="text-2xl sm:text-3xl font-semibold text-center text-gray-700">Masuk Akun</header>
        <img src="{{ asset('/imageAuth/login.png') }}" alt="Login Image" class="mx-auto mb-4 w-32 h-32 sm:w-40 sm:h-40">

        <!-- Status Message -->
        @if (session('status'))
            <div
                class="status-message bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded relative mb-4 text-center text-sm sm:text-base">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="w-full space-y-6">
            @csrf

            <!-- Email Input -->
            <div>
                <input type="email" name="email" placeholder="Masukkan Email" required autofocus
                    autocomplete="username"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-lg">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Password Input -->
            <div>
                <input type="password" name="password" placeholder="Masukkan Password" required
                    autocomplete="current-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-lg">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
                <div class="text-right">
                    <a href="{{ route('password.request') }}"
                        class="text-sm sm:text-base text-amber-500 hover:text-amber-700">Lupa Password?</a>
                </div>
            @endif

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-2 mt-4 bg-amber-500 text-white font-semibold rounded-md hover:bg-amber-600 transition duration-200 sm:text-lg">
                Masuk
            </button>
        </form>

        <div class="text-center text-sm sm:text-base">
            <span>Apakah Belum Memiliki Akun? <a href="{{ route('register') }}"
                    class="text-amber-500 hover:text-amber-700">Daftar</a></span>
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

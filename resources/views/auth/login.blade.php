<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                icon.textContent = '👁️';
            }
        }
    </script>
</head>

<body>
    <div class="flex h-screen">
        <div class="w-1/2 flex items-center justify-center bg-white">
            <form method="POST" action="{{ route('login') }}" class="w-full max-w-[400px] px-10">
                @csrf

                <h2 class="text-3xl font-bold mb-8 text-gray-900">Sign In</h2>

                @if ($errors->any())
                    <div class="mb-4 text-sm text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="mb-4">
                    <label for="email" class="block font-medium mb-1 text-gray-800">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan Email" required
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-md border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-200 text-gray-800 text-base" />
                </div>

                <div class="mb-6 relative">
                    <label for="password" class="block font-medium mb-1 text-gray-800">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Password" required
                        class="w-full px-4 py-3 pr-10 rounded-md border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-200 text-gray-800 text-base" />
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-[42px] text-gray-500 text-xl focus:outline-none" tabindex="-1">
                        <span id="toggleIcon">👁️</span>
                    </button>
                    <div class="text-xs text-gray-400 mt-1">
                        Harus berupa kombinasi minimal 8 huruf, angka, dan simbol.
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-md bg-blue-600 text-white font-semibold text-base hover:bg-blue-700 transition">
                    Masuk
                </button>
            </form>
        </div>

        <div class="w-1/2 bg-cover bg-center" style="background-image: url('/images/library.jpg');"></div>
    </div>
</body>

</html>

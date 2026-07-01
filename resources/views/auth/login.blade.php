@extends('layouts.app')
@section('title', 'Masuk - StokIn')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl w-full">
            <div class="text-center mb-4">
                <a href="/"><img src="{{ asset('images/stokin-blue.png') }}" alt="Stokinapp" class="mx-auto md:h-24"></a>
                <h2 class="text-2xl font-bold text-gray-900">Welcome Back!</h2>
            </div>

            <div class="bg-white grid grid-cols-1 md:grid-cols-2 rounded-2xl shadow-xl overflow-hidden min-h-[480px]">
                <div class="p-8 flex items-center">
                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg text-xs">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                    <div class="max-w-md mx-auto w-full">
                        <form method="POST" action="{{ route('login') }}" class="space-y-8">
                            @csrf
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus
                                    class="w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="nama@email.com">
                                @error('email')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password
                                </label>

                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                        class="w-full px-4 py-3 pr-12 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        placeholder="••••••••">

                                    <button type="button" onclick="togglePassword()"
                                        class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-[#0190F9] focus:outline-none">
                                        <i id="eyeIcon" class="fas fa-eye text-sm sm:text-sm"></i>
                                    </button>
                                </div>

                                @error('password')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 mb-4 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-70 disabled:cursor-not-allowed">
                                Masuk
                            </button>
                        </form>

                        <div class="text-center">
                            <p class="text-gray-600">
                                Belum punya akun?
                                <a href="{{ route('register') }}"
                                    class="text-[#0190F9] hover:text-blue-700 font-semibold">Daftar
                                    Sekarang</a>
                            </p>
                        </div>
                    </div>


                </div>
                <div class="hidden md:flex items-center justify-center p-8">
                    <img src="{{ asset('images/login-page.png') }}" alt="Aplikasi StokIn di Laptop"
                        class="w-full max-w-md object-contain">
                </div>

            </div>

            <div class="mt-6 text-center">
                <a href="/" class="text-gray-500 hover:text-gray-700 text-sm">
                    <i class="fa-regular fa-circle-left text-lg"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>

@endsection

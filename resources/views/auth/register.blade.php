@extends('layouts.app')
@section('title', 'Registrasi')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="text-center mb-6">
                    <a href="/" class="flex items-center justify-center">
                        <img src="{{ asset('images/stokin-blue.png') }}" alt="StokIn Logo" class="h-8 md:h-24 text-center">
                    </a>
                    <p class=" text-gray-600">Start managing your stock with Stokin</p>
                </div>

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg text-xs">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @if ($errors->has('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg text-xs">
                        <p>{{ $errors->first('error') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <span
                                class="bg-[#0190F9] text-white w-6 h-6 rounded-full flex items-center justify-center text-sm mr-2">1</span>
                            Data Pengguna
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lengkap</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" autofocus
                                    class="w-full px-4 py-3 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="Nama lengkap Anda">
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="nama@email.com">
                                @error('email')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-3 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="Minimal 8 karakter">
                                @error('password')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-4 py-3 border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="Ulangi password">
                                @error('password_confirmation')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <span
                                class="bg-[#0190F9] text-white w-6 h-6 rounded-full flex items-center justify-center text-sm mr-2">2</span>
                            Data Toko
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="toko_name" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Toko</label>
                                <input type="text" name="toko_name" id="toko_name" value="{{ old('toko_name') }}"
                                    class="w-full px-4 py-3 border {{ $errors->has('toko_name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="Nama toko Anda">
                                @error('toko_name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="toko_email" class="block text-sm font-medium text-gray-700 mb-2">Email
                                    Toko</label>
                                <input type="email" name="toko_email" id="toko_email" value="{{ old('toko_email') }}"
                                    class="w-full px-4 py-3 border {{ $errors->has('toko_email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="tokoanda@stokinapp.com">
                                @error('toko_email')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="toko_phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon
                                    Toko</label>
                                <input type="tel" name="toko_phone" id="toko_phone" value="{{ old('toko_phone') }}"
                                    class="w-full px-4 py-3 border {{ $errors->has('toko_phone') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="08xxxxxxxxxx" autocomplete="off">
                                @error('toko_phone')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="toko_address" class="block text-sm font-medium text-gray-700 mb-2">Alamat
                                    Toko</label>
                                <textarea name="toko_address" id="toko_address" rows="3"
                                    class="w-full px-4 py-3 border {{ $errors->has('toko_address') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                    placeholder="Alamat lengkap toko Anda">{{ old('toko_address') }}</textarea>
                                @error('toko_address')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-[#0190F9] hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-70 disabled:cursor-not-allowed">
                        Register
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-[#0190F9] hover:text-blue-700 font-semibold">Masuk di
                            sini</a>
                    </p>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="/" class="text-gray-500 hover:text-gray-700 text-sm">
                    <i class="fa-regular fa-circle-left text-lg"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
@endsection

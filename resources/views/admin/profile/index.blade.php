@extends('admin.layout.app')

@section('title', 'Profil & Pengaturan')

@push('styles')
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .grid>div {
            animation: fadeInUp 0.4s ease-out;
        }
    </style>
@endpush

@section('content')
    <div class="p-4 sm:p-6 lg:p-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Profil & Pengaturan</h1>
            <p class="text-gray-600">Kelola informasi akun dan keamanan Anda</p>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-sm text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Alert Error -->
        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-sm text-red-800 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Forms Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <!-- Update Email - Kiri -->
            <div
                class="bg-white rounded-3xl shadow-xs border border-slate-300/70 p-6 hover:shadow-md transition-all duration-300">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Perbarui Email</h3>
                        <p class="text-sm text-gray-500">Ubah alamat email akun Anda</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.profile.update-email') }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Baru</label>
                            <input type="email" id="email" name="email"
                                value="{{ old('email', auth('admin')->user()->email) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                                required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="current_password_email"
                                class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                            <div class="relative">
                                <input type="password" id="current_password_email" name="current_password"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('current_password') border-red-500 @enderror"
                                    required>
                                <button type="button"
                                    onclick="togglePasswordVisibility('current_password_email', 'eyeEmail')"
                                    class="absolute cursor-pointer right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg id="eyeEmail" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 shadow-sm">
                            Perbarui Email
                        </button>
                    </div>
                </form>
            </div>

            <!-- Change Password - Kanan -->
            <div
                class="bg-white rounded-3xl shadow-xs border border-slate-300/70 p-6 hover:shadow-md transition-all duration-300">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Ubah Password</h3>
                        <p class="text-sm text-gray-500">Pastikan password Anda kuat dan aman</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.profile.change-password') }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password Saat
                                Ini</label>
                            <div class="relative">
                                <input type="password" id="current_password" name="current_password"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition @error('current_password') border-red-500 @enderror"
                                    required>
                                <button type="button" onclick="togglePasswordVisibility('current_password', 'eyeCurrent')"
                                    class="absolute cursor-pointer right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg id="eyeCurrent" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                Baru</label>
                            <div class="relative">
                                <input type="password" id="new_password" name="new_password"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition @error('new_password') border-red-500 @enderror"
                                    required>
                                <button type="button" onclick="togglePasswordVisibility('new_password', 'eyeNew')"
                                    class="absolute cursor-pointer right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg id="eyeNew" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            @error('new_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="new_password_confirmation"
                                class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <div class="relative">
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                                    required>
                                <button type="button"
                                    onclick="togglePasswordVisibility('new_password_confirmation', 'eyeConfirm')"
                                    class="absolute cursor-pointer right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg id="eyeConfirm" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                            <p class="text-xs text-gray-600 font-semibold mb-2">Syarat Password:</p>
                            <ul class="text-xs text-gray-500 space-y-1.5">
                                <li class="flex items-center">
                                    <svg class="w-3.5 h-3.5 text-emerald-500 mr-2 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Minimal 8 karakter
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-3.5 h-3.5 text-emerald-500 mr-2 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Password baru harus berbeda dari password lama
                                </li>
                            </ul>
                        </div>

                        <button type="submit"
                            class="w-full bg-emerald-600 text-white py-3 rounded-lg font-semibold hover:bg-emerald-700 transition duration-300 shadow-sm">
                            Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
            <script>
        function togglePasswordVisibility(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);

            if (field.type === 'password') {
                field.type = 'text';
                icon.innerHTML =
                    `<path d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>`;
            } else {
                field.type = 'password';
                icon.innerHTML =
                    `<path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>`;
            }
        }
    </script>
    @endpush
@endsection

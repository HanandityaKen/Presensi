<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite('resources/css/app.css')
</head>
<body class="bg-white">
    <div class="container mx-auto p-4">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-semibold text-blue-500">Halo, {{$user->username}}</h1>
                <p class="text-gray-500">{{$user->role->name}}</p>
            </div>
            <!-- Profile Image and Dropdown -->
            <div class="flex items-center">
                <img src="https://via.placeholder.com/50" alt="Profile" class="w-12 h-12 rounded-full">
                <!-- Dropdown Button -->
                <button id="dropdownToggle" class="ml-2 p-2 text-gray-600 hover:bg-gray-200 rounded-full focus:outline-none">
                    <svg id="dropdownIcon" class="w-4 h-4 translate-y-[2px] transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path fill="currentColor" d="M143 352.3L7 216.3C-2.3 207-2.3 192.9 7 183.6l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0L160 258.7l96.5-96.7c9.4-9.4 24.6-9.4 33.9 0L313 183.6c9.4 9.4 9.4 24.6 0 33.9L177 352.3c-9.4 9.4-24.6 9.4-34 0z"/>
                    </svg>
                </button>
                <!-- Dropdown Menu -->
                <div id="dropdownMenu" class="hidden absolute right-[115px] top-[80px] w-48 bg-white border border-gray-200 rounded-lg shadow-md">
                    <a href="/akun" class="flex items-center px-4 py-2 text-gray-500 hover:bg-gray-100">
                        <i class="fas fa-user w-5 h-5 mr-3"></i>
                        Akun
                    </a>
                    <form method="POST" action="{{ route('logout.user') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-gray-500 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <!-- Button ke Halaman Form Presensi -->
        @if (!session('clocked_in'))
            <div class="mb-6">
                <a href="/presensi" class="px-4 py-2 border border-dashed border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white transition">
                    <i class="fas fa-clipboard-list mr-2"></i>Presensi Sekarang
                </a>
            </div>
        @endif

        @if (session('clocked_in'))
                <div class="mb-6">
                    <a href="{{route('presensi.out')}}" class="px-4 py-2 border border-dashed border-red-500 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition">
                        <i class="fas fa-clipboard-list mr-2"></i> Keluar
                    </a>
                </div>
        @endif

        <div class="w-full">
            @if (session('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Card Presensi Hari Ini -->
        <div class="bg-blue-500 p-4 rounded-lg shadow text-white mb-6">
            <div class="flex items-center justify-between">
                <p class="text-lg font-semibold"><i class="fas fa-calendar-alt mr-2"></i>Hari ini, {{now()->format('d F Y')}}</p>
            </div>
            <div class="flex justify-between mt-4">
                <div>
                    <p class="text-sm">Masuk</p>
                    <p class="text-2xl font-bold">
                        @if (session('clock_in_time'))
                            {{ session('clock_in_time') }}
                        @else
                            -- : --
                        @endif
                    </p>
                </div>
                <div class="border-l border-white h-10 lg:border-none"></div>
                <div>
                    <p class="text-sm">Keluar</p>
                    <p class="text-2xl font-bold">
                        @if (session('clock_out_time'))
                            {{ session('clock_out_time') }}
                        @else
                            -- : --
                        @endif
                    </p>
                </div>
            </div>
        </div>


        <!-- Riwayat Presensi -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <div class="flex justify-between items-center mb-4">
                <p class="font-semibold text-gray-600">Riwayat Presensi</p>
                <!-- <a href="#" class="px-3 py-2 border border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white">Lihat Semua</a> -->
                <a href="/riwayat-presensi" class="px-3 py-2 border border-dashed border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                <!-- Card untuk Riwayat Presensi -->
                @foreach ($presences as $presence)
                    <div class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Masuk</p>
                            <p class="font-semibold">
                                {{ \Carbon\Carbon::parse($presence->clock_in_time)->format('H:i') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Keluar</p>
                            <p class="font-semibold">
                                {{ $presence->clock_out_time ? \Carbon\Carbon::parse($presence->clock_out_time)->format('H:i') : '-- : --' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal</p>
                            <p class="font-semibold">
                                {{ \Carbon\Carbon::parse($presence->create_at)->isoFormat('ddd, D MMM YYYY') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.getElementById('dropdownToggle').addEventListener('click', function () {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>

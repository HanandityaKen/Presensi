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
                <p class="text-gray-500">Magang</p>
            </div>
            <img src="https://via.placeholder.com/50" alt="Profile" class="w-12 h-12 rounded-full">
        </div>

        <!-- Button ke Halaman Form Presensi -->
        <div class="mb-6">
            <a href="/presensi" class="px-4 py-2 border border-dashed border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white transition">
                <i class="fas fa-clipboard-list mr-2"></i>Presensi Sekarang
            </a>
        </div>

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
                <p class="text-lg font-semibold"><i class="fas fa-calendar-alt mr-2"></i>Hari ini, 18 Nov 2024</p>
            </div>
            <div class="flex justify-between mt-4">
                <div>
                    <p class="text-sm">Masuk</p>
                    <p class="text-2xl font-bold">08:04</p>
                </div>
                <div class="border-l border-white h-10 lg:border-none"></div>
                <div>
                    <p class="text-sm">Keluar</p>
                    <p class="text-2xl font-bold">-- : --</p>
                </div>
            </div>
        </div>


        <!-- Riwayat Presensi -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <div class="flex justify-between items-center mb-4">
                <p class="font-semibold text-gray-600">Riwayat Presensi</p>
              <!-- <a href="#" class="px-3 py-2 border border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white">Lihat Semua</a> -->
              <a href="#" class="px-3 py-2 border border-dashed border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                <!-- Card untuk Riwayat Presensi -->
                <div class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Masuk</p>
                        <p class="font-semibold">08:04</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Keluar</p>
                        <p class="font-semibold">-- : --</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal</p>
                        <p class="font-semibold">Sen, 18 Nov 2024</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Masuk</p>
                        <p class="font-semibold">07:45</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Keluar</p>
                        <p class="font-semibold">17:01</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal</p>
                        <p class="font-semibold">Jum, 15 Nov 2024</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Masuk</p>
                        <p class="font-semibold">07:42</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Keluar</p>
                        <p class="font-semibold">16:32</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal</p>
                        <p class="font-semibold">Kam, 14 Nov 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

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
                <!-- <h1 class="text-xl font-semibold text-blue-500">Riwayat Presensi Anda</h1> -->
            </div>
        </div>

        <!-- Riwayat Presensi -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <div class="flex justify-between items-center mb-4">
                <p class="font-semibold text-gray-600">Riwayat Presensi Anda</p>
                <!-- <a href="#" class="px-3 py-2 border border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white">Lihat Semua</a> -->
                <!-- <a href="#" class="px-3 py-2 border border-dashed border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white">Lihat Semua</a> -->
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
                                {{\Carbon\Carbon::parse($presence->clock_out_time)->format('H:i')}}
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white">
    <div class="container mx-auto p-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-blue-500">Presensi</h1>
            <p class="text-gray-600">Silakan isi detail presensi Anda di bawah ini.</p>
        </div>

        <!-- Form -->
        <form action="/submit-presensi" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <!-- Tanggal -->
            <div class="mb-4">
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Jam Masuk -->
            <div class="mb-4">
                <label for="jam_masuk" class="block text-sm font-medium text-gray-700">Jam Masuk</label>
                <input type="time" id="jam_masuk" name="jam_masuk" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Jam Keluar -->
            <div class="mb-4">
                <label for="jam_keluar" class="block text-sm font-medium text-gray-700">Jam Keluar</label>
                <input type="time" id="jam_keluar" name="jam_keluar" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Kamera -->
            <!-- <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Ambil Foto</label>
                <div class="flex flex-col items-center">
                    <video id="video" autoplay class="w-full h-64 bg-gray-200 rounded-md"></video>
                    <button type="button" id="capture" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition">
                        Ambil Foto
                    </button>
                    <canvas id="canvas" class="hidden w-full h-64 mt-4 bg-gray-200 rounded-md"></canvas>
                    <input type="hidden" id="foto" name="foto">
                </div>
            </div> -->

            <div class="mb-4">
                <label for="foto" class="block text-sm font-medium text-gray-700">Ambil Foto</label>
                <input type="file" id="foto" name="foto" accept="image/*" capture="user" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Lokasi -->
            <div class="mb-4">
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" required placeholder="Masukkan lokasi Anda" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- <div class="mb-4">
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" readonly placeholder="Klik pada peta untuk memilih lokasi" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div id="map"></div>
            </div> -->

            <!-- Button Submit -->
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow hover:bg-blue-600 transition">
                    Kirim Presensi
                </button>
            </div>
        </form>
    </div>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script> -->
    <script>
        // $(document).ready(function () {
        //     const $video = $('#video');
        //     const $canvas = $('#canvas');
        //     const $captureButton = $('#capture');
        //     const $fotoInput = $('#foto');
        //     const context = $canvas[0].getContext('2d');

        //     // Akses Kamera
        //     navigator.mediaDevices.getUserMedia({ video: true })
        //         .then(function (stream) {
        //             $video[0].srcObject = stream;
        //             $video[0].play();
        //         })
        //         .catch(function (err) {
        //             console.error('Gagal mengakses kamera:', err);
        //         });

        //     // Ambil Foto
        //     $captureButton.on('click', function () {
        //         // Set dimensi canvas sesuai video
        //         $canvas.attr({
        //             width: $video[0].videoWidth,
        //             height: $video[0].videoHeight
        //         });

        //         // Gambar video ke canvas
        //         context.drawImage($video[0], 0, 0, $canvas.width(), $canvas.height());

        //         // Tampilkan pratinjau
        //         $canvas.removeClass('hidden');

        //         // Konversi gambar ke Base64
        //         $fotoInput.val($canvas[0].toDataURL('image/png'));
        //     });
        // });

          // $(document).ready(function () {
          //     // Inisialisasi peta
          //     const map = L.map('map').setView([-6.200000, 106.816666], 13); // Koordinat default (Jakarta)

          //     // Tambahkan layer peta dari OpenStreetMap
          //     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          //         attribution: '© OpenStreetMap contributors'
          //     }).addTo(map);

          //     // Marker untuk menunjukkan lokasi yang dipilih
          //     let marker;

          //     // Tambahkan event listener untuk mengambil lokasi ketika peta diklik
          //     map.on('click', function (e) {
          //         const { lat, lng } = e.latlng;

          //         // Jika marker sudah ada, pindahkan ke lokasi baru
          //         if (marker) {
          //             marker.setLatLng(e.latlng);
          //         } else {
          //             // Tambahkan marker ke lokasi yang dipilih
          //             marker = L.marker(e.latlng).addTo(map);
          //         }

          //         // Tampilkan koordinat di input lokasi
          //         $('#lokasi').val(`${lat}, ${lng}`);
          //     });
          // });

    </script>

</body>
</html>

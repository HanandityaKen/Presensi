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
            <div class="mb-4" id="camera-foto">
                <label class="block text-sm font-medium text-gray-700">Ambil Foto</label>
                <div class="flex flex-col items-center">
                    <video id="video" autoplay class="w-auto h-64 bg-gray-200 rounded-md"></video>
                    <div class="flex mt-4 space-x-2">
                        <button type="button" id="capture" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition">
                            Ambil Foto
                        </button>
                        <button type="button" id="upload" class="px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600 transition">
                            Upload Foto
                        </button>
                    </div>
                    <canvas id="canvas" class="hidden w-auto h-64 bg-gray-200 rounded-md"></canvas>
                    <button type="button" id="retake" class="hidden mt-4 px-4 py-2 bg-gray-500 text-white rounded-md shadow hover:bg-gray-600 transition">
                        Ulangi Foto
                    </button>
                    <input type="hidden" id="foto" name="foto">
                </div>
            </div>

            <div class="mb-4 hidden" id="upload-foto">
                <label for="upload-foto" class="block text-sm font-medium text-gray-700">Ambil Foto</label>
                <input type="file" id="upload-foto" name="foto" accept="image/*" capture="user" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="button" id="capture-foto-button" class="w-full px-4 py-2 mt-3 bg-green-500 text-white rounded-md shadow hover:bg-green-600 transition">
                    Ambil Foto
                </button>
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
        $(document).ready(function () {
            const video = $("#video")[0];
            const canvas = $("#canvas")[0];
            const fotoInput = $("#foto");
            const captureButton = $("#capture");
            const uploadButton = $("#upload");
            const retakeButton = $("#retake");
            let stream = null;

            // Minta akses ke kamera
            navigator.mediaDevices
                .getUserMedia({ video: true })
                .then(function (mediaStream) {
                    stream = mediaStream;
                    video.srcObject = stream;
                })
                .catch(function (error) {
                    console.error("Kamera tidak dapat diakses: ", error);
                    alert("Kamera tidak tersedia atau akses ditolak.");
                });

            // Ambil foto saat tombol ditekan
            captureButton.click(function () {
                const context = canvas.getContext("2d");
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;

                // Gambar frame dari video ke canvas
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                // Tampilkan hasil pada canvas
                $(canvas).removeClass("hidden");
                $(retakeButton).removeClass("hidden");
                $(video).addClass("hidden");
                $(captureButton).addClass("hidden");
                $(uploadButton).addClass("hidden");

                // Konversi gambar ke base64
                const dataURL = canvas.toDataURL("image/png");

                // Masukkan data gambar ke input hidden
                fotoInput.val(dataURL);
            });

             // Ulangi foto saat tombol ditekan
            retakeButton.click(function () {
                $(canvas).addClass("hidden");
                $(retakeButton).addClass("hidden");

                $(video).removeClass("hidden");
                $(captureButton).removeClass("hidden");
                $(uploadButton).removeClass("hidden");

                fotoInput.val("");
            });

            uploadButton.click(function () {
                if (stream) {
                    const tracks = stream.getTracks();
                    tracks.forEach(track => track.stop()); // Hentikan semua track
                }

                $("#camera-foto").addClass("hidden");

                $("#upload-foto").removeClass("hidden");
            });

            $('#capture-foto-button').click(function () {
                $("#camera-foto").removeClass("hidden");

                $("#upload-foto").addClass("hidden");

                // Aktifkan kamera lagi
                navigator.mediaDevices
                    .getUserMedia({ video: true })
                    .then(function (mediaStream) {
                        stream = mediaStream; // Simpan stream lagi
                        video.srcObject = stream;
                    })
                    .catch(function (error) {
                        console.error("Kamera tidak dapat diakses: ", error);
                        alert("Kamera tidak tersedia atau akses ditolak.");
                    });
            })
        });

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

        //      // Ambil Foto
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

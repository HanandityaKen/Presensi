<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    @vite('resources/css/app.css')
</head>
<body class="bg-white">
    <div class="container mx-auto p-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-blue-500">Presensi Masuk</h1>
            <p class="text-gray-600">Silakan isi detail presensi Anda di bawah ini.</p>
        </div>

        @error('foto')
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{$message}}</span>
                </div>
            </div>
        @enderror
        

        <!-- Form -->
        <form action="{{route('presensi-in.store')}}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <input type="hidden" id="user_id" name="user_id" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{$user->id}}">

            <div class="mb-4">
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>                
                <input type="text" id="tanggal" name="tanggal" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ now()->format('d F Y') }}" disabled>
            </div>

            <!-- Jam Masuk -->
            <div class="mb-4">
                <label for="jam_masuk" class="block text-sm font-medium text-gray-700">Jam Masuk</label>
                <input type="time" id="jam_masuk" name="clock_in_time" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ now()->format('H:i') }}" readonly>
            </div>

            <div class="mb-4">
                <label for="work-place" class="block text-sm font-medium text-gray-700">Tempat Kerja</label>
                <select id="work-place" name="work_place" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Pilih tempat kerja" required>
                    <option value="" disabled selected>Pilih Tempat Kerja</option>
                    <option value="home">WFH</option>
                    <option value="office">Kantor</option>
                </select>
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
                    <input type="hidden" id="foto-input" name="foto" class="" accept="image/png">
                </div>
            </div>

            <div class="mb-4 hidden" id="upload-foto">
                <label for="upload-foto-input" class="block text-sm font-medium text-gray-700">Ambil Foto</label>
                <input type="file" id="upload-foto-input" name="foto" accept="image/*" capture="user" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="button" id="capture-foto-button" class="w-full px-4 py-2 mt-3 bg-green-500 text-white rounded-md shadow hover:bg-green-600 transition">
                    Ambil Foto
                </button>
            </div>

            <div class="mb-4">
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" placeholder="Kordinat Lokasi" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                <div id="map" class="w-full h-96 mt-4"></div>
            </div>

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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        $(document).ready(function () {
            const video = $('#video')[0];
            const canvas = $('#canvas')[0];
            const fotoInput = $('#foto-input');
            const captureButton = $('#capture');
            const uploadButton = $('#upload');
            const retakeButton = $('#retake');
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
                $(canvas).removeClass('hidden');
                $(retakeButton).removeClass('hidden');
                $(video).addClass('hidden');
                $(captureButton).addClass('hidden');
                $(uploadButton).addClass('hidden');


                // Konversi canvas ke Base64
                const base64Image = canvas.toDataURL("image/png");

                fotoInput.val(base64Image);

                // canvas.toBlob(function(blob) {
                //     var dataTransfer = new DataTransfer();
                //     var file = new File([blob], 'foto.png', { type: 'image/png' });

                //     dataTransfer.items.add(file);
                //     fotoInput[0].files = dataTransfer.files;

                //     console.log(fotoInput[0].files);

                // })

                if (stream) {
                    const tracks = stream.getTracks();
                    tracks.forEach(track => track.stop()); // Hentikan semua track
                }
            });

             // Ulangi foto saat tombol ditekan
            retakeButton.click(function () {
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

                $(canvas).addClass('hidden');
                $(retakeButton).addClass('hidden');

                $(video).removeClass('hidden');
                $(captureButton).removeClass('hidden');
                $(uploadButton).removeClass('hidden');

                fotoInput.val("");
            });

            uploadButton.click(function () {
                if (stream) {
                    const tracks = stream.getTracks();
                    tracks.forEach(track => track.stop()); // Hentikan semua track
                }

                $('#camera-foto').addClass('hidden');

                $('#upload-foto').removeClass('hidden');

                fotoInput.removeAttr('required');

                $('#upload-foto-input').attr('required', 'required');
            });

            $('#capture-foto-button').click(function () {
                $('#camera-foto').removeClass('hidden');

                $('#upload-foto').addClass('hidden');

                $('#upload-foto-input').removeAttr('required');

                fotoInput.attr('required', 'required')

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

        $(document).ready(function () {
            var map = L.map('map').setView([51.505, -0.09], 19);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Aktifkan geolocation untuk menemukan lokasi pengguna
            map.locate({ watch: true, maxZoom: 19, enableHighAccuracy: true });

            // Event ketika lokasi ditemukan
            map.on('locationfound', function (e) {
                var userLat = e.latitude;
                var userLng = e.longitude;

                $('#lokasi').val(userLat + ", " + userLng);

                // Tambahkan marker di lokasi pengguna
                L.marker([userLat, userLng])
                    .addTo(map)
                    .bindPopup("Lokasi Anda saat ini")
                    .openPopup();
            });

            // Event ketika lokasi tidak ditemukan atau gagal
            map.on('locationerror', function (e) {
                alert("Tidak dapat menemukan lokasi Anda. Pastikan GPS atau izin lokasi aktif.");
                console.error(e.message);
            });
        })

    </script>

</body>
</html>

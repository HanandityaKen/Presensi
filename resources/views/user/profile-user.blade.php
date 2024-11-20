<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white">
    <div class="container mx-auto p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-blue-500">Akun Anda</h1>
            <p class="text-gray-600">Pastikan informasinya benar sebelum menyimpan.</p>
        </div>
        <div class="flex flex-wrap -mx-4 mb-10">
            <!-- Foto Profil -->
            <div class="w-full md:w-1/3 px-4 mb-6 md:mb-0">
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <img src="https://via.placeholder.com/150" id="profile-image" alt="Foto Profil"
                        class="w-36 h-36 rounded-full object-cover mx-auto mb-4">
                    <h5 class="text-lg font-semibold" id="name-user-title">Nama Pengguna</h5>
                    <p class="text-gray-500 mb-4" id="email-user-title">Email Pengguna</p>
                    <input type="file" id="upload-photo-input" class="hidden" name="photo">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                        id="buttonUploadPhoto">Upload Gambar</button>
                </div>
            </div>
            <!-- Detail Profil -->
            <div class="w-full md:w-2/3 px-4">
                <div class="bg-white rounded-lg shadow p-6">
                    <h6 class="text-lg font-bold text-blue-500 mb-4">Detail Profil</h6>
                    <form id="editForm" method="POST" class="space-y-4">
                        <!-- Email -->
                        <div>
                            <label for="nama" class="block text-gray-700 font-medium">Nama</label>
                            <input type="text" id="nama" name="nama" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <!-- Password Lama -->
                        <div>
                            <label for="user-old-pass" class="block text-gray-700 font-medium">Password Lama</label>
                            <input type="password" id="user-old-pass" name="old-password" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <!-- Password Baru -->
                        <div>
                            <label for="user-new-pass" class="block text-gray-700 font-medium">Password Baru</label>
                            <input type="password" id="user-new-pass" name="new-password" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="user-confirm-pass" class="block text-gray-700 font-medium">Konfirmasi Password</label>
                            <input type="password" id="user-confirm-pass" name="confirm-password" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <!-- Tombol Edit Profil -->
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Edit Profil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>
</html>

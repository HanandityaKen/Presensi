<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
                    <h5 class="text-lg font-semibold" id="name-user-title">{{$user->username}}</h5>
                    <p class="text-gray-500 mb-4" id="email-user-title">Email Pengguna</p>
                    <input type="file" id="upload-photo-input" class="hidden" name="photo">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg"
                        id="buttonUploadPhoto">Upload Gambar</button>
                </div>
            </div>
            <!-- Detail Profil -->
            <div class="w-full md:w-2/3 px-4">
                <div class="bg-white rounded-lg shadow p-6">
                    <h6 class="text-lg font-bold text-blue-500 mb-4">Detail Profil</h6>
                    
                    <!-- Feedback -->
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

                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-4 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="username" class="block text-gray-700 font-medium">Username</label>
                            <input type="text" id="username" name="username" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $user->username }}">
                        </div>
                        <div>
                            <label for="user-old-pass" class="block text-gray-700 font-medium">Password Lama</label>
                            <input type="password" id="user-old-pass" name="old-password" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="user-new-pass" class="block text-gray-700 font-medium">Password Baru</label>
                            <input type="password" id="user-new-pass" name="new-password" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="user-confirm-pass" class="block text-gray-700 font-medium">Konfirmasi Password</label>
                            <input type="password" id="user-confirm-pass" name="new-password_confirmation" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Edit Profil</button>
                    </form>
                </div>

                <!-- Card untuk Menghubungkan Akun dengan Google -->
                <div class="mt-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h6 class="text-lg font-bold text-blue-500 mb-4">Hubungkan Akun dengan Google</h6>
                        <p class="text-gray-600 mb-4">Anda dapat menghubungkan akun ini dengan Google untuk akses yang lebih mudah.</p>
                        <button class="border border-gray-300 text-gray-700 font-bold py-2 px-4 rounded-xl w-full flex items-center justify-center hover:bg-gray-400 hover:text-white">
                            <i class="fab fa-google mr-2"></i> <!-- Google icon -->
                            Hubungkan dengan Google
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>


</body>
</html>

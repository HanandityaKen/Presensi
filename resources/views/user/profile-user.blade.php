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
        <!-- Card Gabungan -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-blue-500">Akun Anda</h1>
                <p class="text-gray-600">Pastikan informasinya benar sebelum menyimpan.</p>
                
                <!-- Feedback -->
                @if (session('success'))
                    <div class="flex items-center p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="flex items-center p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{session('error')}}</span>
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

            </div>
            <!-- Foto Profil -->
            <div class="text-center mb-6">
                <form action="{{ route('user.upload.photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center mb-6">
                        <img src="{{$user->image_url ? asset('storage/user/' . $user->image_url) : 'https://via.placeholder.com/150' }}" id="profile-image" alt="Foto Profil" class="w-36 h-36 rounded-full object-cover mx-auto mb-4">
                        <h5 class="text-lg font-semibold" id="name-user-title">{{ $user->username }}</h5>
                        <p class="text-gray-500 mb-4" id="email-user-title">{{ $user->email }}</p>
                        <input type="file" id="upload-photo-input" name="image_url" class="hidden" onchange="this.form.submit()">
                        <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg" 
                                id="buttonUploadPhoto" 
                                onclick="document.getElementById('upload-photo-input').click()">
                            Upload Gambar
                        </button>
                    </div>
                </form>
            </div>
            <!-- Detail Profil -->
            <h6 class="text-lg font-bold text-blue-500 mb-4">Detail Profil</h6>
            


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
                <a href="{{ route('dashboard') }}" class="inline-block mt-4 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">Batal</a>
            </form>

            <!-- Card untuk Menghubungkan Akun dengan Google -->
            <div class="mt-6">
                <h6 class="text-lg font-bold text-gray-600 mb-4">Hubungkan Akun dengan Google</h6>
                <p class="text-gray-600 mb-4">Anda dapat menghubungkan akun ini dengan Google untuk akses yang lebih mudah.</p>
                <a href="{{route('oauth.google')}}">
                    <button class="border border-gray-300 text-gray-700 font-bold py-2 px-4 rounded-xl w-full flex items-center justify-center hover:bg-blue-400 hover:text-white gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20px" height="20px" class="flex-shrink-0">
                            <path fill="#EA4335" d="M24 9.5c3.5 0 6.2 1.4 8.1 2.6l6-6C34.6 3.1 29.8 1 24 1 14.7 1 7 6.8 3.3 14.2l7.6 5.8C12.7 13.1 17.9 9.5 24 9.5z"/>
                            <path fill="#34A853" d="M46.4 24.1c0-1.5-.2-3-.5-4.4H24v8.9h12.7c-.5 3-2 5.5-4.1 7.3l6.3 4.9c3.6-3.3 5.7-8.1 5.7-13.8z"/>
                            <path fill="#4A90E2" d="M9.9 27c-1.3-.9-2.4-2-3.2-3.3L0 27.4C2.8 32.6 7.9 36.4 14 37.4v-7.5c-2.4-.5-4.6-1.6-6.5-3.2z"/>
                            <path fill="#FBBC05" d="M24 47c5.5 0 10.1-1.8 13.5-4.8l-6.3-4.9c-2.1 1.4-4.8 2.3-7.2 2.3-5.5 0-10.2-3.7-11.9-8.8H3.3v5.8C6.8 41.7 14.2 47 24 47z"/>
                            <path fill="none" d="M0 0h48v48H0z"/>
                        </svg>
                        Hubungkan dengan Google
                    </button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>

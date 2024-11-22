@extends('layout.main') 

@section('content')
<div class="container mx-auto p-4">
    <div class="flex flex-wrap -mx-4 mb-10">
        <!-- Detail Profil -->
        <div class="w-full px-4">
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

                <!-- Form Edit Profil -->
                <form action="{{ route('profile.admin.update') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <label for="display_name" class="block text-gray-700 font-medium">Nama</label>
                        <input 
                            type="text" 
                            id="display_name" 
                            name="display_name" 
                            value="{{ old('display_name', $admin->display_name) }}" 
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-gray-700 font-medium">Username</label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            value="{{ old('username', $admin->username) }}" 
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <!-- Password Lama -->
                    <div>
                        <label for="old-password" class="block text-gray-700 font-medium">Password Lama</label>
                        <input 
                            type="password" 
                            id="old-password" 
                            name="old-password" 
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <!-- Password Baru -->
                    <div>
                        <label for="new-password" class="block text-gray-700 font-medium">Password Baru</label>
                        <input 
                            type="password" 
                            id="new-password" 
                            name="new-password" 
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label for="new-password_confirmation" class="block text-gray-700 font-medium">Konfirmasi Password</label>
                        <input 
                            type="password" 
                            id="new-password_confirmation" 
                            name="new-password_confirmation" 
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <!-- Tombol Edit Profil -->
                    <div class="flex justify-end">
                        <button 
                            type="submit" 
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Edit Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
